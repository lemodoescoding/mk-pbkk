<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Tugas;
use Illuminate\Database\Seeder;

class AkademikSeeder extends Seeder
{
    public function run(): void
    {
        if (! Mahasiswa::exists()) {
            Mahasiswa::factory()->count(40)->create();
        }

        if (! Dosen::exists()) {
            Dosen::factory()->count(12)->create();
        }

        if (! Tugas::exists()) {
            $dosens = Dosen::query()->pluck('id');

            if ($dosens->isNotEmpty()) {
                Tugas::factory()
                    ->count(30)
                    ->create([
                        'dosen_id' => fn () => $dosens->random(),
                    ]);
            }
        }
    }
}
