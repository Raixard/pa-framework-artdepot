<?php

namespace Database\Seeders;

use App\Models\Creation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $creations = [
            [
                'id' => '1',
                'user_id' => '1',
                'image_url' => '1-rubahganteng-2022-07-23-TestChibi.jpg',
                'title' => 'Chibi Raikhárd',
                'description' => 'Nyoba² chibi:> Art by me',
                'keywords' => 'furry; anthro; Raikhárd; chibi; rubah; Sableye; pokemon',
            ],
            [
                'id' => '2',
                'user_id' => '1',
                'image_url' => '2-rubahganteng-2022-10-19-Raikhard.jpg',
                'title' => 'Berpayung (?)',
                'description' => 'Ceritanya lagi berpayung. N\'tahlah, gatau mo kasih deskripsi apa:v',
                'keywords' => 'furry; anthro; Raikhárd; rubah',
            ],
        ];

        foreach ($creations as $creation) {
            Creation::create([
                'user_id' => $creation['user_id'],
                'image_url' => $creation['image_url'],
                'title' => $creation['title'],
                'description' => $creation['description'],
                'keywords' => $creation['keywords'],
            ]);
        }
    }
}
