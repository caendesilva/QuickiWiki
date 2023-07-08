<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Article;
use App\Models\Contribution;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductionSeeder extends Seeder
{
    /**
     * Seed the application's database with production data.
     *
     * This method is called when running the installation command.
     */
    public function run(): void
    {
        $this->createIndexPage();

        // You can add more tasks here.
    }

    protected function createIndexPage(): void
    {
        $index = Article::create([
            'slug' => 'index',
            'title' => 'Welcome to the [[ WikiName ]] Wiki!',
            'content' => $content = 'Welcome to QuickiWiki! This is the default homepage. You can edit it by clicking the "Edit" button in the top right corner of the page.',
        ]);

        Contribution::log($index, User::first(), $content, 'Created the index page.');
    }
}
