<?php

namespace App\Repositories;

use App\Models\BlogCategory as Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;



/**
 * Class BlogCategoryRepository
 *
 * @package App\Repositories
 */

class BlogCategoryRepository extends CoreRepository
{

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Model::class;
    }


    /**
     * Get model for editing in admin
     *
     * @param $id
     * @return Model
     */
    public function getEdit($id): Model
    {
        return $this->startConditions()->find($id);
    }

    /**
     * Get list of categories for comboBox [drop down list]
     *
     * @return Collection
     */
    public function getForComboBox()
    {

        // Needed fields
        $columns = implode(', ',
            [
                'id',
                'CONCAT (id, ". ", title) AS id_title',
            ]);

        /*$result[] = $this->startConditions()->all();
        $result[] = $this->startConditions()
                    ->select('blog_categories.*',
                    DB::raw('CONCAT (id, ". ", title) AS id_title'))
                    ->toBase()
                    ->get();*/

        $result = $this
            ->startConditions()
            ->selectRaw($columns)
            ->toBase()
            ->get();


        return $result;
    }

    public function getAllWithPaginate($perPage = null)
    {
       $columns = ['id','title','parent_id'];

       $result = $this->startConditions()
                       ->select($columns)
                        ->with(['parentCategory:id,title'])
                       ->paginate($perPage);

        return $result;
    }


}
