<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    //
    public function showWallet(Request $request): JsonResponse {

        $user_id = $request->user()->id;

        $user = User::find($user_id);

        return response()->json([
            "user_id"=> $user->id,
            "balance"=>$user->wallet,
        ], 200);
    }
}
