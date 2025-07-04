<?php

use Illuminate\Support\Facades\Route;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


Route::post('/clientes', function (Request $request) {
    // Regras de validação
    $validator = Validator::make($request->all(), [
        'nome'     => 'required|string',
        'email'    => 'required|email|unique:clientes,email',
        'telefone' => 'required|string',
        'cnpj'     => [
            'required',
            'regex:/^\d{2}\.\d{3}\.\d{3}\/\d{4}-\d{2}$/', // valida formato 00.000.000/0000-00
            'unique:clientes,cnpj',
        ],
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()->first()], 400);
    }

    $cliente = Cliente::create([
        'nome'     => $request->nome,
        'email'    => $request->email,
        'telefone' => $request->telefone,
        'cnpj'     => $request->cnpj,
        'status'   => 'pendente',
    ]);

    return response()->json(['status' => $cliente->status], 200);
});

Route::get('/clientes', function (Request $request) {
    $query = Cliente::query();

    if ($request->has('nome')) {
        $query->where('nome', 'like', '%' . $request->nome . '%');
    }

    return response()->json($query->get(), 200);
});

Route::post('/clientes/{cliente}/aprovar', function (Cliente $cliente) {
    if ($cliente->status === 'aprovado') {
        return response()->json(['error' => 'Cliente já aprovado'], 400);
    }

    $cliente->status = 'aprovado';
    $cliente->save();

    return response()->json(['status' => 'aprovado'], 200);
});
