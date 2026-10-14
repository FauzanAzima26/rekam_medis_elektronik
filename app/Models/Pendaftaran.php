<?php

namespace App\Models;

use App\Models\Pasien;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pendaftaran extends Model
{
    use HasUuids;

    protected $fillable = [
        'pasien_id',
        'tanggal_kunjungan',
        'no_antrean',
        'jenis_kunjungan',
        'keluhan',
        'status',
    ];

    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }
}
