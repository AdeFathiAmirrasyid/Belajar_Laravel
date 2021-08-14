<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use phpDocumentor\Reflection\Types\Nullable;

class SeedProduct extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$faker = Faker::create('id_ID');

    	for($i = 1; $i <= 5; $i++){
            DB::table('products')->insert([
                'code' => $faker->unique()->buildingNumber,
                'product' => $faker->word,
                'stock' => $faker->randomDigit,
                'varian' => $faker->word,
                'keterangan' => $faker->text,
                // 'image' =>  $faker->imageUrl($width = 640,$height = 480),
                'category_id' => rand(1,5)

            ]);
        }
        // DB::table('products')->insert([
        //     'code' => '1234' ,
        //     'name' => 'indomie',
        //     'stock' => '20',
        //     'varian' => '4 rasa',
        //     'description' => 'mudah di seduh',
        //     'image' => 'indomie.jpg'
        // ]);
    }
}
