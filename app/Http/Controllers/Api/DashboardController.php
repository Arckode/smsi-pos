<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Edocs\Edoc;
use App\Models\Edocs\EdocStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $statusIds = [1, 5, 9];

            $latestStatusesSubquery = EdocStatus::select('edoc_id', DB::raw('MAX(created_at) as latest_created_at'))
                ->groupBy('edoc_id');

            $latestStatusRecordsSubquery = EdocStatus::select('edoc_statuses.edoc_id', 'status_id', 'created_at')
                ->joinSub($latestStatusesSubquery, 'latest_statuses', function ($join) {
                    $join->on('edoc_statuses.edoc_id', '=', 'latest_statuses.edoc_id')
                        ->on('edoc_statuses.created_at', '=', 'latest_statuses.latest_created_at');
                });

            $results = EdocStatus::joinSub($latestStatusRecordsSubquery, 'latest_statuses', function ($join) {
                $join->on('edoc_statuses.edoc_id', '=', 'latest_statuses.edoc_id')
                    ->on('edoc_statuses.status_id', '=', 'latest_statuses.status_id')
                    ->on('edoc_statuses.created_at', '=', 'latest_statuses.created_at');
            })
                ->whereIn('edoc_statuses.status_id', $statusIds)
                ->groupBy('edoc_statuses.status_id')
                ->select('edoc_statuses.status_id', DB::raw('COUNT(DISTINCT edoc_statuses.edoc_id) as count'))
                ->get();

            $formattedResults = $results->keyBy('status_id')->map(function ($item) {
                return $item->count;
            });

            return response()->json([
                "status" => true,
                "data" => $formattedResults
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
