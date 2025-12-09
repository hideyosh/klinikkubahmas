<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RMedisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pasien'             => $this->faker->name(),
            'nama_obat'          => obat::factory(),
            'Diagnosa_Penyakit'  => $this->faker->sentence(3),
            'Tindak_Lanjut'      => $this->faker->sentence(10),
            'tahun_Periksa'      => fake()->numberBetween(2021, 2024),
            'status' => fake()->randomElement(['sudah diperiksa', 'belum diperiksa']),
        ];
    }
}
