<?php

namespace App\Imports;

use App\Models\Payment;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class PaymentRequestImport implements ToModel, WithHeadingRow, WithProgressBar
{
    use Importable;
    protected $failures = [];

    public function model(array $row)
    {
        $existingRecord = Payment::where('uid', $row['uid'])->first();

        if ($existingRecord) {
            // Add the failed row to the failures array
            $this->failures[] = [
                'row' => $row,
                'errors' => ['Duplicate entry for ' . $row['uid']]
            ];
        } else {
            return new Payment([
                'name' => $row['name'],
                'uid' => $row['uid'],
                'branch' => $row['branch'],
                'norek' => $row['norek'],
                'mitra' => $row['mitra'],
                'bank' => $row['bank'],
                'req_date' => $row['req_date'],
                'amount_req' => $row['amount_req']
                // Add other columns as needed
            ]);
        }
    }

    public function onFailure(Failure ...$failures)
    {
        // Handle the failed rows, e.g., export back to the user
        foreach ($failures as $failure) {
            $this->failures[] = [
                'row' => $failure->row(),
                'errors' => $failure->errors()
            ];
        }
    }

    public function getFailures()
    {
        // return $this->failures;
        $formattedFailures = [];
        foreach ($this->failures as $failure) {
            $formattedFailures[] = array_merge($failure['row'], ['errors' => $failure['errors']]);
        }

        return $formattedFailures;
    }
}
