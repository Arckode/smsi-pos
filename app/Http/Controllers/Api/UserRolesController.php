<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAccessRequest;
use App\Models\MenuModule;
use App\Models\MenuSubmodule;
use App\Models\User;
use App\Models\MenuUserAccess;
use App\Models\MenuUserSubmodulePermission;
use App\Models\UserRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserRolesController extends Controller
{
    // protected const SUBMODULE_URL = '/users';

    // protected function authorizeSubmoduleAction(string $action): void
    // {
    //     $subModule = MenuSubmodule::where('url', self::SUBMODULE_URL)->first();

    //     if (! $subModule) {
    //         abort(403, 'Bookstore asset submodule is not configured.');
    //     }

    //     $user = auth()->user();
    //     if (! $user) {
    //         abort(403, 'Unauthorized.');
    //     }

    //     $permission = $user->submodulePermissions()
    //         ->where('sub_module_id', $subModule->sub_module_id)
    //         ->first();

    //     if (! $permission || ! $permission->hasAction($action)) {
    //         abort(403, 'You do not have permission to perform this action.');
    //     }
    // }
    // public function index()
    // {
    //     $this->authorizeSubmoduleAction('read');
    //     $relations = [
    //         'unit:id,name',
    //         'role:id,name'
    //     ];

    //     $data = User::with($relations)
    //         ->when(
    //             request()->has('search') && request()->search != '',
    //             function ($q) {
    //                 $q->where('name', 'like', '%' . request()->search . '%')
    //                     ->orWhere('email', 'like', '%' . request()->search . '%');
    //             }
    //         )->when(
    //             request()->has('unit') && request()->unit != '',
    //             function ($q) {
    //                 $q->orWhereHas('unit', function ($q1) {
    //                     $q1->where('name', 'like', '%' . request()->unit . '%');
    //                 });
    //             }
    //         )->when(
    //             request()->has('role') && request()->role != '',
    //             function ($q) {
    //                 $q->orWhereHas('role', function ($q1) {
    //                     $q1->where('name', 'like', '%' . request()->role . '%');
    //                 });
    //             }
    //         )
    //         ->paginate(15);

    //     return response()->json([
    //         'status' => true,
    //         'data' => $data,
    //     ]);
    // }

    public function options()
    {
        $data = UserRoles::get();

        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }
}
