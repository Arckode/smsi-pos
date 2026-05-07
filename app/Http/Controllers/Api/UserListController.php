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

class UserListController extends Controller
{
    protected const SUBMODULE_URL = '/users';

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
        $relations = [
            'unit:id,name',
            'role:id,name'
        ];

        $data = User::with($relations)
            ->when(
                request()->has('search') && request()->search != '',
                function ($q) {
                    $q->where('name', 'like', '%' . request()->search . '%')
                        ->orWhere('email', 'like', '%' . request()->search . '%');
                }
            )->when(
                request()->has('unit') && request()->unit != '',
                function ($q) {
                    $q->orWhereHas('unit', function ($q1) {
                        $q1->where('name', 'like', '%' . request()->unit . '%');
                    });
                }
            )->when(
                request()->has('role') && request()->role != '',
                function ($q) {
                    $q->orWhereHas('role', function ($q1) {
                        $q1->where('name', 'like', '%' . request()->role . '%');
                    });
                }
            )->when(
                request()->has('status') && request()->status != '',
                function ($q) {
                    $q->where('is_active', request()->status === 'Active' ? 1 : 0);
                }
            )
            ->paginate(15);

        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }

    public function changeStatus(int $id)
    {
        $this->authorizeSubmoduleAction('update');

        $user = User::findOrFail($id);
        $user->is_active = ! $user->is_active;
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'User status has been updated successfully.',
            'data' => $user,
        ]);
    }

    public function resetPassword(int $id)
    {
        $this->authorizeSubmoduleAction('update');

        $user = User::findOrFail($id);
        $user->password = bcrypt('defaultpassword');
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'User password has been reset successfully.',
            'data' => $user,
        ]);
    }

    public function store(Request $request)
    {
        $this->authorizeSubmoduleAction('create');

        $request->merge([
            'password' => 'password',
            'is_active' => 1
        ]);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'unit_id' => 'nullable|exists:units,id',
            'role_id' => 'nullable|exists:user_roles,id',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        $user = User::create($validatedData);

        return response()->json([
            'status' => true,
            'message' => 'User has been created successfully.',
            'data' => $user,
        ]);
    }

    public function show(int $id)
    {
        $this->authorizeSubmoduleAction('read');

        $user = User::findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $user,
        ]);
    }

    public function update(Request $request, int $id)
    {
        $this->authorizeSubmoduleAction('update');

        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'unit_id' => 'nullable|exists:units,id',
            'role_id' => 'nullable|exists:user_roles,id',
        ]);
        $user->update($validatedData);

        return response()->json([
            'status' => true,
            'message' => 'User has been updated successfully.',
            'data' => $user,
        ]);
    }
}
