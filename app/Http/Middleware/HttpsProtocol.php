<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class HttpsProtocol extends Middleware {
  
  public function handle($request, Closure $next) {
    if (App::environment() === 'production') {
      
      $uri = $request->getRequestUri();
      
      if ($uri != '/' && $uri[strlen($uri) - 1] == '/') {
        return redirect(substr($uri, 0, strlen($uri) - 1), 301);
      }
      
      $host = $request->header('host');
      if (substr($host, 0, 4) !== 'www.') {
        if (!$request->secure()) {
          $request->server->set('HTTPS', true);
          return redirect()->to($request->path(), 301);
        }
      } else {
        if (!$request->secure()) {
          $request->server->set('HTTPS', true);
        }
        $request->headers->set('host', 'vecheria.ru');
        return redirect()->to($request->path(), 301);
      }
    }
    
    return $next($request);
  }
}