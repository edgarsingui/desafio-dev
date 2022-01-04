<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Move;
use Illuminate\Support\Facades\Validator;

class MoveController extends Controller
{
    public function importar(Request $request)
    {

    $regras = [
        "tipo"=>"required|max:1",
        "data"=>"required|max:8",
        "valor"=>"required|max:10",
        "cpf"=>"required|max:11",
        "cartao"=>"required|max:12",
        "hora"=>"required|max:6",
        "dono_da_loja"=>"required|max:14",
        "loja"=>"required|max:19",
      ];

      $mensagens = [
        "tipo.required"=>"Em falta o tipo de transação",
        "tipo.max"=>"O Tamanho do tipo de transação é maior que 1",
        "data.required"=>"Em falta data",
        "data.max"=>"O Tamanho da data é maior que 8",
        "valor.required"=>"Em falta o valor de transação",
        "valor.max"=>"O Tamanho do valor de transação é maior que 10",
        "cpf.required"=>"Em falta o cpf do cliente",
        "cpf.max"=>"O Tamanho do cpf é maior que 11",
        "cartao.required"=>"Em falta o número do cartão",
        "cartao.max"=>"O Tamanho do cartão é maior que 12",
        "hora.required"=>"Em falta a hora da transação",
        "hora.max"=>"O Tamanho da hora de transação é maior que 6",
        "dono_da_loja.required"=>"Em falta o nome do Dono da Loja",
        "dono_da_loja.max"=>"O Nome não pode ter mais que 14 digitos",
        "loja.required"=>"Em falta o nome da Loja",
        "loja.max"=>"Nome da Loja muito Longo",
      ];
     
     $move =[];
     foreach ($request->data as $key => $value) {

      $validator = Validator::make($value,$regras,$mensagens);

      if($validator->fails()){
        $mensagens = $validator->messages();
        $erros = $mensagens->all();
        return response()->json(["success"=>"false","message"=>$erros],500);
      }
        $move [] = [
            'type_id'=>$value['tipo'],
            'data'=>$value['data'],
            'valor'=>$value['valor'],
            'cpf'=>$value['cpf'],
            'cartao'=>$value['cartao'],
            'hora'=>$value['hora'],
            'dono_da_loja'=>$value['dono_da_loja'],
            'loja'=>$value['loja'],
        ];
       }  
       if(Move::insert($move)):
        return response()->json(['success'=>true,'message'=>"CNAB importado!!"],201);
       else:
        return response()->json(['success'=>false,'message'=>"Ocorreu um erro inesperado"],500);
       endif;

    }

    public function listar()
    {

        $data = Move::join('types','types.id','=','type_id')->join('natures','types.natureza_id','natures.id')->get(['moves.id','types.descricao as tipo','natures.sinal','natures.nome','data','valor','cpf','cartao','hora','loja']);
        $total_loja = Move::groupBy('loja')->get(['loja','id']);
        return response()->json(['success'=>true,'data'=>$data,'total_loja'=>$total_loja]);

    }

    public function movimentos(String $nome){
        //SELECT sum(valor) FROM `moves` inner join types on type_id = types.id inner join natures on natures.id = types.natureza_id where loja = "BAR DO JOÃO" and natures.nome = "Entrada";
        $movimentos = Move::join('types','types.id','=','type_id')->join('natures','types.natureza_id','natures.id')->where('loja',$nome)->get(['natures.sinal','types.descricao as tipo','valor']);

        $saldo = Move::join('types','types.id','=','type_id')->join('natures','natures.id','types.natureza_id')->where('loja','=',$nome)->where('natures.nome','Entrada')->selectRaw('sum(valor) as total')->get()[0]['total'];

        if($saldo == 'NULL' || $saldo == ''){
            $saldo = '0.00';
        }

        return response()->json(['saldo'=>$saldo,'movimentos'=>$movimentos/*'divida'=>$divida*/]);
    }
}
