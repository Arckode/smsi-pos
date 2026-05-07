<?php

namespace App\Console\Commands;

use App\Enums\EdocStatus as EnumsEdocStatus;
use App\Models\Edocs\EdocStatus;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UpdateEdocStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'edoc:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Edoc Status To Received by User';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            DB::beginTransaction();

            $latestStatusesSubquery = EdocStatus::select('edoc_id', DB::raw('MAX(created_at) as latest_created_at'))
                ->groupBy('edoc_id');

            $latestStatusRecordsSubquery = EdocStatus::select('edoc_statuses.id', 'edoc_statuses.edoc_id', 'status_id', 'created_at')
                ->joinSub($latestStatusesSubquery, 'latest_statuses', function ($join) {
                    $join->on('edoc_statuses.edoc_id', '=', 'latest_statuses.edoc_id')
                        ->on('edoc_statuses.created_at', '=', 'latest_statuses.latest_created_at');
                });

            $verifiedEdocs = EdocStatus::joinSub($latestStatusRecordsSubquery, 'latest_statuses', function ($join) {
                $join->on('edoc_statuses.edoc_id', '=', 'latest_statuses.edoc_id')
                    ->on('edoc_statuses.status_id', '=', 'latest_statuses.status_id')
                    ->on('edoc_statuses.created_at', '=', 'latest_statuses.created_at');
            })
                ->where('edoc_statuses.status_id', EnumsEdocStatus::VERIFIKASI_DITERIMA_SEKERTARIS->value)
                ->select('edoc_statuses.edoc_id', 'edoc_statuses.created_at')
                ->whereRaw('DATEDIFF(NOW(), edoc_statuses.created_at) >= 2')
                ->get();

            foreach ($verifiedEdocs as $edoc) {
                $date = Carbon::parse($edoc["created_at"]);

                $day = $date->dayOfWeek;
                $month = $date->month;
                $dateToCheck = $date->toDateString();

                $url = "https://api-harilibur.vercel.app/api?month={$month}";

                $response = Http::get($url);

                $dateFound = null;

                if ($response->successful()) {
                    $holidays = $response->json();

                    $dateFound = collect($holidays)->contains(function ($holiday) use ($dateToCheck) {
                        return $holiday['holiday_date'] === $dateToCheck;
                    });
                }

                if ($dateFound === false) {
                    if ($day != 0 && $day != 6) {
                        $edocStatus = new EdocStatus();

                        $edocStatus->edoc_id = $edoc["edoc_id"];
                        $edocStatus->status_id = EnumsEdocStatus::DITERIMA_OLEH_USER->value;
                        $edocStatus->user_id = null;
                        $edocStatus->note = "Updated Automatically by System";

                        $edocStatus->save();
                    }
                } 
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }
    }
}
