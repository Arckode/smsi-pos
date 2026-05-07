<?php

namespace App\Http\Controllers\Api;

use App\Enums\RoleType;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validator::extend('without_spaces', function ($attr, $value) {
            //     return preg_match('/^\S*$/u', $value);
            // });

            // $validation = Validator::make($request->all(), [
            //     'unit_id' => 'required|exists:units,id',
            //     'name' => 'required',
            //     'email' => 'required|email|unique:users,email',
            //     'password' => 'required|min:8',
            // ]);

            // if ($validation->fails()) {
            //     return response()->json([
            //         'status' => false,
            //         'message' => 'Validation Error',
            //         'errors' => $validation->errors()
            //     ], 401);
            // }

            $user = User::create([
                'unit_id' => $request->unit_id,
                'name' => $request->name,
                'role' => RoleType::USER->value,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $token = $user->createToken("BOOKSTORE TOKEN")->plainTextToken;

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'User Successfully Created',
                'token' => $token,
                'role' => [
                    "code" => $user->role,
                    "title" => RoleType::from($user->role)->name,
                ]
            ], 201);
        } catch (\Throwable $error) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $error->getMessage()
            ], 500);
        }
    }

    public function login(Request $request): JsonResponse
    {
        try {
            Validator::extend('without_spaces', function ($attr, $value) {
                return preg_match('/^\S*$/u', $value);
            });

            $validation = Validator::make(
                $request->all(),
                [
                    'email' => 'required|without_spaces|email|exists:users',
                    'password' => 'required'
                ]
            );

            if ($validation->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation Error',
                    'errors' => $validation->errors()
                ], 401);
            }

            $user = User::where('email', $request->email)->where('is_active', true)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid credentials'
                ], 401);
            }

            $token = $user->createToken("BOOKSTORE TOKEN")->plainTextToken;

            $user->load('submodulePermissions.subModule.module');
            $accessesData = [];

            foreach ($user->submodulePermissions as $permission) {
                $subModule = $permission->subModule;
                if (! $subModule) {
                    continue;
                }

                $module = $subModule->module;
                if (! $module) {
                    continue;
                }

                $moduleId = $module->module_id;
                if (! isset($accessesData[$moduleId])) {
                    $accessesData[$moduleId] = [
                        'name' => $module->name,
                        'url' => $module->url,
                        'submodules' => [],
                    ];
                }

                $accessesData[$moduleId]['submodules'][] = [
                    'sub_module_name' => $subModule->sub_module_name,
                    'url' => $subModule->url,
                    'actions' => $permission->actions,
                ];
            }

            $accessesData = array_values($accessesData);

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $token,
                'role' => [
                    "code" => $user->role_id,
                    "title" => RoleType::from($user->role_id)->name,
                ],
                'accesses' => $accessesData
            ], 200);
        } catch (\Throwable $error) {
            return response()->json([
                'status' => false,
                'message' => $error->getMessage()
            ], 500);
        }
    }

    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            $vlaidateReq = $request->validated();

            User::where('id', auth()->user()->id)->update(['password' => bcrypt($vlaidateReq['password'])]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Password has been changed'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Logged out successfully'
        ], 200);
    }

    public function currentUser(Request $request): JsonResponse
    {
        try {
            $user = $request->user();
            $user->load('submodulePermissions.subModule.module');
            $accessesData = [];

            foreach ($user->submodulePermissions as $permission) {
                $subModule = $permission->subModule;
                if (! $subModule) {
                    continue;
                }

                $module = $subModule->module;
                if (! $module) {
                    continue;
                }

                $moduleId = $module->module_id;
                if (! isset($accessesData[$moduleId])) {
                    $accessesData[$moduleId] = [
                        'name' => $module->name,
                        'url' => $module->url,
                        'submodules' => [],
                    ];
                }

                $accessesData[$moduleId]['submodules'][] = [
                    'sub_module_name' => $subModule->sub_module_name,
                    'url' => $subModule->url,
                    'actions' => $permission->actions,
                ];
            }

            $accessesData = array_values($accessesData);

            return response()->json([
                'status' => true,
                'user' => $user,
                'accesses' => $accessesData
            ], 200);
        } catch (\Throwable $error) {
            return response()->json([
                'status' => false,
                'message' => $error->getMessage()
            ], 500);
        }
    }
}
