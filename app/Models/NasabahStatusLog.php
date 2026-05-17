<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NasabahStatusLog extends Model
{
    use HasFactory;

    protected $table = 'nasabah_status_log';

    protected $primaryKey = 'id'; // Specify the primary key

    protected $fillable = [
        'nasabah_id',
        'status_before',
        'status_after',
        'status_changed_at',
        'created_by',
    ];

}
