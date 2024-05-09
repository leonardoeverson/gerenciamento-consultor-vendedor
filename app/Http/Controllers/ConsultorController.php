<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class ConsultorController extends Controller
{
    public function index()
    {
        return view('template', [
            'view' => View::make('consultores', [
                'consultores' => DB::table('consultor')->get()->toArray()
            ])
        ]);
    }

    public function cadastrar()
    {
        return view('template', ['view' => View::make('consultores.cadastrar')]);
    }

    public function insert(Request $request): ?\Illuminate\Contracts\View\View
    {
        try {
            $nome = $request->input('nome');
            if (!$nome || strlen($nome) < 10) {
                return view('consultores.cadastrar', ['mensagem' => 'Insira um nome válido', 'type' => 'warning']);
            }

            DB::table('consultor')->insert(['nome' => $nome]);
            return view('consultores.cadastrar', ['mensagem' => 'Consultor cadastrado com sucesso', 'type' => 'success']);
        } catch (\Throwable $e) {
            return view('consultores.cadastrar', ['mensagem' => $e->getMessage(), 'type' => 'danger']);
        }
    }

    public function delete(Request $request)
    {
        try {
            $id = $request->post('id');
            if (!is_numeric($id)) {
                return response(['message' => 'Id inválido'], 403);
            }

            DB::table('consultor')->where(['id' => $id])->delete();
            return response(['message' => 'Consultor excluído com sucesso']);
        } catch (\Throwable $e) {
            return response(['message' => 'Erro ao excluir o consultor', 'error' => $e->getMessage()], 500);
        }
    }
}
