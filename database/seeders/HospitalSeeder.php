<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class HospitalSeeder extends Seeder {
    public function run() {
        DB::table('hospitals')->insert([
            ['hospital_code'=>'code-1','name'=>'RS Sehat Sentosa','address'=>'Jl. Merdeka 1','email'=>'info@sehat.com','phone'=>'(021)111111'],
            ['hospital_code'=>'code-2','name'=>'RS Harapan Kita','address'=>'Jl. Kebon Jeruk 2','email'=>'contact@harapankita.id','phone'=>'(021)222222'],
            ['hospital_code'=>'code-3','name'=>'RS Bahagia','address'=>'Jl. Melati 3','email'=>'hello@bahagia.org','phone'=>'(021)333333'],
        ]);
    }
}