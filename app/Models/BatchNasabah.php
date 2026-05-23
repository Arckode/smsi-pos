<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchNasabah extends Model
{
    use HasFactory;

    protected $table = 'batch_nasabah';
    protected $primaryKey = 'id'; // Specify the primary key

    protected $fillable = [
        'batch_number',
        'tanggal_pengajuan',
        'created_by',
    ];

}
