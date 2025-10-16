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
            'original_url' => ['required', 'string', 'url', 'max:255'],
            'custom_code' => ['nullable', 'string', 'max:10', 'unique:' . Shortlink::class . ',code'],
        ]);

        if ($validator->fails()) {
            # code...
            return response()->json(status: 400);

        }

        $user_id = $request->user()->id;

        if ($request->custom_code !== null) {
            
            if (preg_match('/[^\w\/\_\-]/', $request->custom_code) === 1) {
                return response()->json(status: 400);
            }

            $result = Shortlink::create([
                'user_id' => $user_id,
                'original_url' => $request->original_url,
                'code' => $request->custom_code
            ]);

            $url = Shortlink::where('code', "=", $request->custom_code)->first();

            return response()->json([
                'id' => $url->id,
                'user_id' => $url->user_id,
                'original_url' => $url->original_url,
                'code' => $url->code,
                'clicks' => $url->clicks,
                'created_at' => $url->created_at->format('c:p'),
            ]);

        } else {
            $custom_code = substr(md5(uniqid(rand(), true)), 0, 6);

            $result = Shortlink::create([
                'user_id' => $user_id,
                'original_url' => $request->original_url,
                'code' => $custom_code
            ]);

            $url = Shortlink::where('code', "=", $custom_code)->first();

            return response()->json([
                'id' => $url->id,
                'user_id' => $url->user_id,
                'original_url' => $url->original_url,
                'code' => $url->code,
                'clicks' => $url->clicks,
                'created_at' => $url->created_at->format('c:p'),
            ]);
        }

    }
}
