<?php

use Illuminate\Database\Seeder;

class IndustrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('industries')->insert([
            ['name' => 'Clothing'],
            ['name' => 'Shoes'],
            ['name' => 'Baby'],
            ['name' => 'Health'],
            ['name' => 'Jewelry'],
            ['name' => 'Kid'],
            ['name' => 'Adult'],
            ['name' => 'Beauty'],
            ['name' => 'Home'],
            ['name' => 'Household Appliance'],
            ['name' => 'Outdoor'],
            ['name' => 'Book'],
            ['name' => 'Boutique'],
            ['name' => 'Electronic'],
            ['name' => 'Eyewear'],
            ['name' => 'Flower'],
            ['name' => 'Food'],
            ['name' => 'Game'],
            ['name' => 'Garden'],
            ['name' => 'Grocery'],
            ['name' => 'Office'],
            ['name' => 'Sport'],
            ['name' => 'Travel'],
            ['name' => 'Wedding'],
            ['name' => 'Automotive'],
            ['name' => 'Hobby'],
            ['name' => 'Music'],
            ['name' => 'Drink'],
            ['name' => 'Home Decor'],
            ['name' => 'Rental'],
            ['name' => 'Accessory'],
            ['name' => 'Animal'],
            ['name' => 'Firearm']
        ]);
    }
}
