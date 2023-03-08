<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table("products")->insert([
            [ "name"=> "PLATOS","price"=>0,"imagen"=> "comida.png","color"=>"red","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>1],
            
            [ "name"=> "LOMO SALTEADO","price"=>35.00,"imagen"=> "lomo.png","color"=>"red","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>1],
            [ "name"=> "AEROPUERTO 2x1","price"=>15.00,"imagen"=> "aeropuerto.png","color"=>"green","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>1],
            [ "name"=> "TALLARIN SALTEADO","price"=>30.00,"imagen"=> "tallarin.png","color"=>"green","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>1],
            [ "name"=> "ARROZ CHAUFA","price"=>25.00,"imagen"=> "chaufa.jpeg","color"=>"green","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>1],
            [ "name"=> "AEROPUERTO","price"=>30.00,"imagen"=> "1630435698.jpeg","color"=>"#005c00","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>1],
            [ "name"=> "PORCIÓN DE CARNE","price"=>10.00,"imagen"=> "1633381589.jpg","color"=>"#00ffff","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>1],
            [ "name"=> "PORCIÓN DE ARROZ","price"=>8.00,"imagen"=> "1633381697.jpg","color"=>"#00ffff","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>1],
            [ "name"=> "PORCIÓN DE POLLO","price"=>10.00,"imagen"=> "1633381795.jpg","color"=>"#00ffff","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>1],
            [ "name"=> "ARROZ CON POLLO","price"=>35.00,"imagen"=> "1636225903.jpg","color"=>"#5c1d1d","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>1],
            [ "name"=> "CALDO DE GALLINA","price"=>20.00,"imagen"=> "1644510717.jpeg","color"=>"#d9cf62","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>1],
            [ "name"=> "Menudito","price"=>25.00,"imagen"=> "1645724106.jpg","color"=>"#856f2d","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>1],
            [ "name"=> "POLLO AL CILINDRO","price"=>30.00,"imagen"=> "1647104573.png","color"=>"#7d0606","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>1],
            [ "name"=> "CERDO AL CILINDRO","price"=>30.00,"imagen"=> "1647104628.jpg","color"=>"#7d0505","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>1],
            [ "name"=> "POLLO ENTERO","price"=>80.00,"imagen"=> "1648400853.jpg","color"=>"#cfbc5f","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>1],
            [ "name"=> "Ceviche","price"=>25.00,"imagen"=> "","color"=>"","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>1],

            [ "name"=> "CHICHA MORADA","price"=>5.00,"imagen"=> "chicha.png","color"=>"blue","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>2],
            [ "name"=> "SODA","price"=>9.00,"imagen"=> "1626968877.png","color"=>"#d12424","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>2],
            [ "name"=> "AQUARIUS","price"=>9.00,"imagen"=> "1626969533.png","color"=>"#eb1a1a","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>2],
            [ "name"=> "AGUA 500 ML","price"=>8.00,"imagen"=> "1626969593.jpg","color"=>"#eb1a1a","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>2],
            [ "name"=> "PEPSI 7UP GUARANA H20","price"=>9.00,"imagen"=> "1626969680.png","color"=>"#eb1a1a","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>2],
            [ "name"=> "INCA KOLA DE 300 ml","price"=>5.00,"imagen"=> "1626969718.png","color"=>"#eb1a1a","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>2],
            [ "name"=> "INKA KOLA DE 600 ml","price"=>9.00,"imagen"=> "1627056687.jpg","color"=>"#eb1a1a","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>2],
            [ "name"=> "CHICHA MORADA 1 LITRO","price"=>12.00,"imagen"=> "1628963230.jpg","color"=>"#0000f5","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>2],
            [ "name"=> "SODA DE 2Ltrs","price"=>20.00,"imagen"=> "","color"=>"","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>2],
            [ "name"=> "JARRA DE CHICHA","price"=>9.00,"imagen"=> "1649367508.jpg","color"=>"#472727","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>2],
            [ "name"=> "SODA 2 LITROS","price"=>20.00,"imagen"=> "1650397192.jpg","color"=>"#2dbdba","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>2],
            [ "name"=> "INCA KOLA 3 LTRS","price"=>25.00,"imagen"=> "1650736733.webp","color"=>"#ebd31e","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>2],
            [ "name"=> "INCA KOLA 1 LITRO","price"=>15.00,"imagen"=> "1657991011.gif","color"=>"#d8db18","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>2],

            [ "name"=> "HAMBURGUESA SIMPLE","price"=>30.00,"imagen"=> "1647104690.png","color"=>"#7d0505","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>3],
            [ "name"=> "COMBO DUO SIMPLE","price"=>35.00,"imagen"=> "1655312876.jpeg","color"=>"#db2323","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>3],
            [ "name"=> "COMBO DUO SABOR PERU","price"=>45.00,"imagen"=> "1655312930.jpeg","color"=>"#db2323","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>3],
            [ "name"=> "HAMBURGUESA PERUANA","price"=>35.00,"imagen"=> "1655841952.jpeg","color"=>"#bd3535","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>3],


            [ "name"=> "CROISSANT","price"=>7.00,"imagen"=> "1628091369.png","color"=>"#ffff33","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>4],
            [ "name"=> "EMPANADAS DE QUESO","price"=>6.00,"imagen"=> "1628091491.png","color"=>"#ffff33","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>4],
            [ "name"=> "ROLLO DE QUESO","price"=>6.00,"imagen"=> "1628091616.png","color"=>"#ffff33","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>4],
            [ "name"=> "BOMBITA","price"=>5.00,"imagen"=> "1628286051.jpeg","color"=>"#00f5f5","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>4],
            [ "name"=> "QUEQUE MARMOLADO","price"=>5.00,"imagen"=> "1634944459.jpg","color"=>"#380d0d","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>4],
            [ "name"=> "DONAS","price"=>6.00,"imagen"=> "1636669447.jpg","color"=>"#380606","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>4],
            [ "name"=> "Pie de limon","price"=>12.00,"imagen"=> "1639442611.jpg","color"=>"#7bf54e","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>4],

            [ "name"=> "EXPRESS","price"=>10.00,"imagen"=> "1628093134.jpg","color"=>"#5c2e00","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>5],
            [ "name"=> "CAFE LATE","price"=>16.00,"imagen"=> "1628093208.jpg","color"=>"#5c2e00","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>5],
            [ "name"=> "CAPUCHINO","price"=>15.00,"imagen"=> "1628094829.jpg","color"=>"#5c2e00","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>5],
            [ "name"=> "AMERICANO","price"=>12.00,"imagen"=> "1628094875.jpg","color"=>"#5c2e00","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>5],
            [ "name"=> "SUBMARINO","price"=>15.00,"imagen"=> "1631375099.png","color"=>"#ffff99","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>5],
            [ "name"=> "ESPRESSO DOBLE","price"=>15.00,"imagen"=> "1631487296.jpg","color"=>"#a35200","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>5],
            [ "name"=> "CAPUCHINO DOBLE","price"=>22.00,"imagen"=> "1631487361.jpg","color"=>"#a35200","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>5],
            [ "name"=> "AMERICANO DOBLE","price"=>18.00,"imagen"=> "1631487450.jpg","color"=>"#a35200","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>5],
            [ "name"=> "MOCA","price"=>12.00,"imagen"=> "1631487493.jpg","color"=>"#a35200","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>5],
            [ "name"=> "SUBMARINO A MITAD DE PRECIO","price"=>10.00,"imagen"=> "1632011719.jpg","color"=>"#a35200","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>5],

            [ "name"=> "no","price"=>9.00,"imagen"=> "1628091616.png","color"=>"#99ff99","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>6],
            [ "name"=> "DOBLE","price"=>12.00,"imagen"=> "1628286010.jpg","color"=>"#ffff99","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>6],
            [ "name"=> "SIMPLE","price"=>10.00,"imagen"=> "1628204770.jpg","color"=>"#99ff99","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>6],
            [ "name"=> "PAVITA","price"=>12.00,"imagen"=> "1631484324.jpg","color"=>"#ffcc99","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>6],
            [ "name"=> "SANDWICH CLUP (SIMPLE)","price"=>20.00,"imagen"=> "1649634802.jpg","color"=>"#929642","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>6],
            [ "name"=> "SANDWICH CLUP (DOBLE)","price"=>32.00,"imagen"=> "1649634877.jpg","color"=>"#b5604a","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>6],

            [ "name"=> "SODAS","price"=>9.00,"imagen"=> "1667759336.jpg","color"=>"#ff0000","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>7],
            [ "name"=> "FANTA","price"=>9.00,"imagen"=> "1628096474.jpg","color"=>"#ff0000","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>7],
            [ "name"=> "SPRITE","price"=>9.00,"imagen"=> "1628096492.jpg","color"=>"#ff0000","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>7],
            [ "name"=> "AGUA","price"=>8.00,"imagen"=> "1628096532.jpg","color"=>"#ff0000","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>7],
            [ "name"=> "RED BULL","price"=>15.00,"imagen"=> "1628096578.jpg","color"=>"#ff0000","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>7],
            
            [ "name"=> "MANZANILLA","price"=>5.00,"imagen"=> "1628095037.jpg","color"=>"#00f5f5","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>8],
            [ "name"=> "ANIS","price"=>5.00,"imagen"=> "1628095091.jpg","color"=>"#00f5f5","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>8],
            [ "name"=> "COCA","price"=>5.00,"imagen"=> "1628095116.jpg","color"=>"#00f5f5","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>8],
            [ "name"=> "CEDRON","price"=>5.00,"imagen"=> "1628285836.jpg","color"=>"#00f5f5","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>8],
            [ "name"=> "TRIMATE","price"=>5.00,"imagen"=> "1631483492.jpg","color"=>"#ffff33","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>8],
            [ "name"=> "TE","price"=>5.00,"imagen"=> "1631572323.jpeg","color"=>"#ffe6cc","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>8],

            [ "name"=> "LIMON CON AGUA","price"=>9.00,"imagen"=> "1628095670.jpg","color"=>"#0000ff","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>9],
            [ "name"=> "PAPAYA CON AGUA","price"=>9.00,"imagen"=> "1628095968.jpg","color"=>"#0000ff","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>9],
            [ "name"=> "PAPAYA CON LECHE","price"=>10.00,"imagen"=> "1628096110.jpg","color"=>"#0000ff","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>9],
            [ "name"=> "LIMON CON LECHE","price"=>10.00,"imagen"=> "1628096134.jpg","color"=>"#0000ff","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>9],
            [ "name"=> "JUGO DE TEMPORADA CON AGUA","price"=>10.00,"imagen"=> "1631484426.png","color"=>"#ccffff","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>9],
            [ "name"=> "JUGO DE TEMPORADA CON LECHE","price"=>12.00,"imagen"=> "1631484510.png","color"=>"#9bf2f2","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>9],

            [ "name"=> "TORTA DE TRES LECHES","price"=>12.00,"imagen"=> "1628092064.png","color"=>"#ffb366","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>10],
            [ "name"=> "VASO ITALIA","price"=>15.00,"imagen"=> "1628092675.png","color"=>"#ffb366","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>10],
            [ "name"=> "TORTA DEL DÍA","price"=>15.00,"imagen"=> "1628092754.jpg","color"=>"#ffb366","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>10],
            [ "name"=> "BRAZO GITANO","price"=>4.50,"imagen"=> "1634334542.jpg","color"=>"#00f5f5","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>10],
            [ "name"=> "BROWNIE","price"=>10.00,"imagen"=> "1634687468.jpg","color"=>"#a35200","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>10],
            [ "name"=> "BRAZO GITANO","price"=>6.00,"imagen"=> "1634944940.jpg","color"=>"#380d0d","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>10],
            [ "name"=> "MINI TORTA","price"=>36.00,"imagen"=> "1644847184.png","color"=>"#fc1414","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>10],
            [ "name"=> "TORTA","price"=>100.00,"imagen"=> "1653606920.png","color"=>"#72eb57","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>10],
            [ "name"=> "CARTALETAS","price"=>8.00,"imagen"=> "1658959116.jpg","color"=>"#d9d511","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>10],
            [ "name"=> "CANASTA","price"=>40.00,"imagen"=> "1669462652.jpg","color"=>"#f71111","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>10],

            [ "name"=> "PEQUEÑO","price"=>10.00,"imagen"=> "1628097537.jpg","color"=>"#ffff99","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>11],
            [ "name"=> "MEDIANO","price"=>15.00,"imagen"=> "1628097599.jpg","color"=>"#ffff99","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>11],
            [ "name"=> "GRANDE","price"=>20.00,"imagen"=> "1628097624.jpg","color"=>"#ffff99","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>11],
        
            [ "name"=> "CAFE EN CAPSULA CLASICO","price"=>145.00,"imagen"=> "1628456398.png","color"=>"#ff0000","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>12],
            [ "name"=> "CAFE EN CAPSULA DESCAFEINADO","price"=>145.00,"imagen"=> "1628456598.jpg","color"=>"#0080ff","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>12],
            [ "name"=> "CAFE INSTANTANEO CLASICO","price"=>82.00,"imagen"=> "1628457646.png","color"=>"#ff0000","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>12],
            [ "name"=> "CAFE MOLIDO CLASICO","price"=>70.00,"imagen"=> "1628457858.jpg","color"=>"#ff0000","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>12],
            [ "name"=> "CAFE EN SACHET CLASICO","price"=>90.00,"imagen"=> "1628458268.png","color"=>"#ff0000","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>12],
            [ "name"=> "CAFE EN SACHET DESCAFEINADO","price"=>90.00,"imagen"=> "1628458307.jpg","color"=>"#3399ff","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>12],
            [ "name"=> "CAFE EN MOLIDO DESCAFEINADO","price"=>70.00,"imagen"=> "1628458376.jpg","color"=>"#3399ff","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>12],
            [ "name"=> "PAQUETE DE AZUCAR","price"=>60.00,"imagen"=> "1629473713.jpg","color"=>"#99ffff","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>12],
            [ "name"=> "CAFE DE 3 KILOS","price"=>1380.00,"imagen"=> "1635603584.jpg","color"=>"#5c2e00","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>12],

            [ "name"=> "TOMATODO","price"=>95.00,"imagen"=> "1629241570.jpg","color"=>"#ffb366","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>13],      

            [ "name"=> "PAPAS CON QUESO","price"=>20.00,"imagen"=> "1631483947.jpg","color"=>"#d66c00","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>15],
            [ "name"=> "PAPAS CON JAMON Y QUESO","price"=>25.00,"imagen"=> "1631484185.png","color"=>"#d66c00","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>15],
             
            [ "name"=> "YOGURT GRECO","price"=>6.00,"imagen"=> "1635627232.jpg","color"=>"#ffffcc","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>16],
            [ "name"=> "YOGURT FRUTAL","price"=>5.00,"imagen"=> "1635627588.jpg","color"=>"#ffffcc","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>16],
            [ "name"=> "YOGURT EN VASO","price"=>3.00,"imagen"=> "1635627614.jpg","color"=>"#ffffcc","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>16],
            [ "name"=> "COPA DE LECHE","price"=>6.00,"imagen"=> "1635984174.png","color"=>"#ccffff","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>16],

            [ "name"=> "CAFE EN GRANO DE 250 GR","price"=>115.00,"imagen"=> "1638053146.jfif","color"=>"#cf1f1f","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>17],
             
            [ "name"=> "COMBO DESAYUNO BUFFET","price"=>150.00,"imagen"=> "1653581817.jpeg","color"=>"#eda840","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>18],
            [ "name"=> "COMBO AMORE","price"=>60.00,"imagen"=> "1663818434.jpeg", "color"=>"#eda840","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>18],

            [ "name"=> "GRANIZADO","price"=>10.00,"imagen"=> "1648933527.png","color"=>"#f71414","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>19],

            [ "name"=> "GELATINA CON CREMA","price"=>6.00,"imagen"=> "1649886982.webp","color"=>"#d41919","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>20],

            [ "name"=> "GOMITAS","price"=>10.00,"imagen"=> "1651256248.jpg","color"=>"#952996","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>21],



            

           




        ]);
    }
}
