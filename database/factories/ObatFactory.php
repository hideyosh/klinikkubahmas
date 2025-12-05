<?php

namespace Database\Factories;

use App\Models\Obat;
use Illuminate\Database\Eloquent\Factories\Factory;

class ObatFactory extends Factory
{
    protected $model = Obat::class;

    public function definition(): array
    {
        $kategori = ['tablet', 'sirup', 'kapsul', 'salep'];

        return [
            'nama_obat' => $this->faker->unique()->words(2, true),
            'kategori' => $this->faker->randomElement($kategori),
            'stok' => $this->faker->numberBetween(0, 200),
            'harga' => $this->faker->randomFloat(2, 1000, 50000),
        ];
    }
}
