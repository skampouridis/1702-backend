<?php

namespace App\Api\Middlewares;

use App\Api\Exceptions\RateLimit;
use Closure;
use Illuminate\Support\Facades\Cache;

/**
 * Class RateLimiter
 *
 * @package App\Http\Middleware
 */
class RateLimiter
{
    /**
     * Default rate limit, maximum number of requests.
     */
    const DEFAULT_LIMIT = 10;

    /**
     * Default request cost per request.
     */
    const DEFAULT_COST = 1;

    /**
     * Default period which the requests are limited (minutes).
     */
    const DEFAULT_PERIOD = 60;

    /**
     * Handle an incoming request.
     *
     * @param $request
     * @param Closure $next
     * @param int $limit The maximum number of requests
     * @param int $cost The cost per request
     * @return mixed
     * @throws RateLimit
     */
    public function handle(
        $request,
        Closure $next,
        $limit = self::DEFAULT_LIMIT,
        $cost = self::DEFAULT_COST)
    {
        // Rate limit by IP address
        $count = sprintf('api:count:%s', $request->getClientIp());
        $reset = sprintf('api:reset:%s', $request->getClientIp());

        //$key,$value,$minutes
        Cache::add($reset, time() + (self::DEFAULT_PERIOD * 60), self::DEFAULT_PERIOD);
        Cache::add($count, 0, self::DEFAULT_PERIOD);

        $reset_time = Cache::get($reset, time());
        $remaining = $limit - Cache::increment($count, $cost);

        $response = $next($request);

        $seconds = $reset_time - time();

        // Break out and return an error message
        if ($remaining <= 0) {
            throw new RateLimit('Rate limit exceeded from user '.$request->getClientIp().'. You have to wait for '.$seconds.' secs for the next request');
        }

        // Set rate limit headers
        $response
            ->header('X-RateLimit-Cost', $cost)
            ->header('X-RateLimit-Limit', $limit)//out limit 10
            ->header('X-RateLimit-Remaining', max($remaining, 0))//The remaining number of requests left for this hour
            ->header('X-RateLimit-Reset', $reset_time)//the reset time for the next rate limiter
            ->header('X-RateLimit-Reset-Ttl', max($reset_time - time(), 0));//the remaining seconds for the next rate limiter

        return $response;
    }
}
