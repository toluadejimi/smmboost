<?php

namespace StrIlluminate\StrIlluminate\Activereq\Activeck;

use Closure;
use Facades\StrIlluminate\StrIlluminate\Activewor\IN;

class WTC
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
