<?php

namespace App\Http\Middleware;

use Closure;

use App;
use Config;
use View;
use App\Setting;
use App\Menu;
use App\Widget;
use App\Governorate;
use App\Post;

class CommonSite
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   

        foreach(Setting::get() as $setting){
            Config::set($setting->key, $setting->value);
        }

        $data['headers'] = Menu::language()->where('location', 'header')->orderBy('sort')->get();
        $data['footers'] = Menu::language()->where('location', 'footer')->orderBy('sort')->get();
        $data['widgets'] = Widget::language()->orderBy('sort')->get();
        $data['governorates'] = Governorate::language()->orderBy('sort')->get();
        $data['topics'] = Post::language()->where('type', 'topics')->get();

        View::share($data);

        return $next($request);
    }
}
