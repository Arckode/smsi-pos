<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchDetailNasabah extends Model
{
    use HasFactory;

    protected $table = 'batch_detail_nasabah';

    protected $primaryKey = 'id'; // Specify the primary key

    protected $fillable = [
        'batch_id',
        'nasabah_id',
        'status'
    ];

}
