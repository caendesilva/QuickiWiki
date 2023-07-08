<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Contribution;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $index = Article::create([
            'slug' => 'index',
            'title' => 'Welcome to the [[ WikiName ]] Wiki!',
            'content' => $content = 'Welcome to QuickiWiki! This is the default homepage. You can edit it by clicking the "Edit" button in the top right corner of the page.',
        ]);

        Contribution::log($index, User::first(), $content, 'Created the index page.');
    }
}
