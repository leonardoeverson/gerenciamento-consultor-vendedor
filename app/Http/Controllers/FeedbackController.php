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
            'view' => View::make('feedbacks.index', [
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

            return $this->getCadastrarTemplate('Feedback cadastrado com sucesso!', 'success');
        } catch (\Exception $e) {
            return $this->getCadastrarTemplate($e->getMessage(), 'danger');
        }
    }

    public function delete(Request $request)
    {
        $id = $request->post('id');
        if (!$id) {
            return null;
        }

        try {
            DB::table('feedback')->where(['id' => $id])->delete();
            $feedbacks = DB::table('feedback')->get()->toArray();
            return $this->getDeleteTemplate('feedbacks.index', 'Feedback excluído com sucesso', 'success', null, $feedbacks);
        } catch (\Throwable $e) {
            return $this->getDeleteTemplate('feedbacks.confirmar_exclusao', $e->getMessage(), 'danger', $id);
        }
    }

    private function getDeleteTemplate(string $view, string $message, string $type, int $id = null, array $feedbacks = [])
    {
        $data = [
            'message' => $message,
            'type' => $type
        ];

        if ($id) {
            $data['id'] = $id;
        }

        if (!empty($feedbacks)) {
            $data['feedbacks'] = $feedbacks;
        }

        return view($view, $data);
    }

    private function getCadastrarTemplate(string $message, string $type)
    {
        return view('feedbacks.cadastrar', [
            'consultores' => DB::table('consultor')->get()->toArray(),
            'mensagem' => $message,
            'type' => $type
        ]);
    }
}
