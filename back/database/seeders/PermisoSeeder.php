<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('permisos')->insert([
            ['id'=>1,'nombre'=>'Usuarios'],
            ['id'=>2,'nombre'=>'Cuis'],
            ['id'=>3,'nombre'=>'Sincronizacion'],
            ['id'=>4,'nombre'=>'Cufd'],
            ['id'=>5,'nombre'=>'Evento Significativo'],
            ['id'=>6,'nombre'=>'Categoria Sabor Peru'],
            ['id'=>7,'nombre'=>'Categoria Cafe Italia'],
            ['id'=>8,'nombre'=>'Categoria Vaca Fria'],
            ['id'=>9,'nombre'=>'Productos Sabor Peru'],
            ['id'=>10,'nombre'=>'Productos Cafe Italia'],
            ['id'=>11,'nombre'=>'Productos Vaca Fria'],
            ['id'=>12,'nombre'=>'Venta Sabor Peru'],
            ['id'=>13,'nombre'=>'Venta Cafe Italia'],
            ['id'=>14,'nombre'=>'Venta Vaca Fria'],
            ['id'=>15,'nombre'=>'Listado Sabor Peru'],
            ['id'=>16,'nombre'=>'Listado Cafe Italia'],
            ['id'=>17,'nombre'=>'Listado Vaca Fria'],
            ['id'=>18,'nombre'=>'Caja Sabor Peru'],
            ['id'=>19,'nombre'=>'Caja Cafe Italia'],
            ['id'=>20,'nombre'=>'Caja Vaca Fria'],
            ['id'=>21,'nombre'=>'Clientes'],

        ]);
    }
}
