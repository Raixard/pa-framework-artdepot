<?php

namespace Database\Seeders;

use App\Models\ReportCat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReportCatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $catrep = [
            [
                'id' => '1',
                'category' => 'Spam'
            ],
            [
                'id' => '2',
                'category' => 'NSFW'
            ],
            [
                'id' => '3',
                'category' => 'Bug'
            ],
            [
                'id' => '4',
                'category' => 'Error Page'
            ],
            [
                'id' => '5',
                'category' => 'User Report'
            ],
        ];

        foreach ($catrep as $cr) {
            ReportCat::create([
                'id' => $cr['id'],
                'category' => $cr['category'],
            ]);
        }
    }
}
