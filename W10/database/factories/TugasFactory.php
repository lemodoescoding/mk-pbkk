<?php

namespace Database\Factories;

use App\Models\Dosen;
use App\Models\Tugas;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Tugas>
 */
class TugasFactory extends Factory
{
    protected $model = Tugas::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = fake('id_ID');

        return [
            'judul' => $faker->sentence(4),
            'mata_kuliah' => $faker->randomElement([
                'Pemrograman Berbasis Kerangka Kerja',
                'Basis Data',
                'Struktur Data',
                'Pemrograman Web',
                'Kecerdasan Artifisial',
            ]),
            'dosen_id' => Dosen::factory(),
            'deadline' => $faker->dateTimeBetween('-1 week', '+2 months'),
            'status' => $faker->randomElement(['aktif', 'aktif', 'selesai']),
        ];
    }

    public function aktif(): static
    {
        return $this->state(fn () => [
            'status' => 'aktif',
            'deadline' => now()->addWeeks(2),
        ]);
    }
}
