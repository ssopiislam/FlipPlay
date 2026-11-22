<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Media;
use Illuminate\Support\Facades\Hash;

class FlipPlaySeeder extends Seeder
{
    public function run(): void
    {
        // Membuat data pengguna Sopi
        $user = User::create([
            'name' => 'Sopi',
            'email' => 'sopi@flipplay.test',
            'password' => Hash::make('password123'),
        ]);

        // Data Anime dan Manga FlipPlay
        $naruto = Media::create([
            'title' => 'Naruto',
            'type' => 'Anime',
            'genre' => 'Action',
            'episodes' => 220,
            'chapters' => null,
        ]);

        Media::create([
            'title' => 'One Piece',
            'type' => 'Anime',
            'genre' => 'Adventure',
            'episodes' => 1000,
            'chapters' => null,
        ]);

        Media::create([
            'title' => 'Haikyuu!!',
            'type' => 'Anime',
            'genre' => 'Sports',
            'episodes' => 85,
            'chapters' => null,
        ]);

        $blueLock = Media::create([
            'title' => 'Blue Lock',
            'type' => 'Manga',
            'genre' => 'Sports',
            'episodes' => null,
            'chapters' => 300,
        ]);

        // Memasukkan Naruto dan Blue Lock
        // ke koleksi pengguna Sopi
        $user->media()->attach([
            $naruto->id,
            $blueLock->id,
        ]);
    }
}
