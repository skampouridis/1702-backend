<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Database\Eloquent\Collection;
use SoapBox\Formatter\Formatter;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FormatterMiddleware
{
    /**
     * Formats an Eloquent collection in json, xml or csv formats.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if ($request->filled('format'))
        {
            $originalResponse = $response->getOriginalContent();

            if ($originalResponse instanceof Collection) {

                $format = $request->input('format');
                $formatter = Formatter::make($originalResponse->toJson(), Formatter::JSON);

                if ($format == 'xml') {
                    return $response->setContent($formatter->toXml())->header('Content-Type', "text/$format");
                } else if ($format == 'csv') { // TODO fix SoapBox\Formatter\Formatter csv conversion problem
                    return $response->setContent($formatter->toCsv())->header('Content-Type', "text/$format");
                } else if ($format == 'json') {
                    return $response;
                } else {
                    throw new BadRequestHttpException();
                }

            } else if (is_array($originalResponse)) {
                return $response;
            } else {
                throw new NotFoundHttpException();
            }
        }

        // Default format is JSON
        return $response;
    }
}
