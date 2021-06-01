<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::upsert([
            ['id'=>12,'title'=>'固定資料1','content'=>'固定內容','price'=>rand(0,300),'quantity'=>20],
            ['id'=>13,'title'=>'固定資料1','content'=>'固定內容','price'=>rand(0,300),'quantity'=>20]
        ],['id'],['price','quantity']);
        //Product::create(['title'=>'測試資料1','content'=>'測試內容','price'=>rand(0,300),'quantity'=>20]);
        //Product::create(['title'=>'測試資料2','content'=>'測試內容','price'=>rand(0,300),'quantity'=>20]);
        //Product::create(['title'=>'測試資料3','content'=>'測試內容','price'=>rand(0,300),'quantity'=>20]);
    }
}
