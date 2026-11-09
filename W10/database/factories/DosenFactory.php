<?php

namespace Database\Factories;

use App\Models\Dosen;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Dosen>
 */
class DosenFactory extends Factory
{
    protected $model = Dosen::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = fake('id_ID');

        return [
            'nip' => $faker->unique()->numerify('19##########'),
            'nama' => $faker->name(),
            'departemen' => $faker->randomElement([
                'Teknik Informatika',
                'Sistem Informasi',
                'Teknik Komputer',
                'Teknologi Informasi',
            ]),
            'is_active' => $faker->boolean(90),
        ];
    }
}
