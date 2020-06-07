<?php

use App\Models\Pizza;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class PizzasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {

            $pizzas = array(
                [
                    'nombre' => 'Pizza Hut',
                    'tamano' => 'Grande',
                    'precio' => 165
                ],
                [
                    'nombre' => 'Pizza Hut',
                    'tamano' => 'Mediana',
                    'precio' => 129
                ],
                [
                    'nombre' => 'Pizza Hut',
                    'tamano' => 'Chica',
                    'precio' => 100
                ],
                [
                    'nombre' => 'Domino´s Pizza',
                    'tamano' => 'Grande',
                    'precio' => 179
                ],
                [
                    'nombre' => 'Domino´s Pizza',
                    'tamano' => 'Mediana',
                    'precio' => 145
                ],
                [
                    'nombre' => 'Domino´s Pizza',
                    'tamano' => 'Chica',
                    'precio' => 90
                ],
                [
                    'nombre' => 'Little Caesars',
                    'tamano' => 'Grande',
                    'precio' => 200
                ],
                [
                    'nombre' => 'Little Caesars',
                    'tamano' => 'Mediana',
                    'precio' => 170
                ],
                [
                    'nombre' => 'Little Caesars',
                    'tamano' => 'Chica',
                    'precio' => 80
                ],
            );

            foreach($pizzas as $pizza){
                Pizza::create($pizza);
            }

        } catch (Exception $e) {
            Log::error(($e->getMessage()));
        }
    }
}
