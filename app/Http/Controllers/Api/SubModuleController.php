<?php

namespace App\Http\Controllers\Api;

use App\Models\SubModule;
use Illuminate\Http\Request;

class SubModuleController extends Controller
{
    public function index()
    {
        $subModules = SubModule::all();
        return response()->json($subModules);
    }

    public function store(Request $request)
    {
        $subModule = SubModule::create($request->all());
        return response()->json($subModule, 201);
    }

    public function show(SubModule $subModule)
    {
        return response()->json($subModule);
    }

    public function update(Request $request, SubModule $subModule)
    {
        $subModule->update($request->all());
        return response()->json($subModule);
    }

    public function destroy(SubModule $subModule)
    {
        $subModule->delete();
        return response()->json(null, 204);
    }
}
