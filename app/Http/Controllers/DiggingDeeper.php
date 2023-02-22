<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class DiggingDeeper extends Controller
{

    /**
     * @return void
     */
    public function collections()
    {
        $result = [];

        $eloquentBlogs = BlogPost::withTrashed()->get();

        $collection = collect($eloquentBlogs->toArray());

        $result['where']['data'] = $collection
            ->where('category_id',10)
            ->values()
            ->keyBy('id');

/*        $result['where']['count'] = $result['where']['data']->count();*/

        $filtered = $collection->filter(function ($item){
            $byDay = $item->created_at->isFriday();
            $byDate = $item->created_at->day == 11;

            $result = $item->created_at->isFriday() && ($item->created_at->day == 11);
            return $result;
        });

        dd(compact('filtered'));

        //transform - change each data n get new
        $result['map']['all'] = $collection->map(function (array $item){
            $newItem = new \stdClass();
            $newItem->item_id = $item['id'];
            $newItem->item_name = $item['title'];
            $newItem->exists = is_null($item['deleted_at']);

            return $newItem;
        });
        dd($result);


        dd($result);
    }

}
