<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    
    public function run()
    {
        \DB::table('provinces')->insert([
            ['name' => 'ACEH'],
            ['name' => 'SUMATERA UTARA'],
            ['name' => 'SUMATERA BARAT'],
            ['name' => 'RIAU'],
            ['name' => 'JAMBI'],
            ['name' => 'SUMATERA SELATAN'],
            ['name' => 'BENGKULU'],
            ['name' => 'LAMPUNG'],
            ['name' => 'KEPULAUAN BANGKA BELITUNG'],
            ['name' => 'KEPULAUAN RIAU'],
            ['name' => 'DKI JAKARTA'],
            ['name' => 'JAWA BARAT'],
            ['name' => 'JAWA TENGAH'],
            ['name' => 'DI YOGYAKARTA'],
            ['name' => 'JAWA TIMUR'],
            ['name' => 'BANTEN'],
            ['name' => 'BALI'],
            ['name' => 'NUSA TENGGARA BARAT'],
            ['name' => 'NUSA TENGGARA TIMUR'],
            ['name' => 'KALIMANTAN BARAT'],
            ['name' => 'KALIMANTAN TENGAH'],
            ['name' => 'KALIMANTAN SELATAN'],
            ['name' => 'KALIMANTAN TIMUR'],
            ['name' => 'KALIMANTAN UTARA'],
            ['name' => 'SULAWESI UTARA'],
            ['name' => 'SULAWESI TENGAH'],
            ['name' => 'SULAWESI SELATAN'],
            ['name' => 'SULAWESI TENGGARA'],
            ['name' => 'GORONTALO'],
            ['name' => 'SULAWESI BARAT'],
            ['name' => 'MALUKU'],
            ['name' => 'MALUKU UTARA'],
            ['name' => 'PAPUA BARAT'],
            ['name' => 'PAPUA']
        ]);

        \DB::table('citys')->insert([
            ['province_id' => 1, 'name' => 'KABUPATEN SIMEULUE'],
            ['province_id' => 1, 'name' => 'KABUPATEN ACEH SINGKIL'],
            ['province_id' => 1, 'name' => 'KABUPATEN ACEH SELATAN'],
            ['province_id' => 1, 'name' => 'KABUPATEN ACEH TENGGARA'],
            ['province_id' => 1, 'name' => 'KABUPATEN ACEH TIMUR'],
            ['province_id' => 1, 'name' => 'KABUPATEN ACEH TENGAH'],
            ['province_id' => 1, 'name' => 'KABUPATEN ACEH BARAT'],
            ['province_id' => 1, 'name' => 'KABUPATEN ACEH BESAR'],
            ['province_id' => 1, 'name' => 'KABUPATEN PIDIE'],
            ['province_id' => 1, 'name' => 'KABUPATEN BIREUEN'],
            ['province_id' => 1, 'name' => 'KABUPATEN ACEH UTARA'],
            ['province_id' => 1, 'name' => 'KABUPATEN ACEH BARAT DAYA'],
            ['province_id' => 1, 'name' => 'KABUPATEN GAYO LUES'],
            ['province_id' => 1, 'name' => 'KABUPATEN ACEH TAMIANG'],
            ['province_id' => 1, 'name' => 'KABUPATEN NAGAN RAYA'],
            ['province_id' => 1, 'name' => 'KABUPATEN ACEH JAYA'],
            ['province_id' => 1, 'name' => 'KABUPATEN BENER MERIAH'],
            ['province_id' => 1, 'name' => 'KABUPATEN PIDIE JAYA'],
            ['province_id' => 2, 'name' => 'KABUPATEN NIAS'],
            ['province_id' => 2, 'name' => 'KABUPATEN MANDAILING NATAL'],
            ['province_id' => 2, 'name' => 'KABUPATEN TAPANULI SELATAN'],
            ['province_id' => 2, 'name' => 'KABUPATEN TAPANULI TENGAH'],
            ['province_id' => 2, 'name' => 'KABUPATEN TAPANULI UTARA'],
            ['province_id' => 2, 'name' => 'KABUPATEN TOBA SAMOSIR'],
            ['province_id' => 2, 'name' => 'KABUPATEN LABUHAN BATU'],
            ['province_id' => 2, 'name' => 'KABUPATEN ASAHAN']
        ]);

        \DB::table('kelurahans')->insert([
            ['city_id' => 1, 'name' => 'TEUPAH SELATAN'],
            ['city_id' => 1, 'name' => 'SIMEULUE TIMUR'],
            ['city_id' => 1, 'name' => 'TEUPAH BARAT'],
            ['city_id' => 1, 'name' => 'TEUPAH TENGAH'],
            ['city_id' => 1, 'name' => 'SIMEULUE TENGAH'],
            ['city_id' => 1, 'name' => 'TELUK DALAM'],
            ['city_id' => 1, 'name' => 'SIMEULUE TENGAH CUT'],
            ['city_id' => 1, 'name' => 'SALANG'],
            ['city_id' => 1, 'name' => 'SIMEULUE BARAT'],
            ['city_id' => 1, 'name' => 'ALAFAN'],
            ['city_id' => 2, 'name' => 'PULAU BANYAK'],
            ['city_id' => 2, 'name' => 'PULAU BANYAK BARAT'],
            ['city_id' => 2, 'name' => 'SINGKIL'],
            ['city_id' => 2, 'name' => 'SINGKIL UTARA'],
            ['city_id' => 2, 'name' => 'KUALA BARU'],
            ['city_id' => 2, 'name' => 'SIMPANG KANAN'],
            ['city_id' => 2, 'name' => 'GUNUNG MERIAH'],
            ['city_id' => 2, 'name' => 'DANAU PARIS'],
            ['city_id' => 2, 'name' => 'SURO'],
            ['city_id' => 2, 'name' => 'SINGKOHOR'],
            ['city_id' => 2, 'name' => 'KOTA BAHARU']
        ]);
    }
}
