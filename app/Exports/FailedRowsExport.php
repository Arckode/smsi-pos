<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;

class FailedRowsExport implements FromCollection
{
    protected $failures;

    public function __construct(array $failures)
    {
        $this->failures = collect($failures);
    }

    public function collection()
    {
        // Return the failed rows as a collection to be exported
        return $this->failures;
    }
}
