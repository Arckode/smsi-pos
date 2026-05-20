<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAccessRequest;
use App\Models\MenuModule;
use App\Models\MenuSubmodule;
use App\Models\User;
use App\Models\MenuUserAccess;
use App\Models\MenuUserSubmodulePermission;
use App\Models\Affiliasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AffiliasiController extends Controller
{
    protected const SUBMODULE_URL = '/management/affiliasi';

    protected function authorizeSubmoduleAction(string $action): void
    {
        $subModule = MenuSubmodule::where('url', self::SUBMODULE_URL)->first();

        if (! $subModule) {
            abort(403, 'Affiliasi submodule is not configured.');
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

        $data = Affiliasi::when(
                request()->has('search') && request()->search != '',
                function ($q) {
                    $q->where('nama_affiliasi', 'like', '%' . request()->search . '%')
                        ->orWhere('kota', 'like', '%' . request()->search . '%');
                }
            )->when(
                request()->has('status') && request()->status != '',
                function ($q) {
                    $q->where('status', request()->status === 'Active' ? 1 : 0);
                }
            )->paginate(10);

        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {
        $affiliasi = Affiliasi::create($request->all());
        return response()->json($affiliasi, 201);
    }

    public function options()
    {
        $data = Affiliasi::select('id', 'nama_affiliasi')->where('status', 1)->get();

        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
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
}
