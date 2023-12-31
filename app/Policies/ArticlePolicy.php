<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use App\Roles;
use Illuminate\Auth\Access\Response;

class ArticlePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Article $article): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole(Roles::User);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Article $article): bool
    {
        if ($article->isRestricted()) {
            return $user->hasRole(Roles::Editor);
        }

        return $user->hasRole(Roles::User);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Article $article): bool
    {
        return $article->slug !== 'index' && $this->update($user, $article);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Article $article): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Article $article): bool
    {
        //
    }

    /**
     * Determine whether the user can restrict the model.
     */
    public function restrict(User $user, Article $article): bool
    {
        return $user->hasRole(Roles::Editor);
    }
}
