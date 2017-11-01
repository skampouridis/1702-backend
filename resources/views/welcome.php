<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Readme | <?php echo config('app.name'); ?></title>
        <meta name="robots" content="noindex, nofollow" />

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" />

        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <style type="text/css">
            body {background: #f1f4f9; line-height: 1.2em;}
            hr {border-color: lightgreen;}
            h1 {margin: 1em 0 1em 0; color: #aaa; text-shadow: 1px 1px 1px #fff; border-bottom: 2px solid #bbb; padding-bottom: 15px;}
            h3, h4 {color: darkcyan;}
            ul li {margin-bottom: 9px; line-height: 1.5em;}
        </style>
    </head>
    <body>


        <div class="container">
            <div class="row">

                <div class="col-md-12">

                    <h2>RESTful API</h2>
                    <p>
                        Vessel positions search works according to specifications and responses are made in json, csv and xml. Results are paginated (see config/app).
                        For the correct responses I created an ApiResponder class (see app/Lib). ApiResponder subclasses have their own implementation using different packages for CSV and XML to demostrate a basic Adapter Design Pattern (ApiResponderJson works with native Laravel response object).
                        A new adapter/driver can be easily created by extending the abstract class and implementing the abstract response method.
                    </p>
                    <p>Sample CRUD operations were made for an imaginary Vessels entity (just a test table) and in json format only (resource controller).</p>

                    <hr />

                    <h2>PHP Docs</h2>
                    <p>Basic generated PHP Docs can be found in <a href="/phpdocs/" target="_blank">/phpdocs</a> folder.</p>

                    <hr />

                    <h2>Unit and Feature Tests</h2>

                    <p>Basic unit and feature/integration tests are written in tests folder for all controllers/models.</p>

                    <pre>C:\xampp\htdocs\test\laravel-mt-291017>phpunit
PHPUnit 5.7.23 by Sebastian Bergmann and contributors.

..............                                                    14 / 14 (100%)

Time: 1.85 seconds, Memory: 18.00MB

OK (14 tests, 32 assertions)</pre>
                    <hr />

                    <h2>Routes</h2>

                    <p>Below is a list of the registered routes:</p>
                    <pre>
+-----------+---------------------------+------------------+------------------------------------------------------------------------+--------------+
| Method    | URI                       | Name             | Action                                                                 | Middleware   |
+-----------+---------------------------+------------------+------------------------------------------------------------------------+--------------+
| GET|HEAD  | /                         |                  | App\Http\Controllers\IndexController@index                             | web          |
| GET|HEAD  | api/positions/search      |                  | App\Http\Controllers\Api\PositionController@search                     | api,auth:api |
| GET|HEAD  | api/user                  |                  | Closure                                                                | api,auth:api |
| POST      | api/vessels               | vessels.store    | App\Http\Controllers\Api\VesselController@store                        | api,auth:api |
| GET|HEAD  | api/vessels               | vessels.index    | App\Http\Controllers\Api\VesselController@index                        | api,auth:api |
| GET|HEAD  | api/vessels/create        | vessels.create   | App\Http\Controllers\Api\VesselController@create                       | api,auth:api |
| DELETE    | api/vessels/{vessel}      | vessels.destroy  | App\Http\Controllers\Api\VesselController@destroy                      | api,auth:api |
| GET|HEAD  | api/vessels/{vessel}      | vessels.show     | App\Http\Controllers\Api\VesselController@show                         | api,auth:api |
| PUT|PATCH | api/vessels/{vessel}      | vessels.update   | App\Http\Controllers\Api\VesselController@update                       | api,auth:api |
| GET|HEAD  | api/vessels/{vessel}/edit | vessels.edit     | App\Http\Controllers\Api\VesselController@edit                         | api,auth:api |
+-----------+---------------------------+------------------+------------------------------------------------------------------------+--------------+</pre>


                    <hr />

                    <h2>Postman test cases (or use directly the browser)</h2>
                    <h4>- Without api_token <small>error "Unauthenticated" with correct output format using ApiResponder without ugly if/else - see \App\Exceptions\Handler::unauthenticated()</small></h4>
                    <ul>
                        <li><?php echo config('app.url'); ?>/api/positions/search</li>
                        <li><?php echo config('app.url'); ?>/api/positions/search?format=json</li>                        
                        <li><?php echo config('app.url'); ?>/api/positions/search?format=csv</li>
                        <li><?php echo config('app.url'); ?>/api/positions/search?format=xml</li>
                    </ul>

                    <h4>- Authenticated requests <small>(use api_token=UTUQNqMQkKyHUU4HXntrlCxrNfyB6rduuMLC0DCAKbIXbnZqihXFTmxGt3D7NLmD)</small></h4>

                    <p>Search positions without filters</p>
                    <ul>
                        <li><?php echo config('app.url'); ?>/api/positions/search?api_token=UTUQNqMQkKyHUU4HXntrlCxrNfyB6rduuMLC0DCAKbIXbnZqihXFTmxGt3D7NLmD&format=json</li>
                        <li><?php echo config('app.url'); ?>/api/positions/search?api_token=UTUQNqMQkKyHUU4HXntrlCxrNfyB6rduuMLC0DCAKbIXbnZqihXFTmxGt3D7NLmD&format=csv</li>
                        <li><?php echo config('app.url'); ?>/api/positions/search?api_token=UTUQNqMQkKyHUU4HXntrlCxrNfyB6rduuMLC0DCAKbIXbnZqihXFTmxGt3D7NLmD&format=xml</li>
                    </ul>

                    <p>Search positions with filter_mmsi (array - for multiple use filter_mmsi[]=aaa&filter_mmsi[]=bbb)</p>
                    <ul>
                        <li><?php echo config('app.url'); ?>/api/positions/search?filter_mmsi[]=311486000&api_token=UTUQNqMQkKyHUU4HXntrlCxrNfyB6rduuMLC0DCAKbIXbnZqihXFTmxGt3D7NLmD&format=json</li>
                        <li><?php echo config('app.url'); ?>/api/positions/search?filter_mmsi[]=311486000&api_token=UTUQNqMQkKyHUU4HXntrlCxrNfyB6rduuMLC0DCAKbIXbnZqihXFTmxGt3D7NLmD&format=csv</li>
                        <li><?php echo config('app.url'); ?>/api/positions/search?filter_mmsi[]=311486000&api_token=UTUQNqMQkKyHUU4HXntrlCxrNfyB6rduuMLC0DCAKbIXbnZqihXFTmxGt3D7NLmD&format=xml</li>
                    </ul>


                    <p>Search positions with filter_lat_from / filter_lat_to (numeric - use dot for decimal)</p>
                    <ul>
                        <li><?php echo config('app.url'); ?>/api/positions/search?filter_lat_from=40&filter_lat_to=40.6&api_token=UTUQNqMQkKyHUU4HXntrlCxrNfyB6rduuMLC0DCAKbIXbnZqihXFTmxGt3D7NLmD&format=json</li>
                        <li><?php echo config('app.url'); ?>/api/positions/search?filter_lat_from=40&filter_lat_to=40.6&api_token=UTUQNqMQkKyHUU4HXntrlCxrNfyB6rduuMLC0DCAKbIXbnZqihXFTmxGt3D7NLmD&format=csv</li>
                        <li><?php echo config('app.url'); ?>/api/positions/search?filter_lat_from=40&filter_lat_to=40.6&api_token=UTUQNqMQkKyHUU4HXntrlCxrNfyB6rduuMLC0DCAKbIXbnZqihXFTmxGt3D7NLmD&format=xml</li>
                    </ul>

                    <p>Search positions with filter_lot_from / filter_lot_to (numeric - use dot for decimal)</p>
                    <ul>
                        <li><?php echo config('app.url'); ?>/api/positions/search?filter_lon_from=11&filter_lon_to=12.56&api_token=UTUQNqMQkKyHUU4HXntrlCxrNfyB6rduuMLC0DCAKbIXbnZqihXFTmxGt3D7NLmD&format=json</li>
                        <li><?php echo config('app.url'); ?>/api/positions/search?filter_lon_from=11&filter_lon_to=12.56&api_token=UTUQNqMQkKyHUU4HXntrlCxrNfyB6rduuMLC0DCAKbIXbnZqihXFTmxGt3D7NLmD&format=csv</li>
                        <li><?php echo config('app.url'); ?>/api/positions/search?filter_lon_from=11&filter_lon_to=12.56&api_token=UTUQNqMQkKyHUU4HXntrlCxrNfyB6rduuMLC0DCAKbIXbnZqihXFTmxGt3D7NLmD&format=xml</li>
                    </ul>

                    <p>Search positions with filter_timestamp_from / filter_timestamp_to (string - any valid date/datetime in mysql format YYYY-MM-DD HH:MM:SS)</p>
                    <ul>
                        <li><?php echo config('app.url'); ?>/api/positions/search?filter_timestamp_from=2017-02-18 10&filter_timestamp_to=2017-02-18 11:55:44&api_token=UTUQNqMQkKyHUU4HXntrlCxrNfyB6rduuMLC0DCAKbIXbnZqihXFTmxGt3D7NLmD&format=json</li>
                        <li><?php echo config('app.url'); ?>/api/positions/search?filter_timestamp_from=2017-02-18 10&filter_timestamp_to=2017-02-18 11:55:44&api_token=UTUQNqMQkKyHUU4HXntrlCxrNfyB6rduuMLC0DCAKbIXbnZqihXFTmxGt3D7NLmD&format=csv</li>
                        <li><?php echo config('app.url'); ?>/api/positions/search?filter_timestamp_from=2017-02-18 10&filter_timestamp_to=2017-02-18 11:55:44&api_token=UTUQNqMQkKyHUU4HXntrlCxrNfyB6rduuMLC0DCAKbIXbnZqihXFTmxGt3D7NLmD&format=xml</li>
                    </ul>

                    <p>Any combination that makes sense.. For example...</p>
                    <ul>
                        <li><?php echo config('app.url'); ?>/api/positions/search?filter_mmsi[]=311486000&filter_timestamp_from=2017-02-18 11&filter_timestamp_to=2017-02-18 12&api_token=UTUQNqMQkKyHUU4HXntrlCxrNfyB6rduuMLC0DCAKbIXbnZqihXFTmxGt3D7NLmD&format=json</li>
                    </ul>

                    <hr />

                    <h2>Rate Limit</h2>

                    <p>For rate limit functionality, Laravel's default api middleware is used. The only change made was in Kernel.php configuration: throttle:10,60 (10 requests per 60 minutes).</p>

                    <h4>Headers (normal operation)</h4>
                    <pre>Cache-Control: no-cache, private
Connection: Keep-Alive
Content-Type: application/xml
Date: Wed, 01 Nov 2017 01:19:21 GMT
Keep-Alive: timeout=5, max=96
Server: Apache/2.4.23 (Win32) OpenSSL/1.0.2h PHP/5.6.31
Transfer-Encoding: chunked
X-Powered-By: PHP/5.6.31
X-RateLimit-Limit: 10
<span style="color: green">X-RateLimit-Remaining: 3</span></pre>

                    <h4>Headers (limit reached)</h4>
                    <pre>Cache-Control: no-cache, private
Connection: Keep-Alive
Content-Length: 18
Content-Type: text/html; charset=UTF-8
Date: Wed, 01 Nov 2017 01:20:36 GMT
Keep-Alive: timeout=5, max=95
<span style="color: red">Retry-After: 3600</span>
Server: Apache/2.4.23 (Win32) OpenSSL/1.0.2h PHP/5.6.31
X-Powered-By: PHP/5.6.31
X-RateLimit-Limit: 10
<span style="color: red">X-RateLimit-Remaining: 0</span>
<span style="color: red">X-RateLimit-Reset: 1509502836</span></pre>
                </div>


            </div>
        </div>





    </body>
</html>