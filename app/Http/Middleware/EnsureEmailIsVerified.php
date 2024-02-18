use Closure;

class EnsureEmailIsVerified
{
    public function handle($request, Closure $next)
    {
        if (!$request->user() || !$request->user()->hasVerifiedEmail()) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
