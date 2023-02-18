<?php

namespace App\Repositories;

use App\Models\BlogCategory as Model;
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
     * Get list of categories for comboBox [drop down sheet]
     *
     * @return Collection
     */
    public function getForComboBox(): Collection
    {
        return $this->startConditions()->all();
    }
}
