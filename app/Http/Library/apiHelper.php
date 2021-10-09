<?php

namespace App\Http\Library;

trait apiHelper {

    protected function isAdmin($user){

        if(!empty($user)){

            return $user->tokenCan('admin');
        }

        return false;
    }

    protected function isAdmision($user){

        if(!empty($user)){

            return $user->tokenCan('admision');
        }

        return false;
    }

    protected function onSuccess($data, string $message = '', int $code = 200){
    
        return response()->json([
            'status' => $code,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    protected function onError(int $code, string $message = ''){

        return response()->json([
            'status' => $code,
            'message' => $message,
        ], $code);
    }

    protected function onMessage(int $code, string $message = ''){

        return response()->json([
            'status' => $code,
            'message' => $message,
        ], $code);
    }

    protected function onLogin($data, $token, string $message = '', int $code = 201){

        return response()->json([
            'status' => $code,
            'message' => $message,
            'data' => $data,
            'token' => $token
        ], $code);
    }

}
