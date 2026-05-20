<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAccessRequest;
use App\Models\MenuModule;
use App\Models\MenuSubmodule;
use App\Models\User;
use App\Models\MenuUserAccess;
use App\Models\MenuUserSubmodulePermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserAccessController extends Controller
{
    protected const SUBMODULE_URL = '/users/access';

    protected function authorizeSubmoduleAction(string $action): void
    {
        $subModule = MenuSubmodule::where('url', self::SUBMODULE_URL)->first();

        if (! $subModule) {
            abort(403, 'Bookstore asset submodule is not configured.');
        }

        $user = auth()->user();
        if (! $user) {
            abort(403, 'Unauthorized.');
        }

        $permission = $user->submodulePermissions()
            ->where('sub_module_id', $subModule->sub_module_id)
            ->first();

        if (! $permission || ! $permission->hasAction($action)) {
            abort(403, 'You do not have permission to perform this action.');
        }
    }
    public function index()
    {
        $this->authorizeSubmoduleAction('read');

        $allModules = MenuModule::with('subModules')->orderBy('order')->get();

        $users = User::with(['menuUserAccess', 'submodulePermissions'])->get();

        $data = $users->map(function (User $user) use ($allModules) {
            $userModuleAccess = $user->menuUserAccess->keyBy('module_id');

            $modules = $allModules->map(function ($module) use ($user, $userModuleAccess) {
                $access = $userModuleAccess->get($module->module_id);
                $assignedSubmoduleIds = collect($access?->sub_module_ids ?? []);

                $submodules = $module->subModules->map(function ($submodule) use ($user, $assignedSubmoduleIds) {
                    $permission = $user->submodulePermissions->firstWhere('sub_module_id', $submodule->sub_module_id);

                    return [
                        'sub_module_id' => $submodule->sub_module_id,
                        'sub_module_name' => $submodule->sub_module_name,
                        'url' => $submodule->url,
                        'assigned' => $assignedSubmoduleIds->contains($submodule->sub_module_id),
                        'status' => $assignedSubmoduleIds->contains($submodule->sub_module_id),
                        'actions' => [
                            'read' => $permission?->can_read ?? false,
                            'create' => $permission?->can_create ?? false,
                            'update' => $permission?->can_update ?? false,
                            'delete' => $permission?->can_delete ?? false,
                        ],
                    ];
                });

                return [
                    'module_id' => $module->module_id,
                    'name' => $module->name,
                    'url' => $module->url,
                    'assigned' => $access !== null,
                    'status' => $access !== null,
                    'submodules' => $submodules,
                ];
            });

            return [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                ],
                'modules' => $modules,
                'is_edited' => false,
            ];
        });

        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }

    public function saveAccessChanges(Request $request)
    {
        $this->authorizeSubmoduleAction('update');

        $userAccessChanges = $request->input('data', []);

        if (! is_array($userAccessChanges) || empty($userAccessChanges)) {
            return response()->json([
                'status' => true,
                'message' => 'No access changes to save.',
            ]);
        }

        try {
            DB::beginTransaction();

            foreach ($userAccessChanges as $item) {
                $userId = data_get($item, 'user.id') ?? data_get($item, 'user_id');
                if (! $userId) {
                    continue;
                }

                $user = User::find($userId);
                if (! $user) {
                    continue;
                }

                MenuUserAccess::where('user_id', $userId)->delete();
                MenuUserSubmodulePermission::where('user_id', $userId)->delete();

                $modules = data_get($item, 'modules', []);
                if (! is_array($modules)) {
                    continue;
                }

                foreach ($modules as $module) {
                    $moduleId = data_get($module, 'module_id');
                    if (! $moduleId) {
                        continue;
                    }

                    $submodules = data_get($module, 'submodules', []);
                    $submoduleIds = [];

                    if (! is_array($submodules)) {
                        continue;
                    }

                    foreach ($submodules as $submodule) {
                        $subModuleId = data_get($submodule, 'sub_module_id');
                        if (! $subModuleId) {
                            continue;
                        }

                        $actions = data_get($submodule, 'actions', []);
                        if (! is_array($actions)) {
                            continue;
                        }

                        $permissionData = [
                            'user_id' => $userId,
                            'sub_module_id' => $subModuleId,
                            'can_create' => filter_var(data_get($actions, 'create', false), FILTER_VALIDATE_BOOLEAN),
                            'can_read' => filter_var(data_get($actions, 'read', false), FILTER_VALIDATE_BOOLEAN),
                            'can_update' => filter_var(data_get($actions, 'update', false), FILTER_VALIDATE_BOOLEAN),
                            'can_delete' => filter_var(data_get($actions, 'delete', false), FILTER_VALIDATE_BOOLEAN),
                        ];

                        $hasPermission = $permissionData['can_create'] || $permissionData['can_read'] || $permissionData['can_update'] || $permissionData['can_delete'];
                        if (! $hasPermission) {
                            continue;
                        }

                        MenuUserSubmodulePermission::create($permissionData);
                        $submoduleIds[] = $subModuleId;
                    }

                    if (! empty($submoduleIds)) {
                        MenuUserAccess::create([
                            'user_id' => $userId,
                            'module_id' => $moduleId,
                            'sub_module_ids' => array_values(array_unique($submoduleIds)),
                        ]);
                    }
                }
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Access changes have been saved successfully.',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Failed to save access changes.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $userAccess = UserAccess::create($request->all());
        return response()->json($userAccess, 201);
    }

    public function show(UserAccess $userAccess)
    {
        return response()->json($userAccess);
    }

    public function update(Request $request, UserAccess $userAccess)
    {
        $userAccess->update($request->all());
        return response()->json($userAccess);
    }

    public function destroy(UserAccess $userAccess)
    {
        $userAccess->delete();
        return response()->json(null, 204);
    }

    // Additional method to get user access by user_id
    public function getAccessByUserId(int $userId)
    {
        $userAccess = UserAccess::where('user_id', $userId)->first();

        if (!$userAccess) {
            return response()->json(['message' => 'User access not found'], 404);
        }

        return response()->json($userAccess);
    }
}
