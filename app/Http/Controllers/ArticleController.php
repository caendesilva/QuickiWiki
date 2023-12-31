<?php

namespace App\Http\Controllers;

use App\Actions\ShortcodeProcessor;
use Illuminate\Database\QueryException;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Models\Contribution;
use App\Plugins\SimpleToast\Toast;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Instantiate a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'contributions']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $index = Article::where('slug', 'index')->first();
        } catch (QueryException) {
            $index = null;
        }

        if (! $index) {
            if (! app('installed')) {
                return view('welcome');
            } else {
                return 'Error: No index article found. Did you properly install the application?';
            }
        }

        return $this->show($index);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Article::class);

        return view('article.create', [
            //
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        $article = Article::create($request->validated());

        Contribution::log($article, $request->user(), $article->content, 'Created the article.');
        Toast::flash('Article created!', 'success');

        return redirect()->route('articles.show', $article);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        if (request()->route()->uri === 'articles') {
            return view('article.index', [
                'articles' => Article::where('slug', '!=', 'index')->get(),
            ]);
        }

        return view('article.show', [
            'title' => (new ShortcodeProcessor($article->title))->process(),
            'content' => new HtmlString(Str::markdown((new ShortcodeProcessor($article->content))->process())),
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

        if (! $article->wasChanged()) {
            Toast::flash('Nothing new to change!');
            return redirect(route('articles.show', $article), 303);
        }

        Contribution::log($article, $request->user(), $article->content, 'Updated the article.');
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

        Toast::flash('Article deleted!', 'success');

        return redirect()->route('articles.index');
    }

    /**
     * Restrict the specified resource from editing.
     */
    public function restrict(Article $article)
    {
        $this->authorize('restrict', $article);

        $restrict = request()->method() !== 'DELETE';

        $article->update([
            'metadata' => array_merge($article->metadata ?? [], [
                'restricted' => $restrict,
            ]),
        ]);

        $message = $restrict ? 'Restricted the article.' : 'Unlocked the article.';
        Contribution::log($article, request()->user(), $article->content, $message);
        Toast::flash($message, 'success');

        return redirect()->route('articles.show', $article);
    }

    /**
     * Display the contribution history of the specified resource.
     */
    public function contributions(Article $article)
    {
        return view('article.contributions', [
            'title' => (new ShortcodeProcessor($article->title))->process(),
            'article' => $article,
            'contributions' => $article->contributions()->with('user')->latest()->paginate(10),
        ]);
    }

    /**
     * Redirect to a random article.
     */
    public function random()
    {
        $article = Article::inRandomOrder()->firstOrFail();

        return redirect()->route('articles.show', $article);
    }
}
