<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rooms')->insert([
            [
                'name' => 'Anime',
                'slug' => 'anime',
                'label' => 'Entertainment',
                'category' => 'Film',
                'site' => 'https://myanimelist.net/'
            ],
            [
                'name' => 'Drakor',
                'slug' => 'drakor',
                'label' => 'Entertainment',
                'category' => 'Film',
                'site' => 'https://mydramalist.com/'
            ],
            [
                'name' => 'Hollywood',
                'slug' => 'hollywood',
                'label' => 'Entertainment',
                'category' => 'Film',
                'site' => 'https://www.imdb.com/'
            ],
        ]);
    }
}
