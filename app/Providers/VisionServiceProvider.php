<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

class VisionServiceProvider extends ServiceProvider
{
    // public function register()
    // {
    //     $jsonContent = file_get_contents(env('GOOGLE_APPLICATION_CREDENTIALS'));
    //     \Log::info('JSON Content:', ['content' => $jsonContent]);
    //     $this->app->singleton(ImageAnnotatorClient::class, function () {
    //         return new ImageAnnotatorClient([
    //             'keyFilePath' => env('GOOGLE_APPLICATION_CREDENTIALS'),
    //         ]);
    //     });
    // }

    public function boot()
    {
        //
    }
}
