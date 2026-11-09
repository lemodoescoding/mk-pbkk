<?php

namespace App\Models;

use Database\Factories\TugasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['judul', 'mata_kuliah', 'dosen_id', 'deadline', 'status'])]
class Tugas extends Model
{
    /** @use HasFactory<TugasFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'deadline' => 'datetime',
        ];
    }

    public function dosen(): BelongsTo
    {
        return $this->belongsTo(Dosen::class);
    }
}
