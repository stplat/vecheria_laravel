<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class HttpsProtocol extends Middleware {

  public function handle($request, Closure $next) {
    /*if (!$request->secure() && App::environment() == 'production') {
      return redirect()->secure($request->getRequestUri());
    }

    if(config('app.env') == 'production'){

      $host = $request->header('host');
      if (substr($host, 0, 4) != 'www.') {
        if(!$request->secure()){
          $request->server->set('HTTPS', true);
        }
        $request->headers->set('host', 'www.'.$host);
        return Redirect::to($request->path(),301);
      }else{
        if(!$request->secure()){
          $request->server->set('HTTPS', true);
          return Redirect::to($request->path(),301);
        }
      }
    }*/

    if (App::environment() === 'production') {

      $host = $request->header('host');
      if (substr($host, 0, 4) !== 'www.') {
        if (!$request->secure()) {
          return redirect()->secure($request->getRequestUri());
        }
      } else {
        $request->headers->set('host', 'vecheria.ru');
        return redirect()->secure($request->getRequestUri());
      }
    }

    return $next($request);
  }
}