<?php

namespace App\Models;

use Database\Factories\MahasiswaFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['nrp', 'nama', 'departemen', 'angkatan', 'is_active'])]
class Mahasiswa extends Model
{
    /** @use HasFactory<MahasiswaFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'angkatan' => 'integer',
            'is_active' => 'boolean',
        ];
    }
}
