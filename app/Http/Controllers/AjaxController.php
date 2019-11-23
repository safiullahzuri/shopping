<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{    
    public function get(Request $request){
        return response()->json($request->id, 200);
    }

    function getctrl(){

        return view('ajax/ctrl');
    }

    public function ctrl(){
        return "ctrl";
    }


}
