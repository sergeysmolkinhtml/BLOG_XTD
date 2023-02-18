<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Blog\BaseController as GuestBaseController;

/**
 * Base controller for each blog controller
 * in admin panel
 *
 * MUST BE parent of each manage blog controllers
 *
 * @package App\Http\Contoller\Blog\Admin
 */
abstract class BaseController extends GuestBaseController
{
    public function __construct()
    {

    }
}
