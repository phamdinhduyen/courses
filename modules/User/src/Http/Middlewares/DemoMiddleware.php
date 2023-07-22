<?php
namespace Modules\User\src\Http\Middlewares;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class DemoMiddleware{
    public function handle(Request $request, Closure $next, ...$guards){
        echo 'demo middleware';
        return $next($request);
    }
}