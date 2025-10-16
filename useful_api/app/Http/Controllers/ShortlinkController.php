<?php

namespace App\Http\Controllers;

use App\Models\Shortlink;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Validator;

class ShortlinkController extends Controller
{
    //
    public function shorten(Request $request): JsonResponse {

        // assure that the inputs are valid
        $validator = Validator::make($request->all(), [
            'original_url' => ['required', 'string', 'url', 'max:255', 'unique:' . Shortlink::class],
            'custom_code' => ['nullable', 'string', 'max:10', 'unique:' . Shortlink::class],
        ]);

        if ($validator->fails()) {
            # code...
            return response()->json(status: 400);

        }
    }
}
