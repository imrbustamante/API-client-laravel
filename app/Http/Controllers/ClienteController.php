<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Types\BaseResponse;

class ClienteController extends Controller
{
    private $requiredFields =[
        'nome',
        'data_nascimento',
        'sexo',
    ];
    public function index()
    {
        //echo 1234;
        return response()->json(new BaseResponse(Cliente::all()));
    }

    public function store(Request $request)
    {
        foreach($this->requiredFields as $key){
            if(!$request->get($key)){
                return response()->json(new BaseResponse(['field'=>$key], false,'Campos requeridos'));
            }
        }

        Cliente::create([
            'nome'=>$request->get('nome'),
            'data_nascimento'=>$request->get('data_nascimento'),
            'sexo'=>$request->get('sexo'),
        ]);
        return response()->json(new BaseResponse('null', true, 'Cliente criado com sucesso'));
    }

    public function show($id)
    {
        $cliente = Cliente::find($id);
        if($cliente){
            return response()->json(new BaseResponse($cliente));
        }
        return response()->json(new BaseResponse(null, false, 'Cliente não encontrado'));
    }
    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);
        if($cliente){
            foreach($this->requiredFields as $key){
                if(!$request->get($key)){
                    return response()->json(new BaseResponse(['field'=>$key], false,'Campos requeridos'));
                }
            }
            $cliente->update([
                'nome'=>$request->get('nome'),
                'data_nascimento'=>$request->get('data_nascimento'),
                'sexo'=>$request->get('sexo'),
            ]);
            return response()->json(new BaseResponse('null', true, 'Cliente atualizado com sucesso'));
        }
        return response()->json(new BaseResponse('null', true, 'Cliente não encontrado'));
    }
    public function destroy($id)
    {
        $cliente = Cliente::find($id);
       if($cliente){
            $cliente->delete();
            return response()->json(new BaseResponse(null,true,'Cliente removido'));
        }
        return response()->json(new BaseResponse(null, false, 'Cliente não encontrado'));
    }
}
