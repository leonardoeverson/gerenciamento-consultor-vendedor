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
                'consultores' => DB::table('consultor')->get()->toArray(),
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

    public function editar(Request $request)
    {
        try {
            $id = $request->post('id');
            if (!$id) {
                return response()->json(['message' => 'Requisição inválida'], 400);
            }

            $feedback = FeedbackModel::getById($id)[0] ?? null;

            if (empty($feedback)) {
                return response()->json(['message' => 'Requisição inválida'], 400);
            }
            return view('feedbacks.cadastrar', [
                'consultores' => DB::table('consultor')->get()->toArray(),
                'feedback' => $feedback,
                'mode' => 'update',
                'id' => $id,
            ]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function excluir(int $id)
    {
        return view('feedbacks.confirmar_exclusao', ['id' => $id]);
    }

    public function pesquisar(Request $request)
    {
        $consultor = $request->get('id_consultor');
        $inicio = $request->get('periodoinicial');
        $fim = $request->get('periodofinal');

        return view('feedbacks.list', ['feedbacks' => FeedbackModel::getFeedbacks($inicio, $fim, $consultor)]);
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

    public function update(Request $request)
    {
        $id = $request->post('id');
        $consultor = $request->post('id_consultor');
        $descricao = $request->post('descricao');
        $estrategia = $request->post('estrategia');
        $observacoes = $request->post('observacoes');

        try {
            DB::table('feedback')->where(['id' => $id])->update([
                'id_consultor' => $consultor,
                'descricao' => $descricao,
                'estrategia' => $estrategia,
                'observacoes' => $observacoes
            ]);

            return $this->getCadastrarTemplate('Feedback atualizado com sucesso!', 'success');
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
