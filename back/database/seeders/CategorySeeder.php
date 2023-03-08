<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table("categories")->insert([
            [ "id"=>1,"name"=> "PLATOS","imagen"=> "comida.png","color"=>"red","shop_id"=>1],
            [ "id"=>2,"name"=> "BEBIDAS","imagen"=> "bebidas.png","color"=>"red","shop_id"=>1],
            [ "id"=>3,"name"=> "HAMBURGUESAS","imagen"=> "hamburguesa.png","color"=>"red","shop_id"=>1],

            [ "id"=>4,"name"=> "MASITAS","imagen"=> "1628090050.png","color"=>"#ffff33","shop_id"=>2],
            [ "id"=>5,"name"=> "CAFÉ","imagen"=> "1628090168.jpg","color"=>"#5c2e00","shop_id"=>2],
            [ "id"=>6,"name"=> "SANDWICHS","imagen"=> "1628090315.png","color"=>"#99ff99","shop_id"=>2],
            [ "id"=>7,"name"=> "SODAS","imagen"=> "1628090513.png","color"=>"#ff0000","shop_id"=>2],
            [ "id"=>8,"name"=> "MATES","imagen"=> "1628090746.png","color"=>"#00f5f5","shop_id"=>2],
            [ "id"=>9,"name"=> "JUGOS","imagen"=> "1628090869.png","color"=>"#0000ff","shop_id"=>2],
            [ "id"=>10,"name"=> "TORTAS","imagen"=> "1628091845.jpg","color"=>"#ffb366","shop_id"=>2],
            [ "id"=>11,"name"=> "ILLY CREMA","imagen"=> "1628097380.jpg","color"=>"#ffff99","shop_id"=>2],
            [ "id"=>12,"name"=> "VENTA PARA CLIENTE","imagen"=> "1628456243.png","color"=>"#ff9999","shop_id"=>2],
            [ "id"=>13,"name"=> "ACCESORIOS PARA CAFE","imagen"=> "1628645761.jpg","color"=>"#ff9933","shop_id"=>2],
            [ "id"=>14,"name"=> "MAQUINAS PARA CAFE","imagen"=> "1628645988.png","color"=>"#d66c00","shop_id"=>2],
            [ "id"=>15,"name"=> "PARA PICAR","imagen"=> "1631483893.jpg","color"=>"#d66c00","shop_id"=>2],
            [ "id"=>16,"name"=> "YOGURT","imagen"=> "1635627523.jpg","color"=>"#f2e85e","shop_id"=>2],
            [ "id"=>17,"name"=> "VENTAS AL CLIENTE","imagen"=> "1638053074.jfif', 'CAFES","shop_id"=>2],
            [ "id"=>18,"name"=> "ESPECIALES","imagen"=> "1644860112.jpeg","color"=>"#060fbd","shop_id"=>2],
            [ "id"=>19,"name"=> "GRANIZADO","imagen"=> "1648933479.png","color"=>"#18f0ec","shop_id"=>2],
            [ "id"=>20,"name"=> "GELATINAS","imagen"=> "1649886904.webp","color"=>"#cf3d15","shop_id"=>2],
            [ "id"=>21,"name"=> "GOLOSINAS","imagen"=> "1651256070.jpg","color"=>"#cf3d15","shop_id"=>2],

            [ "id"=>22,"name"=> "COPAS","imagen"=> "1673394746.jpg","color"=>"#4268ad","shop_id"=>3],
            [ "id"=>23,"name"=> "HELADOS","imagen"=> "1673407628.jpg","color"=>"#4268ad","shop_id"=>3],
            [ "id"=>24,"name"=> "FRAPU VACAFRIA","imagen"=> "1673407756.png","color"=>"#4268ad","shop_id"=>3],
            [ "id"=>25,"name"=> "FRAPPE","imagen"=> "1673407850.webp","color"=>"#4268ad","shop_id"=>3],
            [ "id"=>26,"name"=> "SUELTOS","imagen"=> "1673476029.jpg","color"=>"#baa145","shop_id"=>3],
            [ "id"=>27,"name"=> "GRAN PROMOCION","imagen"=> "1674228582.png","color"=>"#4268ad","shop_id"=>3],


        ]);
    }
}
