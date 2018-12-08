<?php

namespace App\Providers;

use Dingo\Api\Contract\Auth\Provider;
use Dingo\Api\Provider\ServiceProvider;
use Dingo\Api\Routing\Route;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class CustomProvider extends ServiceProvider implements Provider
{
    public function authenticate(Request $request, Route $route)
    {
        // 对请求进行难
        throw new UnauthorizedHttpException('Unable to authenticate with supplied username and password');

        // 如果  Authorization  通过验证，我们可以继续进行身份验证
        // 如果  Authorization  验证失败， 我们必须抛出一个  UnauthorizedHttpException  的异常
    }

    public function getAuthorizationMethod()
    {
        return 'mac';
    }
}
