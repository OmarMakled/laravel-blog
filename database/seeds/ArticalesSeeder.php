<?php

use App\Models\Article;
use App\Models\Comment;
use App\Models\Category;

class ArticlesSeeder extends Seeder
{
    protected $tables = [
        'articles',
        'categories',
        'comments',
        'article_category',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables()->seedTables();
    }

    protected function seedTables()
    {
        factory(Category::class)->create(['name' => 'unknown']);
        factory(Category::class, 10)->create();

        foreach (range(1, 100) as $index) {
            $article = factory(Article::class)->create();

            $article->comments()->createMany(
                factory(Comment::class, rand(1, 10))->make()->toArray()
            );

            $article->categories()->sync(
                Category::pluck('id')->random(rand(1, 10))
            );
        }
    }
}
