<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App;
use Session;

class Language
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
        if ( Auth::check() ) {

            $language2 = Auth::user()->language;
            $language = Session::get('locale');
            $ln = App::getLocale();

            //echo '$language2 ' . $language2 . '</br>', '$language ' . $language . '</br>' , '$ln ' . $ln . '</br>';
            //die();

            if (isset($language)){
                //echo '$language ' . $language;
                App::setLocale($language);
                Session::put('locale', $language);
            }elseif (isset($ln) && !isset($language)){
                //echo '$ln ' . $ln;
                App::setLocale($ln);
                Session::put('locale', $ln);
            }
            else{
                //echo '$language2 ' . $language2;
                App::setLocale($language2);
            }

        } else {
            // logout
            $language = Session::get('locale');
            //$ln = App::getLocale();
            //echo  ' else $ln ' . $ln . '</br>';
            //die();
            
            if($language != null) {
                
                App::setLocale($language);
                Session::put('locale', $language);

            } else {
                App::setLocale(config('app.locale'));
            }

        } 

        return $next($request);
    }
}
