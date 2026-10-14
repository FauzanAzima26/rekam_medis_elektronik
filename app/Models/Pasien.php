<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pasien extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'no_rm',
        'nama_lengkap',
        'tanggal_lahir',
        'gender',
        'usia',
        'no_hp',
        'alamat',
        'jenis_pasien',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
        ];
    }

    public function pendaftaran(): HasMany
    {
        return $this->hasMany(Pendaftaran::class, 'pasien_id');
    }
}
