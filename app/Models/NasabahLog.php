<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NasabahLog extends Model
{
    use HasFactory;

    protected $table = 'nasabah_log';

    protected $primaryKey = 'id'; // Specify the primary key

    protected $fillable = [
        'action',
        'nasabah_id',
        'payload_before',
        'payload_after',
        'created_by',
    ];

}
