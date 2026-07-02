<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NasabahDocument extends Model
{
    use HasFactory;

    protected $table = 'nasabah_documents';

    protected $fillable = [
        'nasabah_id',
        'doc_type',
        'location_url',
        'status',
        'uploaded_by',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class, 'nasabah_id');
    }

    public function logs()
    {
        return $this->hasMany(NasabahDocumentLog::class, 'nasabah_id', 'nasabah_id');
    }
}
