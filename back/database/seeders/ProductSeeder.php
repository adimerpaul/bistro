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
            [ "name"=> "LOMO SALTEADO","price"=>35.00,"imagen"=> "lomo.png","color"=>"red","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>1,"shop_id"=>1],
            [ "name"=> "AEROPUERTO 2x1","price"=>15.00,"imagen"=> "aeropuerto.png","color"=>"green","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>1,"shop_id"=>1],
            [ "name"=> "TALLARIN SALTEADO","price"=>30.00,"imagen"=> "tallarin.png","color"=>"green","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>1,"shop_id"=>1],
            [ "name"=> "ARROZ CHAUFA","price"=>25.00,"imagen"=> "chaufa.jpeg","color"=>"green","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>1,"shop_id"=>1],
            [ "name"=> "AEROPUERTO","price"=>30.00,"imagen"=> "1630435698.jpeg","color"=>"#005c00","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>1,"shop_id"=>1],
            [ "name"=> "PORCIÓN DE CARNE","price"=>10.00,"imagen"=> "1633381589.jpg","color"=>"#00ffff","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>1,"shop_id"=>1],
            [ "name"=> "PORCIÓN DE ARROZ","price"=>8.00,"imagen"=> "1633381697.jpg","color"=>"#00ffff","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>1,"shop_id"=>1],
            [ "name"=> "PORCIÓN DE POLLO","price"=>10.00,"imagen"=> "1633381795.jpg","color"=>"#00ffff","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>1,"shop_id"=>1],
            [ "name"=> "ARROZ CON POLLO","price"=>35.00,"imagen"=> "1636225903.jpg","color"=>"#5c1d1d","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>1,"shop_id"=>1],
            [ "name"=> "CALDO DE GALLINA","price"=>20.00,"imagen"=> "1644510717.jpeg","color"=>"#d9cf62","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>1,"shop_id"=>1],
            [ "name"=> "Menudito","price"=>25.00,"imagen"=> "1645724106.jpg","color"=>"#856f2d","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>1,"shop_id"=>1],
            [ "name"=> "POLLO AL CILINDRO","price"=>30.00,"imagen"=> "1647104573.png","color"=>"#7d0606","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>1,"shop_id"=>1],
            [ "name"=> "CERDO AL CILINDRO","price"=>30.00,"imagen"=> "1647104628.jpg","color"=>"#7d0505","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>1,"shop_id"=>1],
            [ "name"=> "POLLO ENTERO","price"=>80.00,"imagen"=> "1648400853.jpg","color"=>"#cfbc5f","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>1,"shop_id"=>1],
            [ "name"=> "CEVICHE","price"=>25.00,"imagen"=> "ceviche.png","color"=>"red","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>1,"shop_id"=>1],

            [ "name"=> "CHICHA MORADA","price"=>5.00,"imagen"=> "chicha.png","color"=>"blue","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>2,"shop_id"=>1],
            [ "name"=> "SODA","price"=>9.00,"imagen"=> "1626968877.png","color"=>"#d12424","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>2,"shop_id"=>1],
            [ "name"=> "AQUARIUS","price"=>9.00,"imagen"=> "1626969533.png","color"=>"#eb1a1a","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>2,"shop_id"=>1],
            [ "name"=> "AGUA 500 ML","price"=>8.00,"imagen"=> "1626969593.jpg","color"=>"#eb1a1a","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>2,"shop_id"=>1],
            [ "name"=> "PEPSI 7UP GUARANA H20","price"=>9.00,"imagen"=> "1626969680.png","color"=>"#eb1a1a","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>2,"shop_id"=>1],
            [ "name"=> "INCA KOLA DE 300 ml","price"=>5.00,"imagen"=> "1626969718.png","color"=>"#eb1a1a","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>2,"shop_id"=>1],
            [ "name"=> "INKA KOLA DE 600 ml","price"=>9.00,"imagen"=> "1627056687.jpg","color"=>"#eb1a1a","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>2,"shop_id"=>1],
            [ "name"=> "CHICHA MORADA 1 LITRO","price"=>12.00,"imagen"=> "1628963230.jpg","color"=>"#0000f5","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>2,"shop_id"=>1],
            [ "name"=> "SODA DE 2Ltrs","price"=>20.00,"imagen"=> "1626968877.png","color"=>"#eb1a1a","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>2,"shop_id"=>1],
            [ "name"=> "JARRA DE CHICHA","price"=>9.00,"imagen"=> "1649367508.jpg","color"=>"#472727","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>2,"shop_id"=>1],
            [ "name"=> "SODA 2 LITROS","price"=>20.00,"imagen"=> "1650397192.jpg","color"=>"#2dbdba","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>2,"shop_id"=>1],
            [ "name"=> "INCA KOLA 3 LTRS","price"=>25.00,"imagen"=> "1650736733.webp","color"=>"#ebd31e","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>2,"shop_id"=>1],
            [ "name"=> "INCA KOLA 1 LITRO","price"=>15.00,"imagen"=> "1657991011.gif","color"=>"#d8db18","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>2,"shop_id"=>1],

            [ "name"=> "HAMBURGUESA SIMPLE","price"=>30.00,"imagen"=> "1647104690.png","color"=>"#7d0505","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>3,"shop_id"=>1],
            [ "name"=> "COMBO DUO SIMPLE","price"=>35.00,"imagen"=> "1655312876.jpeg","color"=>"#db2323","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>3,"shop_id"=>1],
            [ "name"=> "COMBO DUO SABOR PERU","price"=>45.00,"imagen"=> "1655312930.jpeg","color"=>"#db2323","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>3,"shop_id"=>1],
            [ "name"=> "HAMBURGUESA PERUANA","price"=>35.00,"imagen"=> "1655841952.jpeg","color"=>"#bd3535","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>3,"shop_id"=>1],


            [ "name"=> "CROISSANT","price"=>7.00,"imagen"=> "1628091369.png","color"=>"#ffff33","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>4,"shop_id"=>2],
            [ "name"=> "EMPANADAS DE QUESO","price"=>6.00,"imagen"=> "1628091491.png","color"=>"#ffff33","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>4,"shop_id"=>2],
            [ "name"=> "ROLLO DE QUESO","price"=>6.00,"imagen"=> "1628091616.png","color"=>"#ffff33","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>4,"shop_id"=>2],
            [ "name"=> "BOMBITA","price"=>5.00,"imagen"=> "1628286051.jpeg","color"=>"#00f5f5","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>4,"shop_id"=>2],
            [ "name"=> "QUEQUE MARMOLADO","price"=>5.00,"imagen"=> "1634944459.jpg","color"=>"#380d0d","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>4,"shop_id"=>2],
            [ "name"=> "DONAS","price"=>6.00,"imagen"=> "1636669447.jpg","color"=>"#380606","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>4,"shop_id"=>2],
            [ "name"=> "Pie de limon","price"=>12.00,"imagen"=> "1639442611.jpg","color"=>"#7bf54e","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>4,"shop_id"=>2],

            [ "name"=> "EXPRESS","price"=>10.00,"imagen"=> "1628093134.jpg","color"=>"#5c2e00","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>5,"shop_id"=>2],
            [ "name"=> "CAFE LATE","price"=>16.00,"imagen"=> "1628093208.jpg","color"=>"#5c2e00","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>5,"shop_id"=>2],
            [ "name"=> "CAPUCHINO","price"=>15.00,"imagen"=> "1628094829.jpg","color"=>"#5c2e00","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>5,"shop_id"=>2],
            [ "name"=> "AMERICANO","price"=>12.00,"imagen"=> "1628094875.jpg","color"=>"#5c2e00","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>5,"shop_id"=>2],
            [ "name"=> "SUBMARINO","price"=>15.00,"imagen"=> "1631375099.png","color"=>"#ffff99","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>5,"shop_id"=>2],
            [ "name"=> "ESPRESSO DOBLE","price"=>15.00,"imagen"=> "1631487296.jpg","color"=>"#a35200","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>5,"shop_id"=>2],
            [ "name"=> "CAPUCHINO DOBLE","price"=>22.00,"imagen"=> "1631487361.jpg","color"=>"#a35200","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>5,"shop_id"=>2],
            [ "name"=> "AMERICANO DOBLE","price"=>18.00,"imagen"=> "1631487450.jpg","color"=>"#a35200","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>5,"shop_id"=>2],
            [ "name"=> "MOCA","price"=>12.00,"imagen"=> "1631487493.jpg","color"=>"#a35200","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>5,"shop_id"=>2],
            [ "name"=> "SUBMARINO A MITAD DE PRECIO","price"=>10.00,"imagen"=> "1632011719.jpg","color"=>"#a35200","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>5,"shop_id"=>2],

            [ "name"=> "no","price"=>9.00,"imagen"=> "1628091616.png","color"=>"#99ff99","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>6,"shop_id"=>2],
            [ "name"=> "DOBLE","price"=>12.00,"imagen"=> "1628286010.jpg","color"=>"#ffff99","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>6,"shop_id"=>2],
            [ "name"=> "SIMPLE","price"=>10.00,"imagen"=> "1628204770.jpg","color"=>"#99ff99","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>6,"shop_id"=>2],
            [ "name"=> "PAVITA","price"=>12.00,"imagen"=> "1631484324.jpg","color"=>"#ffcc99","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>6,"shop_id"=>2],
            [ "name"=> "SANDWICH CLUP (SIMPLE)","price"=>20.00,"imagen"=> "1649634802.jpg","color"=>"#929642","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>6,"shop_id"=>2],
            [ "name"=> "SANDWICH CLUP (DOBLE)","price"=>32.00,"imagen"=> "1649634877.jpg","color"=>"#b5604a","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>6,"shop_id"=>2],

            [ "name"=> "SODAS","price"=>9.00,"imagen"=> "1667759336.jpg","color"=>"#ff0000","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>7,"shop_id"=>2],
            [ "name"=> "FANTA","price"=>9.00,"imagen"=> "1628096474.jpg","color"=>"#ff0000","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>7,"shop_id"=>2],
            [ "name"=> "SPRITE","price"=>9.00,"imagen"=> "1628096492.jpg","color"=>"#ff0000","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>7,"shop_id"=>2],
            [ "name"=> "AGUA","price"=>8.00,"imagen"=> "1628096532.jpg","color"=>"#ff0000","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>7,"shop_id"=>2],
            [ "name"=> "RED BULL","price"=>15.00,"imagen"=> "1628096578.jpg","color"=>"#ff0000","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>7,"shop_id"=>2],

            [ "name"=> "MANZANILLA","price"=>5.00,"imagen"=> "1628095037.jpg","color"=>"#00f5f5","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>8,"shop_id"=>2],
            [ "name"=> "ANIS","price"=>5.00,"imagen"=> "1628095091.jpg","color"=>"#00f5f5","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>8,"shop_id"=>2],
            [ "name"=> "COCA","price"=>5.00,"imagen"=> "1628095116.jpg","color"=>"#00f5f5","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>8,"shop_id"=>2],
            [ "name"=> "CEDRON","price"=>5.00,"imagen"=> "1628285836.jpg","color"=>"#00f5f5","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>8,"shop_id"=>2],
            [ "name"=> "TRIMATE","price"=>5.00,"imagen"=> "1631483492.jpg","color"=>"#ffff33","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>8,"shop_id"=>2],
            [ "name"=> "TE","price"=>5.00,"imagen"=> "1631572323.jpeg","color"=>"#ffe6cc","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>8,"shop_id"=>2],

            [ "name"=> "LIMON CON AGUA","price"=>9.00,"imagen"=> "1628095670.jpg","color"=>"#0000ff","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>9,"shop_id"=>2],
            [ "name"=> "PAPAYA CON AGUA","price"=>9.00,"imagen"=> "1628095968.jpg","color"=>"#0000ff","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>9,"shop_id"=>2],
            [ "name"=> "PAPAYA CON LECHE","price"=>10.00,"imagen"=> "1628096110.jpg","color"=>"#0000ff","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>9,"shop_id"=>2],
            [ "name"=> "LIMON CON LECHE","price"=>10.00,"imagen"=> "1628096134.jpg","color"=>"#0000ff","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>9,"shop_id"=>2],
            [ "name"=> "JUGO DE TEMPORADA CON AGUA","price"=>10.00,"imagen"=> "1631484426.png","color"=>"#ccffff","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>9,"shop_id"=>2],
            [ "name"=> "JUGO DE TEMPORADA CON LECHE","price"=>12.00,"imagen"=> "1631484510.png","color"=>"#9bf2f2","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>9,"shop_id"=>2],

            [ "name"=> "TORTA DE TRES LECHES","price"=>12.00,"imagen"=> "1628092064.png","color"=>"#ffb366","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>10,"shop_id"=>2],
            [ "name"=> "VASO ITALIA","price"=>15.00,"imagen"=> "1628092675.png","color"=>"#ffb366","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>10,"shop_id"=>2],
            [ "name"=> "TORTA DEL DÍA","price"=>15.00,"imagen"=> "1628092754.jpg","color"=>"#ffb366","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>10,"shop_id"=>2],
            [ "name"=> "BRAZO GITANO","price"=>4.50,"imagen"=> "1634334542.jpg","color"=>"#00f5f5","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>10,"shop_id"=>2],
            [ "name"=> "BROWNIE","price"=>10.00,"imagen"=> "1634687468.jpg","color"=>"#a35200","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>10,"shop_id"=>2],
            [ "name"=> "BRAZO GITANO","price"=>6.00,"imagen"=> "1634944940.jpg","color"=>"#380d0d","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>10,"shop_id"=>2],
            [ "name"=> "MINI TORTA","price"=>36.00,"imagen"=> "1644847184.png","color"=>"#fc1414","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>10,"shop_id"=>2],
            [ "name"=> "TORTA","price"=>100.00,"imagen"=> "1653606920.png","color"=>"#72eb57","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>10,"shop_id"=>2],
            [ "name"=> "CARTALETAS","price"=>8.00,"imagen"=> "1658959116.jpg","color"=>"#d9d511","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>10,"shop_id"=>2],
            [ "name"=> "CANASTA","price"=>40.00,"imagen"=> "1669462652.jpg","color"=>"#f71111","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>10,"shop_id"=>2],

            [ "name"=> "PEQUEÑO","price"=>10.00,"imagen"=> "1628097537.jpg","color"=>"#ffff99","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>11,"shop_id"=>2],
            [ "name"=> "MEDIANO","price"=>15.00,"imagen"=> "1628097599.jpg","color"=>"#ffff99","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>11,"shop_id"=>2],
            [ "name"=> "GRANDE","price"=>20.00,"imagen"=> "1628097624.jpg","color"=>"#ffff99","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>11,"shop_id"=>2],

            [ "name"=> "CAFE EN CAPSULA CLASICO","price"=>145.00,"imagen"=> "1628456398.png","color"=>"#ff0000","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>12,"shop_id"=>2],
            [ "name"=> "CAFE EN CAPSULA DESCAFEINADO","price"=>145.00,"imagen"=> "1628456598.jpg","color"=>"#0080ff","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>12,"shop_id"=>2],
            [ "name"=> "CAFE INSTANTANEO CLASICO","price"=>82.00,"imagen"=> "1628457646.png","color"=>"#ff0000","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>12,"shop_id"=>2],
            [ "name"=> "CAFE MOLIDO CLASICO","price"=>70.00,"imagen"=> "1628457858.jpg","color"=>"#ff0000","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>12,"shop_id"=>2],
            [ "name"=> "CAFE EN SACHET CLASICO","price"=>90.00,"imagen"=> "1628458268.png","color"=>"#ff0000","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>12,"shop_id"=>2],
            [ "name"=> "CAFE EN SACHET DESCAFEINADO","price"=>90.00,"imagen"=> "1628458307.jpg","color"=>"#3399ff","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>12,"shop_id"=>2],
            [ "name"=> "CAFE EN MOLIDO DESCAFEINADO","price"=>70.00,"imagen"=> "1628458376.jpg","color"=>"#3399ff","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>12,"shop_id"=>2],
            [ "name"=> "PAQUETE DE AZUCAR","price"=>60.00,"imagen"=> "1629473713.jpg","color"=>"#99ffff","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>12,"shop_id"=>2],
            [ "name"=> "CAFE DE 3 KILOS","price"=>1380.00,"imagen"=> "1635603584.jpg","color"=>"#5c2e00","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>12,"shop_id"=>2],

            [ "name"=> "TOMATODO","price"=>95.00,"imagen"=> "1629241570.jpg","color"=>"#ffb366","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>13,"shop_id"=>2],

            [ "name"=> "PAPAS CON QUESO","price"=>20.00,"imagen"=> "1631483947.jpg","color"=>"#d66c00","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>15,"shop_id"=>2],
            [ "name"=> "PAPAS CON JAMON Y QUESO","price"=>25.00,"imagen"=> "1631484185.png","color"=>"#d66c00","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>15,"shop_id"=>2],

            [ "name"=> "YOGURT GRECO","price"=>6.00,"imagen"=> "1635627232.jpg","color"=>"#ffffcc","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>16,"shop_id"=>2],
            [ "name"=> "YOGURT FRUTAL","price"=>5.00,"imagen"=> "1635627588.jpg","color"=>"#ffffcc","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>16,"shop_id"=>2],
            [ "name"=> "YOGURT EN VASO","price"=>3.00,"imagen"=> "1635627614.jpg","color"=>"#ffffcc","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>16,"shop_id"=>2],
            [ "name"=> "COPA DE LECHE","price"=>6.00,"imagen"=> "1635984174.png","color"=>"#ccffff","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>16,"shop_id"=>2],
//
            [ "name"=> "CAFE EN GRANO DE 250 GR","price"=>115.00,"imagen"=> "1638053146.jfif","color"=>"#cf1f1f","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>17,"shop_id"=>2],

            [ "name"=> "COMBO DESAYUNO BUFFET","price"=>150.00,"imagen"=> "1653581817.jpeg","color"=>"#eda840","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>18,"shop_id"=>2],
            [ "name"=> "COMBO AMORE","price"=>60.00,"imagen"=> "1663818434.jpeg", "color"=>"#eda840","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>18,"shop_id"=>2],

            [ "name"=> "GRANIZADO","price"=>10.00,"imagen"=> "1648933527.png","color"=>"#f71414","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>19,"shop_id"=>2],

            [ "name"=> "GELATINA CON CREMA","price"=>6.00,"imagen"=> "1649886982.webp","color"=>"#d41919","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>20,"shop_id"=>2],

            [ "name"=> "GOMITAS","price"=>10.00,"imagen"=> "1651256248.jpg","color"=>"#952996","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>21,"shop_id"=>2],


            [ "name"=> "COPA MOO BERRY MEDIANO","price"=>27.00,"imagen"=> "1673394898.jpg","color"=>"#47449c","cantidad"=>0,"estado"=>"ACTIVO","category_id"=>22,"shop_id"=>3],
            [ "name"=> "COPA XOXOXO MEDIANO","price"=>27.00, "imagen"=> '1673407577.jpg', "color"=>'#eb8181', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>22,"shop_id"=>3],
            [ "name"=> "COPA PIE DE LIMON MEDIANO","price"=>27.00, "imagen"=>'1673408140.png', "color"=> 'rgb(115,222,209)', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>22,"shop_id"=>3],
            [ "name"=> "COPA CHOCOLATE IN RIO MEDIANO","price"=>27.00,"imagen"=>"1673408210.jpg","color"=> 'rgb(234,180,237)',"cantidad"=>0,"estado"=>"ACTIVO","category_id"=>22,"shop_id"=>3],
            [ "name"=> "COPA VACAFRIA MEDIANO","price"=>27.00,"imagen"=>"1673408262.jpg","color"=> 'rgb(247,231,139)', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>22,"shop_id"=>3],
            [ "name"=> "COPA MOO BERRY GRANDE","price"=>35.00,"imagen"=>"1673409635.webp","color"=> '#47449c', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>22,"shop_id"=>3],
            [ "name"=> "COPA XOXOXO GRANDE","price"=>35.00,"imagen"=>"1673410389.jpg","color"=> '#f09090', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>22,"shop_id"=>3],
            [ "name"=> "COPA PIE DE LIMON MEDIANO","price"=>35.00,"imagen"=>"1673411428.jpg","color"=> 'rgb(115,222,209)', "cantidad"=>0,"estado"=>"INACTIVO","category_id"=>22,"shop_id"=>3],
            [ "name"=> "COPA CHOCOLATE IN RIO GRANDE","price"=>35.00,"imagen"=>"1673410542.jpg","color"=> 'rgb(234,180,237)', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>22,"shop_id"=>3],
            [ "name"=> "COPA VACAFRIA GRANDE","price"=>35.00,"imagen"=>"1673410670.jpg","color"=> 'rgb(247,231,139)', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>22,"shop_id"=>3],
            [ "name"=> "COPA MIX MEDIANO","price"=>27.00,"imagen"=>"1673472782.jpg","color"=> '#328f7f', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>22,"shop_id"=>3],
            [ "name"=> "COPA MIX GRANDE","price"=>35.00,"imagen"=>"1673472824.jpg","color"=> '#287a7d', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>22,"shop_id"=>3],
            [ "name"=> "PIE DE LIMÓN GRANDE","price"=>35.00,"imagen"=>"1675895640.jpg","color"=> '#8a4c4c', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>22,"shop_id"=>3],


            [ "name"=> "HELADO SIMPLE","price"=>12.00,"imagen"=>"1673408764.jpg","color"=> 'rgb(212,214,107)', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>23,"shop_id"=>3],
            [ "name"=> "HELADO DOBLE","price"=>18.00,"imagen"=>"1673408801.jpg","color"=> 'rgb(212,214,107)', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>23,"shop_id"=>3],
            [ "name"=> "HELADO TRIPLE","price"=>25.00,"imagen"=>"1673408834.jpg","color"=> 'rgb(212,214,107)', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>23,"shop_id"=>3],
            [ "name"=> "ENVASE GRANDE","price"=>65.00,"imagen"=>"1673485605.jpg","color"=> '#bd5c5c', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>23,"shop_id"=>3],
            [ "name"=> "ENVASE EXTRA GRANDE","price"=>85.00,"imagen"=>"1673485663.jpg","color"=> '#b34f4f', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>23,"shop_id"=>3],
            [ "name"=> "ENVASE PEQUEÑO","price"=>34.00,"imagen"=>"1673542417.webp","color"=> '#edd8d8', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>23,"shop_id"=>3],
            [ "name"=> "CHOCOSIMPLE!","price"=>15.00,"imagen"=>"1673713263.jpeg","color"=> '#6b5454', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>23,"shop_id"=>3],

            [ "name"=> "FRAPU MEDIANO","price"=>17.00,"imagen"=>"1673408969.webp","color"=> 'rgb(153,242,169)', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>24,"shop_id"=>3],
            [ "name"=> "FRAPU GRANDE","price"=>22.00,"imagen"=>"1673409108.jpg","color"=> 'rgb(153,242,169)', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>24,"shop_id"=>3],
            [ "name"=> "FRAPU VAINILLA","price"=>23.00,"imagen"=>"1673457688.webp","color"=> '#f0eb5d', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>24,"shop_id"=>3],
            [ "name"=> "FRAPU MOCA","price"=>23.00,"imagen"=>"1673457787.jpg","color"=> '#9e682b', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>24,"shop_id"=>3],

            [ "name"=> "MILSHAKE MEDIANO CHOCOLATE","price"=>27.00,"imagen"=>"1673408395.jpg","color"=> 'rgb(237,97,97)', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>25,"shop_id"=>3],
            [ "name"=> "SMOOTHIE MEDIANO FRUTILLA","price"=>27.00,"imagen"=>"1673408556.jpg","color"=> 'rgb(237,97,97)', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>25,"shop_id"=>3],
            [ "name"=> "BROWNIE CON HELADO","price"=>25.00,"imagen"=>"1673410992.jpg","color"=> 'rgb(247,231,139)', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>25,"shop_id"=>3],
            [ "name"=> "FRAPPE DURAZNO","price"=>20.00,"imagen"=>"1673411231.jpg","color"=> 'rgb(247,231,139)', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>25,"shop_id"=>3],
            [ "name"=> "MILSHAKE GRANDE CHOCOLATE","price"=>32.00,"imagen"=>"1673411680.jpg","color"=> '#db6060', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>25,"shop_id"=>3],
            [ "name"=> "SMOOTHIE GRANDE","price"=>30.00,"imagen"=>"1673411804.jpg","color"=> '#e37171', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>25,"shop_id"=>3],
            [ "name"=> "BROWNIE","price"=>10.00,"imagen"=>"1673471232.webp","color"=> '#7d5f47', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>25,"shop_id"=>3],
            [ "name"=> "FRAPPE FRUTILLA","price"=>20.00,"imagen"=>"1673542801.webp","color"=> '#d49292', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>25,"shop_id"=>3],
            [ "name"=> "FRAPPE MARACUYA","price"=>20.00,"imagen"=>"1673542900.jpg","color"=> '#d1d43d', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>25,"shop_id"=>3],
            [ "name"=> "MILSHAKE MEDIANO VAINILLA","price"=>27.00,"imagen"=>"1673544317.jpg","color"=> '#d7e396', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>25,"shop_id"=>3],
            [ "name"=> "MILSHAKE GRANDE VAINILLA","price"=>32.00,"imagen"=>"1673544353.jpg","color"=> '#d7e396', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>25,"shop_id"=>3],
            [ "name"=> "MILSHAKE GRANDE CREMA DE OREO","price"=>32.00,"imagen"=>"1673544444.jpg","color"=> '#6e633b', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>25,"shop_id"=>3],
            [ "name"=> "MILSHAKE MEDIANO CREMA DE OREO","price"=>27.00,"imagen"=>"1673544478.jpg","color"=> '#6e633b', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>25,"shop_id"=>3],
            [ "name"=> "MILSHAKE MEDIANO DULCE DE LECHE","price"=>27.00,"imagen"=>"1673544577.jpg","color"=> '#ebe6d5', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>25,"shop_id"=>3],
            [ "name"=> "MILSHAKE GRANDE DULCE DE LECHE","price"=>32.00,"imagen"=>"1673544618.jpg","color"=> '#ebe6d5', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>25,"shop_id"=>3],
            [ "name"=> "MILSHAKE GRANDE GRANIZADO","price"=>32.00,"imagen"=>"1673545463.jpg","color"=> '#f2f0e9', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>25,"shop_id"=>3],
            [ "name"=> "MILSHAKE MEDIANO GRANIZADO","price"=>27.00,"imagen"=>"1673545500.jpg","color"=> '#f2f0e9', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>25,"shop_id"=>3],
            [ "name"=> "MILSHAKE MEDIANO FRUTILLA","price"=>27.00,"imagen"=>"1673545584.jpg","color"=> '#c95549', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>25,"shop_id"=>3],
            [ "name"=> "MILSHAKE GRANDE FRUTILLA","price"=>32.00,"imagen"=>"1673545617.jpg","color"=> '#c95549', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>25,"shop_id"=>3],
            [ "name"=> "FRAPPE DE PIÑA","price"=>20.00,"imagen"=>"1675635596.jpg","color"=> '#db9c9c', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>25,"shop_id"=>3],

            [ "name"=> "CAPELINA","price"=>2.00,"imagen"=>"1673476373.jpg","color"=> '#94742e',"cantidad"=>0,"estado"=>"ACTIVO","category_id"=>26,"shop_id"=>3],
            [ "name"=> "CONO","price"=>1.00,"imagen"=>"1673476480.jpg","color"=> '#94742e',"cantidad"=>0,"estado"=>"ACTIVO","category_id"=>26,"shop_id"=>3],
            [ "name"=> "PORCION DE CREMA","price"=>4.00,"imagen"=>"1673560585.jpg","color"=> '#f0e9e9',"cantidad"=>0,"estado"=>"ACTIVO","category_id"=>26,"shop_id"=>3],
            [ "name"=> "AGREGADOS GENERICOS","price"=>3.00,"imagen"=>"1673641123.webp","color"=> '#84e387',"cantidad"=>0,"estado"=>"ACTIVO","category_id"=>26,"shop_id"=>3],
            [ "name"=> "BAÑO CHOCOLATE","price"=>4.00,"imagen"=>"1673713407.jpeg","color"=> '#856161', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>26,"shop_id"=>3],
            [ "name"=> "PORCIÓN DE CHOCOLATE","price"=>4.00,"imagen"=>"1675633789.jpg","color"=> '#632626',"cantidad"=>0,"estado"=>"ACTIVO","category_id"=>26,"shop_id"=>3],
            [ "name"=> "JALEAS","price"=>3.00,"imagen"=>"1675634198.jpg","color"=> '#a17a7a', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>26,"shop_id"=>3],

            [ "name"=> "2 DOBLES","price"=>30.00,"imagen"=>"1674228661.png","color"=> '#6ca5eb', "cantidad"=>0,"estado"=>"INACTIVO","category_id"=>27,"shop_id"=>3],
            [ "name"=> "2 FRAPUS MEDIANO","price"=>30.00,"imagen"=>"1674228676.png","color"=> '#6ca5eb',  "cantidad"=>0,"estado"=>"INACTIVO","category_id"=>27,"shop_id"=>3],
            [ "name"=> "DOBLE MAS AGREGADO","price"=>18.00,"imagen"=>"1675895793.jpg","color"=> '#8a4c4c',  "cantidad"=>0,"estado"=>"INACTIVO","category_id"=>27,"shop_id"=>3],
            [ "name"=> "PROMO DE GIGANTES","price"=>110.00,"imagen"=>"1676125727.jpg","color"=> '#38ebdf',  "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>27,"shop_id"=>3],
            [ "name"=> "FRAPU GRANDE","price"=>40.00,"imagen"=>"1676308858.jpeg","color"=> '#6e5151', "cantidad"=>0,"estado"=>"INACTIVO","category_id"=>27,"shop_id"=>3],
            [ "name"=> "BROWNIES CON HELADO","price"=>40.00,"imagen"=>"1676308915.jpeg","color"=> '#6e5151', "cantidad"=>0,"estado"=>"INACTIVO","category_id"=>27,"shop_id"=>3],
            [ "name"=> "COPA MIX GRANDE","price"=>30.00,"imagen"=>"1676683055.png","color"=> '#5cd1d1', "cantidad"=>0,"estado"=>"INACTIVO","category_id"=>27,"shop_id"=>3],
            [ "name"=> "HELADO TRIPLE","price"=>20.00,"imagen"=>"1676684173.jpg","color"=> '#3eeded', "cantidad"=>0,"estado"=>"INACTIVO","category_id"=>27,"shop_id"=>3],
            [ "name"=> "FRAPU VAINILLA & MOCA + TOPPING","price"=>23.00,"imagen"=>"1677959823.jpeg","color"=> '#33328a',"cantidad"=>0,"estado"=>"INACTIVO","category_id"=>27,"shop_id"=>3],
            [ "name"=> "FRAPU MOCA + TOPPING","price"=>23.00,"imagen"=>"1677961435.png","color"=> '#6f2470', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>27,"shop_id"=>3],
            [ "name"=> "FRAPU VAINILLA + TOPPING","price"=>23.00,"imagen"=>"1677961471.png","color"=> '#6f2470', "cantidad"=>0,"estado"=>"ACTIVO","category_id"=>27,"shop_id"=>3],


        ]);
    }
}
