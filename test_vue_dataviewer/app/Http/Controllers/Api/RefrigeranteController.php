<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Refrigerante;
use App\Http\Resources\RefrigeranteCollection;
use App\Http\Resources\RefrigeranteResource;

class RefrigeranteController extends Controller
{
    public function index()
    {
     //   return  Refrigerante::all();
     return new RefrigeranteCollection(Refrigerante::orderBy('id','DESC')->paginate(10));
    }

    public function search($field,$query)
    {
      //http://localhost:8000/api/search/refrigerantes/name/up
        return new RefrigeranteCollection(Refrigerante::where($field,'LIKE',"%$query%")->latest()->paginate(10));
    }

    public function store(Request $request)
    {
      $this->validate($request,[
        //  'required|unique:refrigerantes',
         'marca' => 'required',
         'tipo' => 'required',
         'sabor' => 'required',
         'litragem' => 'required',
         'valor_unidade' => 'required|numeric',
         'quantidade' => 'required'
         
     ]);
  



     $refrigerante = new Refrigerante();
     $refrigerante->marca = $request->marca;
     $refrigerante->tipo = $request->tipo;
     $refrigerante->sabor = $request->sabor;
     $refrigerante->litragem = $request->litragem;
     $refrigerante->valor_unidade = $request->valor_unidade;
     $refrigerante->quantidade = $request->quantidade;
     $refrigerante->save();
     return new RefrigeranteResource($refrigerante);

    }


    public function show($id)
    {
       return new RefrigeranteResource(Refrigerante::findOrFail($id));
    }


    public function update(Request $request, $id)
    {
      
      $this->validate($request,[
         'marca' =>  'required',
         'tipo' => 'required',
         'sabor' => 'required',
         'litragem' => 'required',
         'valor_unidade' => 'required|numeric',
         'quantidade' => 'required'
         
     ]);
     $refrigerante = Refrigerante::findOrfail($id);
     $refrigerante->marca = $request->marca;
     $refrigerante->tipo = $request->tipo;
     $refrigerante->sabor = $request->sabor;
     $refrigerante->litragem = $request->litragem;
     $refrigerante->valor_unidade = $request->valor_unidade;
     $refrigerante->quantidade = $request->quantidade;
     
     $refrigerante->save();
     return new RefrigeranteResource($refrigerante);
    
    }


    public function destroy($id)
    {
    
    $refrigerante = Refrigerante::findOrfail($id);
    $refrigerante->delete();
    return new RefrigeranteResource($refrigerante);
    
    }
}
