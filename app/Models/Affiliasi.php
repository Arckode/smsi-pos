<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affiliasi extends Model
{
    use HasFactory;

    protected $table = 'affiliasi';

    protected $primaryKey = 'id'; // Specify the primary key

    protected $fillable = [
        'nama_affiliasi',
        'kota',
        'no_telepon',
        'email',
        'pic_name',
        'status',
    ];

    // Relationships
    public function nasabah()
    {
        return $this->hasMany(Nasabah::class, 'affiliasi_id', 'id');
    }
}
