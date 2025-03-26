<?php

namespace RefBytes\Outseta\Http\Controllers\Auth;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController
{
    public function __invoke(\Illuminate\Http\Request $request)
    {
        $decoded = (array) JWT::decode(
            $request->get('access_token'),
            new Key(config('outseta.auth.public_key'), 'RS256')
        );

        $user = config()->get('outseta.auth.user')::firstOrNew([
            'email' => $decoded['email'],
        ], [
            'name' => $decoded['given_name'].' '.$decoded['family_name'],
        ]);

        if (empty($user->password)) {
            $user->password = Hash::make(Str::uuid());
            $user->save();
        }

        if (empty($user->account_id)) {
            $user->account()->associate(config()->get('outseta.auth.account')::firstOrCreate([
                'uid' => $decoded['outseta:accountUid'],
            ], [
                'name' => $decoded['email'],
            ]));
            $user->save();
        }

        Auth::login($user, remember: true);

        session(['outseta_access_token' => $request->get('access_token')]);

        return $this
            ->intended(
                default: config('outseta.auth.redirect_after_login'),
            );
    }

    private function intended($default = '/', $query = [], $status = 302, $headers = [], $secure = null)
    {
        $path = session()->pull('url.intended', $default);

        $path = $path.'?'.http_build_query($query);

        return redirect()->to($path, $status, $headers, $secure);
    }
}
