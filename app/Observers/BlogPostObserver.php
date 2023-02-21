<?php

namespace App\Observers;

use App\Models\BlogPost;
use Carbon\Carbon;
use Illuminate\Support\Str;

class BlogPostObserver
{
    /**
     * Handle the BlogPost "created" event.
     */
    public function created(BlogPost $blogPost): void
    {
        //
    }

    /**
     * Handle before creating
     *
     * @param BlogPost $blogPost
     * @return void
     */
    public function creating(BlogPost $blogPost)
    {
        $this->setPublishedAt($blogPost);

        $this->setSlug($blogPost);

        $this->setHTML($blogPost);

        $this->setUser($blogPost);
    }
    /**
     * Handle the BlogPost "updated" event.
     */
    public function updating(BlogPost $blogPost): void
    {
        $this->setPublishedAt($blogPost);

        $this->setSlug($blogPost);

    }

    protected function setPublishedAt(BlogPost $blogPost): void
    {
        $needSetPublished = empty($blogPost->published_at) && $blogPost->is_published;

        if($needSetPublished){
            $blogPost->published_at = Carbon::now();
        }

    }

    protected function setSlug(BlogPost $blogPost): void
    {
        if(empty($blogPost->slug)){
            $blogPost->slug = Str::slug($blogPost->title);
        }

    }

    protected function setHTML(BlogPost $blogPost)
    {
        if($blogPost->isDirty('content_raw')){ // Dirty - "is changed?"
            $blogPost->content_html = $blogPost->content_raw;
        }
    }

    protected function setUser(BlogPost $blogPost)
    {
        $blogPost->user_id = auth()->id() ?? BlogPost::UNKNOWN_USER;
    }

    public function deleting(BlogPost $blogPost)
    {

    }

    /**
     * Handle the BlogPost "deleted" event.
     */
    public function deleted(BlogPost $blogPost): void
    {

    }

    /**
     * Handle the BlogPost "restored" event.
     */
    public function restored(BlogPost $blogPost): void
    {
        //
    }

    /**
     * Handle the BlogPost "force deleted" event.
     */
    public function forceDeleted(BlogPost $blogPost): void
    {
        //
    }
}
