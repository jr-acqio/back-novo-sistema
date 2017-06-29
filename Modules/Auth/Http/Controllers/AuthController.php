<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use JWTAuth;
use Modules\Access\Entities\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator;
use Modules\Auth\Http\Requests\LoginRequest;
use \Carbon\Carbon;
class AuthController extends Controller
{
    public function authenticate(LoginRequest $request)
    {
        try {
            $expired = Carbon::now()->addHours(8)->timestamp;
            $token = JWTAuth::attempt($request->only('email', 'password'), [
                'expiration' => $expired
                ]);
        } catch (JWTException $e) {
            return response()->json([
                'error' => 'Não foi possível autenticar',
                ], 500);
        }

        if (!$token) {
            return response()->json([
                'error' => 'Não foi possível autenticar, verifique suas credenciais e tente novamente!',
                ], 401);
        } else {
            $data = [];
            $meta = [];

            $meta['token'] = $token;
            $meta['expires_in'] = $expired;
            $meta['user'] = User::where('email',$request->only('email'))->with('roles')->first();
            return response()->json($meta);
        }
    }

}
