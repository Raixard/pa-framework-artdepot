<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comments = [
            [
                'id' => '1',
                'user_id' => '3',
                'creation_id' => '1',
                'parent_id' => null,
                'content' => 'Unyuuuuu'
            ],
            [
                'id' => '2',
                'user_id' => '2',
                'creation_id' => '1',
                'parent_id' => '1',
                'content' => 'Terima kasih!'
            ],
        ];

        foreach ($comments as $comment) {
            Comment::create([
                'user_id' => $comment['user_id'],
                'creation_id' => $comment['creation_id'],
                'parent_id' => $comment['parent_id'],
                'content' => $comment['content'],
            ]);
        }
    }
}
