<?php

use Illuminate\Database\Seeder;

class StoreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Busca os dados
        $stores = \App\Store::All();

        foreach($stores as $store)
        {            
            $store->products()->save(factory(\App\Product::class)->make());
        }


    }
}
