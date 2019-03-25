<?php
namespace App\Http\Middleware;
use Closure;
use Request;
class locationRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // getting user country based on ip address
        $ip= $request->ip();
        $user_country_code="us";
        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
            $user_country_code= @$ipdat->geoplugin_countryCode;
        }
        if($user_country_code!=null &&  $user_country_code !="us"){
            $user_domain=$user_country_code."yourdomain.com";
            return Redirect::to($user_domain);
        }
        return $next($request);
    }
}

?>
