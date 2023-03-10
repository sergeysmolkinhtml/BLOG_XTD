<?php

namespace App\Jobs;

use App\Models\BlogPost;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BlogPostAfterCreateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $blogPost;

    /**
     * Create a new job instance.
     */
    public function __construct(BlogPost $blogPost)
    {
        $this->blogPost = $blogPost;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        logs()->info("New record just created [{$this->blogPost->id}]");
    }
}
