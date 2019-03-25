<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * 可在這邊設定欄位值對應的Model
         */
//        Relation::morphMap([
//            'Post' => 'App\Model\PolymorphicRelationPost',
//            'Video' => 'App\Model\PolymorphicRelastionsVideo',
//        ]);

        Relation::morphMap([
            'Post' => \App\Model\ManyToManyPolyRelationPost::class,
            'Video' => \App\Model\ManyToManyPolyRelationVideo::class,
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
