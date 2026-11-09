<?php

namespace Database\Factories;

use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Mahasiswa>
 */
class MahasiswaFactory extends Factory
{
    protected $model = Mahasiswa::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = fake('id_ID');

        return [
            'nrp' => $faker->unique()->numerify('5025######'),
            'nama' => $faker->name(),
            'departemen' => $faker->randomElement([
                'Teknik Informatika',
                'Sistem Informasi',
                'Teknik Komputer',
                'Teknologi Informasi',
            ]),
            'angkatan' => $faker->numberBetween(2021, 2026),
            'is_active' => $faker->boolean(80),
        ];
    }

    public function inactive(): static
    {
        return $this->state(fn () => ['is_active' => false]);
    }
}
