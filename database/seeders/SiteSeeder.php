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
    public function run(User $owner): void
    {
        $index = Article::create([
            'slug' => 'index',
            'title' => 'Welcome to the [[ SiteName ]] Wiki!',
            'content' => 'Welcome to QuickiWiki! This is the default homepage. You can edit it by clicking the "Edit" button.',
        ]);

        Contribution::log($index, $owner, 'Created the index page.', Contribution::diff('', $index->content));
    }
}
