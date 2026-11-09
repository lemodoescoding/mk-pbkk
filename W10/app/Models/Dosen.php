<?php

namespace App\Models;

use Database\Factories\DosenFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['nip', 'nama', 'departemen', 'is_active'])]
class Dosen extends Model
{
    /** @use HasFactory<DosenFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function tugas(): HasMany
    {
        return $this->hasMany(Tugas::class);
    }
}
