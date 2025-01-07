<?php

namespace RefBytes\Outseta\Http\Controllers\Auth;

use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use RefBytes\Outseta\Models\Account;

class LoginController
{
    public function __invoke(\Illuminate\Http\Request $request)
    {
        $decoded = (array) JWT::decode(
            $request->get('access_token'),
            new Key(config('outseta.auth.public_key'), 'RS256')
        );

        logger()->info($decoded);

        $user = User::firstOrNew([
            'email' => $decoded['email'],
        ], [
            'name' => $decoded['given_name'].' '.$decoded['family_name'],
        ]);

        if (empty($user->password)) {
            $user->password = Hash::make(Str::uuid());
            $user->save();
        }

        if (empty($user->account_id)) {
            $user->account()->associate(Account::firstOrCreate([
                'uid' => $decoded['outseta:accountUid'],
            ]));
            $user->save();
        }

        Auth::login($user, remember: true);

        return $this
            ->intended(
                default: config('outseta.auth.redirect_after_login'),
                query: [
                    'access_token' => $request->get('access_token'),
                ]
            );
    }

    private function intended($default = '/', $query = [], $status = 302, $headers = [], $secure = null)
    {
        $path = session()->pull('url.intended', $default);

        $path = $path.'?'.http_build_query($query);

        return redirect()->to($path, $status, $headers, $secure);
    }
}
