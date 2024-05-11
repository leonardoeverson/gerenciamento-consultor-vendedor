<?php

namespace App\Http\Controllers;

use App\Models\AdvertenciaModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Throwable;

class AdvertenciaController extends Controller
{
    public function index()
    {
        return view('template', [
            'view' => view('advertencias.index', [
                'advertencias' => AdvertenciaModel::getAll(),
            ])
        ]);
    }

    public function cadastrar()
    {
        return view('template', [
            'view' => view('advertencias.cadastrar', [
                'consultores' => DB::table('consultor')->get()->toArray(),
            ])
        ]);
    }

    public function insert(Request $request)
    {
        $consultor = $request->get('consultor');
        $id_tipoadvertencia = $request->get('id_tipoadvertencia');
        $observacoes = $request->get('observacoes');

        if (!is_numeric($consultor)) {
            return $this->getCadastroTemplate('warning', 'Selecione um consultor');
        }

        if (!is_numeric($id_tipoadvertencia)) {
            return $this->getCadastroTemplate('warning', 'Selecione um tipo de advertência');
        }

        try {
            DB::table('advertencia')->insert([
                'id_consultor' => $consultor,
                'id_tipoadvertencia' => $id_tipoadvertencia,
                'observacoes' => $observacoes,
            ]);
            return $this->getCadastroTemplate('success', 'Advertência cadastrada com sucesso');
        } catch (Throwable $e) {
            return $this->getCadastroTemplate('danger', $e->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse|null
     */
    public function delete(Request $request): ?JsonResponse
    {
        $id = $request->post('id');
        if (!is_numeric($id)) {
            return response()->json(['message' => 'Id inválido'], 401);
        }

        try {
            DB::table('advertencia')->where('id', $id)->delete();
            return response()->json(['message' => 'Advertência excluída com sucesso']);
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * @param string $type
     * @param string $message
     * @return \Illuminate\Contracts\Foundation\Application|Factory|\Illuminate\Contracts\View\View|Application|View
     */
    private function getCadastroTemplate(string $type, string $message)
    {
        return view('advertencias.cadastrar', [
            'consultores' => DB::table('consultor')->get()->toArray(),
            'message' => $message,
            'type' => $type
        ]);
    }
}