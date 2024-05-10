<?php

namespace App\Http\Controllers;

use App\Models\moto;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class MotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // pega tudo de "moto" e coloca dentro de "$dadosMotos"
        $dadosMotos = moto::All();
        // conta quantos tem e coloca em "contador"
        $contador = $dadosMotos -> count();

        // retorna contador + motos e coloca tudo isso em json
        return 'Motos: '.$contador.$dadosMotos.Response() -> json([],Response::HTTP_NO_CONTENT);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dadosMotos = $request -> All();
        $validarDados = Validator::make($dadosMotos, [
            'marca' => 'required',
            'modelo' => 'required',
            'cor' => 'required',
            'ano' => 'required',
        ]);

        if($validarDados -> fails()){
            return 'Dados Invalidos.'.$validarDados -> error(true). 500;
        }

        $motosCadastrar = moto::create($dadosMotos);
        if($motosCadastrar){
            return 'Dados cadastrados com sucesso.'.Response() -> json([],Response::HTTP_NO_CONTENT);
        } else{
            return 'Dados não cadastrados.'.Response() -> json([],Response::HTTP_NO_CONTENT);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $moto = moto::find($id);

        if($retorno){
            return 'Moto localizada.'.$moto.Response() -> json([],Response::HTTP_NO_CONTENT);
        } else{
            return 'oto não localizada.'.Response() -> json([],Response::HTTP_NO_CONTENT);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dadosMotos = $request -> all();
        $validarDados = Validator::make($dadosMotos, [
            'marca' => 'required',
            'modelo' => 'required',
            'cor' => 'required',
            'ano' => 'required',
        ]);

        if($validarDados -> fails()){
            return 'Dados Invalidos.'.$validarDados -> error(true). 500;
        }

        // traz do Moto o id da tabela de motos
        $moto = moto::find($id);
        $moto -> marca = $dadosMotos['marca']
        $moto -> modelo = $dadosMotos['modelo']
        $moto -> cor = $dadosMotos['cor']
        $moto -> ano = $dadosMotos['ano']

        $retorno = $moto -> save();

        if($retorno){
            return 'Dados atualizados com sucesso.'.Response() -> json([],Response::HTTP_NO_CONTENT);
        } else{
            return 'Dados não atualizados.'.Response() -> json([],Response::HTTP_NO_CONTENT);
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // pedindo pra encontrar o id e colocar em $dadosMotos
        $dadosMotos = moto::find($id);

        // se ele existe, exclua ele
        if($dadosMoto -> delete()){
            return 'O veículo foi deletado com sucesso'.Response() -> json([],Response::HTTP_NO_CONTENT);
        }

        return 'O veículo não foi deletado.'. response() -> json([], Response::HTTP_NO_CONTENT);
    }
}
