<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class BlogPost
 *
 * @package App\Models
 *
 * @property BlogCategory $category
 * @property User         $user
 * @property string       $title
 * @property string       $slug
 * @property string       $content_html
 * @property string       $content_raw
 * @property string       $excerpt
 * @property string       $published_at
 * @property boolean      $is_published
 *
 */

class BlogPost extends Model
{
    use HasFactory;
    use SoftDeletes;

    const UNKNOWN_USER = 1;

    protected $fillable =
        [
            'title',
            'slug',
            'category_id',
            'excerpt',
            'content_raw',
            'is_published',
            'published_at',

        ];


    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
