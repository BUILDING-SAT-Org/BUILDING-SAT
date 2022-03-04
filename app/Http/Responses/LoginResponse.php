<?php

declare(strict_types=1);

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request): Response
    {

        $user = Auth::user();

        $request->session()->put('user_id', $user->id);
        $request->session()->put('user_name', $user->name);

        return redirect('/dashboard');
    }
}
