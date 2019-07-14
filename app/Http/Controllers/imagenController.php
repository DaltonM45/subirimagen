<?php

namespace App\Http\Controllers;
use App\imagenes;

use Illuminate\Http\Request;

class imagenController extends Controller
{
    public function subirImagen(Request $request){
         $name = '';
       
        if($request->nombre)
        {
          
           $name = time().'.' . explode('/', explode(':', substr($request->nombre, 0, 
           strpos($request->nombre, ';')))[1])[1];

           \Image::make($request->nombre)->save(public_path('images/').$name);
         }
 
        $image= new imagenes();
        $image->nombre = $name;
        $image->save();
 
        // return response()->json(['success' => 'You have successfully uploaded an image'], 200);


    }

    public function displayImagen(Request $request){
       $imagenes = imagenes::orderBy('id' , 'desc')->get();

       return ['imagenes' => $imagenes];
    }
}
