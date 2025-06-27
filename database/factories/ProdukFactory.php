<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produk>
 */
class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_produk' => $this->faker->words(2, true), // contoh: "Meja Lipat"
            'kode_produk' => strtoupper($this->faker->unique()->bothify('PRD###')), // contoh: PRD123
            'kategori' => $this->faker->randomElement(['Elektronik', 'Furnitur', 'Pakaian']),
            'satuan' => $this->faker->randomElement(['pcs', 'unit', 'lusin']),
        ];
    }
}
