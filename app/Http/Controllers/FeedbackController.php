<?php

namespace App\Http\Controllers;

use App\Models\FeedbackModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class FeedbackController extends Controller
{
    public function get()
    {
        return view('template', [
            'view' => View::make('feedbacks', [
                'feedbacks' => FeedbackModel::getFeedbacks(),
            ])
        ]);
    }

    public function cadastrar()
    {
        return view('template', [
            'view' => View::make('feedbacks.cadastrar', [
                'consultores' => DB::table('consultor')->get()->toArray(),
            ])
        ]);
    }

    public function excluir(int $id)
    {
        return view('feedbacks.confirmar_exclusao', ['id' => $id]);
    }

    public function insert(Request $request)
    {
        $consultor = $request->post('id_consultor');
        $descricao = $request->post('descricao');
        $estrategia = $request->post('estrategia');
        $observacoes = $request->post('observacoes');

        try {
            DB::table('feedback')->insert([
                'id_consultor' => $consultor,
                'descricao' => $descricao,
                'estrategia' => $estrategia,
                'observacoes' => $observacoes
            ]);

            return view('feedbacks.cadastrar', [
                'consultores' => DB::table('consultor')->get()->toArray(),
                'mensagem' => 'Feedback cadastrado com sucesso!',
                'type' => 'success'
            ]);
        } catch (\Exception $e) {
            return view('feedbacks.cadastrar', [
                'consultores' => DB::table('consultor')->get()->toArray(),
                'mensagem' => $e->getMessage(),
                'type' => 'danger'
            ]);
        }
    }

    public function update()
    {

    }

    public function delete(Request $request)
    {
        $id = $request->post('id');
        if (!$id) {
            return null;
        }

        try {
            DB::table('feedback')->where(['id' => $id])->delete();
            return view('feedbacks', [
                'feedbacks' => FeedbackModel::getFeedbacks(),
                'message' => 'Feedback excluído com sucesso',
                'type' => 'success'
            ]);
        } catch (\Throwable $e) {
            return view('feedbacks.confirmar_exclusao', [
                'id' => $id,
                'message' => $e->getMessage(),
                'type' => 'danger'
            ]);
        }
    }
}
