<?php
	namespace App\Http\Middleware;
	use Closure;


	class Cors {
		public function handle($request, Closure $next){
            $response = $next($request);
            $response->headers->set('Access-Control-Allow-Origin', '*');
			$response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
			$response->headers->set('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization, X-Request-With, Accept-Language, Content-Language, Content-Length, Content-Range, X-CSRF-TOKEN');
			$response->headers->set('Access-Control-Allow-Credentials', 'true');

			return $response;
		}

	}
 ?>
