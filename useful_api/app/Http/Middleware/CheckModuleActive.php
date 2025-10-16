<?php

namespace App\Http\Middleware;

use App\Models\UserModule;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckModuleActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /**
         * find whereas the user with the given module_id
         * has a pair in the database
         */

        $user_id = $request->user()->id;

        $module_id = $request->id;

        $activated = UserModule::where('user_id', "=", $user_id)
        ->where("module_id", "=", $module_id)->first();

        if ($activated === null) {
            
            return response()->json(["error: Module inactive. Please activate this module to use it."], 403);
        }

        return $next($request);
    }
}
