<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pasien>
 */
class PasienFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $golonganDarah = ['A', 'B', 'AB', 'O'];
        $jenisKelamin = ['L', 'P'];

        return [
            'nama_pasien' => $this->faker->name(),
            'nik' => $this->faker->randomNumber(9),
            'golongan_darah' => $this->faker->randomElement($golonganDarah),
            'tanggal_lahir' => $this->faker->date('Y-m-d', '2000-01-01'),
            'jenis_kelamin' => $this->faker->randomElement($jenisKelamin),
            'alamat' => $this->faker->address(),
            'telepon' => $this->faker->phoneNumber(),
        ];
    }
}
