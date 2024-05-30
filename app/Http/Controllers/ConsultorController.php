<?php

namespace App\Http\Controllers;

use App\Models\ConsultorModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class ConsultorController extends Controller
{
    public function index()
    {
        return view('template', [
            'view' => View::make('consultores.index', [
                'consultores' => DB::table('consultor')->get()->toArray()
            ])
        ]);
    }

    public function cadastrar()
    {
        return view('template', ['view' => View::make('consultores.cadastrar')]);
    }

    public function editar(int $id)
    {
        $consultor = ConsultorModel::get($id);
        return view('consultores.editar', ['id' => $id, 'consultor' => $consultor]);
    }

    public function insert(Request $request): ?\Illuminate\Contracts\View\View
    {
        try {
            $nome = $request->input('nome');
            $email = $request->input('email');
            $dados = ['nome' => $nome, 'email' => $email];

            if (!$nome || strlen($nome) < 10) {
                return view('consultores.cadastrar', ['mensagem' => 'Insira um nome válido', 'type' => 'warning']);
            }

            if ($request->has('foto')) {
                $dados['foto'] = $request->file('foto')?->store('profiles', $nome);
            }

            DB::table('consultor')->insert($dados);
            return view('consultores.cadastrar', ['mensagem' => 'Consultor cadastrado com sucesso', 'type' => 'success']);
        } catch (\Throwable $e) {
            return view('consultores.cadastrar', ['mensagem' => $e->getMessage(), 'type' => 'danger']);
        }
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $view = ['id' => $id,];

        try {
            $nome = $request->input('nome');
            $email = $request->input('email');

            if (!$nome || strlen($nome) < 10) {
                return view('consultores.editar', [...$view, 'mensagem' => 'Insira um nome válido', 'type' => 'warning']);
            }

            $data = ['nome' => $nome, 'email' => $email];
            if ($request->has('foto')) {
                $foto = $request->file('foto');
                $data['foto'] = $foto->store('profiles');
            }

            ConsultorModel::updateItem($id, $data);
            $view['consultor'] = ConsultorModel::get($id);
            return view('consultores.editar', [...$view, 'mensagem' => 'Consultor atualizado com sucesso', 'type' => 'success']);
        } catch (\Throwable $e) {
            return view('consultores.editar', [...$view, 'mensagem' => $e->getMessage(), 'type' => 'danger']);
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
