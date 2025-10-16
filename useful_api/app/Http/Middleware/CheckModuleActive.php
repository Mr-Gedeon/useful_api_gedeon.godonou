<?php

namespace App\Http\Middleware;

use App\Models\UserModule;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Closure;

class CheckModuleActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $module_id): Response
    {
        /**
         * find whereas the user with the given module_id
         * has a pair in the database
         */
        $user_id = $request->user()->id;

        switch ($module_id) {
            case 'urlModule':
                $module_id = 1;
                break;

            case 'walletModule':
                $module_id = 2;
                break;

            case 'marketplaceModule':
                $module_id = 3;
                break;

            case 'timeModule':
                $module_id = 4;
                break;

            case 'investmentModule':
                $module_id = 5;
                break;

            default:
                $module_id = null;
                break;
        }

        $activated = UserModule::where('user_id', '=', $user_id)
            ->where('module_id', '=', $module_id)
            ->first();

        if ($activated === null) {
            return response()->json(['error: Module inactive. Please activate this module to use it.'], 403);
        }

        return $next($request);
    }
}
