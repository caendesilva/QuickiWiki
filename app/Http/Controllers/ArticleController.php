<?php

namespace App\Http\Controllers;

use App\Actions\ShortcodeProcessor;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Models\Contribution;
use App\Plugins\SimpleToast\Toast;

class ArticleController extends Controller
{
    /**
     * Instantiate a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $index = Article::where('slug', 'index')->first();

        if ($index) {
            return $this->show($index);
        }

        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view('article.show', [
            'title' => (new ShortcodeProcessor($article->title))->process(),
            'content' => (new ShortcodeProcessor($article->content))->process(),
            'article' => $article,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $this->authorize('update', $article);

        return view('article.edit', [
            'title' => (new ShortcodeProcessor($article->title))->process(),
            'article' => $article,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $this->authorize('update', $article);

        $article->update($request->validated());

        // Check if any changes were made
        if (! $article->wasChanged()) {
            Toast::flash('Nothing new to change!');
            return redirect(route('articles.show', $article), 303);
        }

        Contribution::log($article, $request->user(), 'Updated the article.', Contribution::diff($article->getOriginal('content'), $article->content));
        Toast::flash('Article updated!', 'success');

        return redirect()->route('articles.show', $article);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);

        $article->delete();
    }
}
