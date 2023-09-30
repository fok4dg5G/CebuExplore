<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot()
    {
        Validator::extend('img', function ($attribute, $value, $parameters, $validator) {
            // ここに画像ファイルのバリデーションロジックを追加します
            // 例: 画像ファイルの拡張子を確認するなど
            // 画像バリデーションルールを作成します
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            $extension = pathinfo($value->getClientOriginalName(), PATHINFO_EXTENSION);

            return in_array(strtolower($extension), $allowedExtensions);
        });
    }

}
