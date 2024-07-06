<?php

namespace App\Console\Commands;

use App\Models\Blog;
use App\Models\Company;
use App\Models\Deal;
use App\Models\Event;
use App\Models\Forum;
use App\Models\Job;
use App\Models\Product;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate sitemap for the website.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $companiesSiteMap = Sitemap::create();
        $productsSiteMap = Sitemap::create();
        $eventsSiteMap = Sitemap::create();
        $blogsSiteMap = Sitemap::create();
        $dealsSiteMap = Sitemap::create();
        $jobsSiteMap = Sitemap::create();
        $forumsSiteMap = Sitemap::create();

        Company::get()->each(function ($company) use($companiesSiteMap) {
            $companiesSiteMap->add(route('view.company', $company->slug));
        });

        Product::get()->each(function ($product) use($productsSiteMap) {
            $productsSiteMap->add(route('view.product', $product->slug));
        });

        Event::get()->each(function ($event) use($eventsSiteMap) {
            $eventsSiteMap->add(route('view.event', $event->slug));
        });

        Blog::get()->each(function ($blog) use($blogsSiteMap) {
            $blogsSiteMap->add(route('view.blog', $blog->slug));
        });

        Deal::get()->each(function ($deal) use($dealsSiteMap) {
            $dealsSiteMap->add(route('view.deal', $deal->slug));
        });

        Job::get()->each(function ($job) use($jobsSiteMap) {
            $jobsSiteMap->add(route('view.job', $job->slug));
        });

        Forum::get()->each(function ($forum) use($forumsSiteMap) {
            $forumsSiteMap->add(route('view.forum', [$forum->id, $forum->title]));
        });

        $companiesSiteMap->writeToFile(public_path('sitemap-companies.xml'));
        $productsSiteMap->writeToFile(public_path('sitemap-products.xml'));
        $eventsSiteMap->writeToFile(public_path('sitemap-events.xml'));
        $blogsSiteMap->writeToFile(public_path('sitemap-blogs.xml'));
        $dealsSiteMap->writeToFile(public_path('sitemap-deals.xml'));
        $jobsSiteMap->writeToFile(public_path('sitemap-jobs.xml'));
        $forumsSiteMap->writeToFile(public_path('sitemap-forums.xml'));

        $this->info('Sitemap generated successfully.');
    }
}
