<?php
namespace App\Lib;
use Illuminate\Http\Request;
use Illuminate\Cache\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Lang;
class  ThrottlesActiveCode
{
    public function hasTooManyActiveCodeAttempts(Request $request)
    {
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request),3
        );
    }
    protected function limiter()
    {
        return app(RateLimiter::class);
    }
    protected function throttleKey(Request $request)
    {
        return  Str::lower($request->ip());
    }
    public function incrementLoginAttempts(Request $request)
    {
        $this->limiter()->hit(
            $this->throttleKey($request),2
        );
    }
    public function fireLockoutEvent(Request $request)
    {
        event(new Lockout($request));
    }
    public function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        throw ValidationException::withMessages([
            'mobile_number' => [Lang::get('auth.throttleActiveCode', ['seconds' => $seconds])],
        ])->status(429);
    }

}
