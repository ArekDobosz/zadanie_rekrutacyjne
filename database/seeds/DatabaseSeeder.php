<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $products = [
        	'Piłka',
        	'Buty sportowe',
        	'Skarpetki',
        	'Dresy piłkarskie',
        	'Bluzka',
        	'T-shirt',
        	'Kurtka przeciwdeszczowa',
        	'Kurtka zimowa'
        ];

        $faker = Faker::create();

        $id = 1;

        foreach($products as $product) {

        	DB::table('products')->insert([
        		'name' => $product,
        		'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisYear()
        	]);

            DB::table('prices')->insert([
                'product_id' => $id++,
                'price' => $faker->numberBetween($min = 10, $max = 2000)
            ]);

        }

        

    }
}
