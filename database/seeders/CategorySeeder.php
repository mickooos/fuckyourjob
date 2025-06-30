<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'nama'       => 'Dokumen',
                'code'       => 'DOC',            
            ],
            [
                'nama'       => 'Elektronik',
                'code'       => 'ELEC',
            ],
            [
                'nama'       => 'Makanan',
                'code'       => 'FOOD',
            ],
            [
                'nama'       => 'Pakaian',
                'code'       => 'CLTH',
            ],
            [
                'nama'       => 'Lain‑lain',
                'code'       => 'MISC',
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}
