<?php

namespace StrIlluminate\StrIlluminate\Activereq\Activeck;

use Closure;
use Facades\StrIlluminate\StrIlluminate\Activewor\{
    DH, IN, RD, BS
};

class M
{
    public function handle($request, Closure $next, $guard = null)
    {
        return $next($request);
    }
}
