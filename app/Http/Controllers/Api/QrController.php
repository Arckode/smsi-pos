<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Batch\Batch;
use App\Models\Edocs\Edoc;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QrController extends Controller
{
    private $errStatusCode;

    public function __construct()
    {
        $this->errStatusCode = 500;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

    public function showByQr(string $number): JsonResponse
    {
        try {
            $cek = Edoc::where('number', $number)->orWhere('label', $number)->exists();

            if ($cek) {
                $data = $this->showEdocByQr($number);
                $type = 'edoc';
            } else {
                $data = $this->showBatchByQr($number);
                $type = 'batch';
            }

            return response()->json([
                'status' => true,
                'message' => 'Data Successfully Retrieved',
                'data' => $data,
                'type' => $type,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ], $this->errStatusCode);
        }
    }

    private function showEdocByQr(string $number)
    {
        try {
            $relations = [
                "details",
                'statuses' => function ($q) {
                    $q->select('id', 'edoc_id', 'status_id', 'user_id', 'note', 'created_at')->orderBy('created_at', 'DESC');
                },
                'statuses.dictEdocStatus:id,status_code,status_message',
                'user:id,unit_id,name,role,email',
                'user.unit:id,name'
            ];

            $doc = Edoc::with($relations)->where('number', $number)->orWhere('label', $number)->first();

            if (!$doc) {
                throw new ModelNotFoundException("Edoc Not Found");
            }

            return $doc;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    private function showBatchByQr(string $number)
    {
        try {
            $relations = [
                "details",
                "details.edoc.unit",
                'statuses' => function ($q) {
                    $q->select('id', 'batch_id', 'status_id', 'user_id', 'created_at')->orderBy('created_at', 'DESC');
                },
                'statuses.dictBatchStatus:id,status_code,status_message',
                'statuses.user:id,name',
            ];

            $batch = Batch::with($relations)->where('number', $number)->first();

            if (!$batch) {
                throw new ModelNotFoundException("Batch Not Found");
            }

            return $batch;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
