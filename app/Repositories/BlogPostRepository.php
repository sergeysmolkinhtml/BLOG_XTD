<?php

namespace App\Repositories;

use App\Models\BlogPost as Model;

class BlogPostRepository extends CoreRepository
{
    /**
     * @returns string
     */
    protected function getModelClass(): string
    {
        return Model::class;
    }
}
