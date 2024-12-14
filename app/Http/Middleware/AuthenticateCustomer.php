namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateCustomer
{
    public function handle($request, Closure $next, ...$guards)
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('customerLogin.page');
        }

        return $next($request);
    }
}