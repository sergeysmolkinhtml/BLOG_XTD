<?php

namespace App\Repositories;

use App\Models\BlogPost as Model;
use Illuminate\Pagination\LengthAwarePaginator;

class BlogPostRepository extends CoreRepository
{
    /**
     * @returns string
     */
    protected function getModelClass(): string
    {
        return Model::class;
    }

    /**
     * Get List Of Articles to display
     *
     * @param $perPage
     * @return LengthAwarePaginator
     */
    public function getAllWithPaginate($perPage)
    {
        $columns = [

            'id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'user_id',
            'category_id'

        ];

        $result = $this->startConditions()
            ->select($columns)
            ->orderBy('id','DESC')
            ->with(['category','user'])
            ->paginate($perPage);

        return $result;

    }

    /**
     * Get model for editing in admin panel
     *
     * @param $id
     *
     * @return Model
     */
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }


}


