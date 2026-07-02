<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NasabahDocumentLog extends Model
{
    use HasFactory;

    protected $table = 'nasabah_document_log';

    protected $fillable = [
        'nasabah_id',
        'document_type',
        'value_before',
        'value_after',
        'created_by',
    ];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class, 'nasabah_id');
    }
    public function document()
    {
        return $this->belongsTo(NasabahDocument::class, 'document_type', 'doc_type');
    }
}
