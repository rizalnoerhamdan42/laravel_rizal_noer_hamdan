<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class PatientSeeder extends Seeder {
    public function run() {
        $hospitals = DB::table('hospitals')->pluck('id')->toArray();
        DB::table('patients')->insert([
            ['name'=>'Andi','address'=>'Jakarta Barat','phone'=>'08110001','hospital_id'=>$hospitals[0]],
            ['name'=>'Budi','address'=>'Jakarta Timur','phone'=>'08110002','hospital_id'=>$hospitals[1]],
            ['name'=>'Citra','address'=>'Depok','phone'=>'08110003','hospital_id'=>$hospitals[2]],
            ['name'=>'Dewi','address'=>'Bogor','phone'=>'08110004','hospital_id'=>$hospitals[0]],
        ]);
    }
}