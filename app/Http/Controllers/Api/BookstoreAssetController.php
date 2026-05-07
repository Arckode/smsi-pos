<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookstoreAssetRequest;
use App\Models\BookstoreAsset;
use App\Models\MenuSubmodule;
use Illuminate\Http\JsonResponse;

class BookstoreAssetController extends Controller
{
    protected const SUBMODULE_URL = '/assets';

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

    public function index(): JsonResponse
    {
        $this->authorizeSubmoduleAction('read');

        return response()->json([
            'status' => true,
            'data' => BookstoreAsset::paginate(15),
        ]);
    }

    public function store(BookstoreAssetRequest $request): JsonResponse
    {
        $this->authorizeSubmoduleAction('create');

        $asset = BookstoreAsset::create($request->validated());

        return response()->json([
            'status' => true,
            'data' => $asset,
            'message' => 'Bookstore asset created successfully.',
        ], 201);
    }

    public function show(BookstoreAsset $asset): JsonResponse
    {
        $this->authorizeSubmoduleAction('read');

        return response()->json([
            'status' => true,
            'data' => $asset,
        ]);
    }

    public function update(BookstoreAssetRequest $request, BookstoreAsset $asset): JsonResponse
    {
        $this->authorizeSubmoduleAction('update');

        $asset->update($request->validated());

        return response()->json([
            'status' => true,
            'data' => $asset,
            'message' => 'Bookstore asset updated successfully.',
        ]);
    }

    public function destroy(BookstoreAsset $asset): JsonResponse
    {
        $this->authorizeSubmoduleAction('delete');

        $asset->delete();

        return response()->json([
            'status' => true,
            'message' => 'Bookstore asset deleted successfully.',
        ]);
    }

    public function options(): JsonResponse
    {
        $this->authorizeSubmoduleAction('read');

        $options = BookstoreAsset::select('id', 'name', 'isbn_sku')->get();

        return response()->json([
            'status' => true,
            'data' => ['options' => $options],
        ]);
    }

    public function tables(string $month, string $year): JsonResponse
    {
        $this->authorizeSubmoduleAction('read');

        $assets = BookstoreAsset::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get();

        return response()->json([
            'status' => true,
            'data' => ['table' => $assets],
        ]);
    }

    public function history(string $assetType, string $month, string $year): JsonResponse
    {
        $this->authorizeSubmoduleAction('read');

        $assets = BookstoreAsset::where('asset_type', $assetType)
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get();

        return response()->json([
            'status' => true,
            'data' => ['history' => $assets],
        ]);
    }
}
