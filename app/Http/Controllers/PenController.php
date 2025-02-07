<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pen;

class PenController extends Controller
{
    public function index(){
        $name = Pen::all();
        return response()->json($name);
    }

    public function store(Request $request){
        $name = Pen::create($request->all());
        return response()->json($name,201);
    }

    public function update(Request $request, $id){
        $id = Pen::find($id);
        if($id){
            return response()->json('pen not found');
        }
        $id->update($request->all());
        return response()->json($id);
    }

    public function delete($id){
        $name = Pen::find($id);
        if($id){
            return response()->json('pen not found');
        }
        $result = $name->delete();
        return response()->json($result);
    }
}
