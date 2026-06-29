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

    public function details()
    {
        return $this->hasMany(BatchDetailNasabah::class, 'batch_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

}
