<?php namespace Meysam\PutFormData\Classes;

use Meysam\PutFormData\Classes\ParseInputStream;
use Closure;

/**
 * Class FixputMiddleware
 * @package Meysam\PutFormData\Classes
 *
 * This middleware parses and appends form-data to request if method is not POST
 */
class FixputMiddleware
{
    public function handle($request, Closure $next)
    {
        if ($request->method() == 'POST' OR $request->method() == 'GET') {
            return $next($request);
        }

        if (preg_match('/multipart\/form-data/', $request->headers->get('Content-Type')) or
            preg_match('/multipart\/form-data/', $request->headers->get('content-type'))
        ) {
            $params = array();
            new ParseInputStream($params);
            foreach($params as $param => $value) {
                if (is_string($value)) {
                    // it's key value string
                    $request->request->add([$param => $value]);
                } else {
                    // key is string and value is a file
                    $request->files->add([$param => $value]);
                }
            }
        }
        return $next($request);
    }
}