<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\UserModule;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class ModuleController extends Controller
{
    
    public function show(): JsonResponse {

        $modules = Module::all();
        return response()->json([$modules]);
    }

    public function activate(Request $request): JsonResponse {

        
        $module_id = $request->id;
        
        $user_id = $request->user()->id;
        
        $module = Module::find($module_id);

        if ($module !== null) {

            $activated = UserModule::where('user_id', "=", $user_id)
            ->where("module_id", "=", $module_id)->first();

            if ($activated !== null) {
                # code...
                return response()->json(["message"=>"Module already activated"], 200);

            } else {
                # code...
                UserModule::create([
                    'user_id' => $user_id,
                    'module_id' => $module_id,
                    'active' => true
                ]);

                return response()->json(["message"=>"Module activated"], 200);
            }
            
            

        } else {
            # code...
            return response()->json(status:404);
        }


    }
}
