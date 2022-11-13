<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'id' => '1',
                'username' => 'ArtDepot',
                'profile_image' => '1.png',
                'email' => 'admin@artdepot.art',
                'email_verified_at' => now(),
                'password' => Hash::make("\u{0061}\u{0072}\u{0074}\u{0064}\u{0065}\u{0070}\u{006F}\u{0074}\u{0061}\u{0064}\u{006D}\u{0069}\u{006E}"), // artdepotadmin
                'remember_token' => Str::random(10),
                'role' => 'admin',
            ],
            [
                'id' => '2',
                'username' => 'raixard',
                'profile_image' => '2.jpg',
                'email' => 'raixard@fox.ly',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ],
            [
                'id' => '3',
                'username' => 'bucciarati788',
                'profile_image' => 'user-default.jpg',
                'email' => 'aydunno@dunno.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ],
        ];

        foreach ($users as $user) {
            User::create([
                'id' => $user['id'],
                'username' => $user['username'],
                'profile_image' => $user['profile_image'],
                'email' => $user['email'],
                'email_verified_at' => $user['email_verified_at'],
                'password' => $user['password'],
                'remember_token' => $user['remember_token'],
                'role' => $user['role'] ?? 'user',
            ]);
        }
    }
}
