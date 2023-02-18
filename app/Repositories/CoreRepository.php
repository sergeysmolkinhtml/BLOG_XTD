<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CoreRepository
 *
 * @package App\Repositories
 *
 * Репозиторий работы с сущностью
 * Может выдавать наборы данных.
 * Не может создавать/изменять сущности
 */
abstract class CoreRepository
{
    /**
     * @var Model;
     */
    protected mixed $model;

    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    /**
     * @return mixed
     */
    abstract protected function getModelClass();

    /**
     *@return Model|mixed
     */
    protected function startConditions(): mixed
    {
        return clone $this->model; //   or new instance
    }

}

