<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ImageCrud;
use Illuminate\Http\Request;

class ImageCrudController extends Controller
{
    public function create(Request $request) {
        $images=new ImageCrud();
        $request -> validate([
            'cpf' => 'required',
            'telefone' => 'required',
            'email' => 'required',
            'image' => 'required|max:1024'
        ]);

        $filename="";
        if($request -> hasFile("image")) {
            $filename=$request->file('image')->store('posts', 'public');
        } else {
            $filename=Null;
        }
        $images->title = $request->title;
        $images->image = $request->image;
        $result = $images->save();
        if($result) {
            return response()->json(['sucess'=>true]);
        } else {
            return response()->json(['sucess'=>false]);
        }
    }
}
