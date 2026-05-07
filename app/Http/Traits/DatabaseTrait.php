<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Schema;

trait DatabaseTrait
{
    public function getTableColumns(string $table, array $execpt)
    {
        if (Schema::hasTable($table)) {
            $columns = Schema::getColumnListing($table);
            $columns = array_diff($columns, $execpt);
            return $columns;
        } else {
            return false;
        }
    }
}
