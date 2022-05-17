<?php

namespace App\Http\Middleware;

use Closure;

class ApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $api_key = $request->header('api-key');

        if (!$api_key) {

            return sendErrorResponse('Api key is required',[],401);
        }

        if (!in_array($api_key, $this->whiteListedApiKeys())) {

            return sendErrorResponse('Api key is invalid',[],403);
        }

        return $next($request);
    }

    private function whiteListedApiKeys()
    {
        return [
            'dsfr3-3gthsz-223xzf-dcswx'
        ];
    }
}
