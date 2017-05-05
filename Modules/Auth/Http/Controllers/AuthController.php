<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator;
use Modules\Auth\Http\Requests\LoginRequest;
use \Carbon\Carbon;
class AuthController extends Controller
{
    public function authenticate(LoginRequest $request)
    {
        try {
            $token = JWTAuth::attempt($request->only('email', 'password'), [
                'expiration' => Carbon::now()->addHours(8)->timestamp
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

            // $data['user'] = $request->user();
            $meta['access_token'] = $token;
            $meta['expires_in'] = Carbon::now()->addHours(8)->timestamp;

            return response()->json($meta);
        }
    }

}
