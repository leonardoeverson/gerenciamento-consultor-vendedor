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

    public function editar(int $id)
    {
        $advertencia = AdvertenciaModel::find($id);

        return view('advertencias.editar', [
            'id' => $id,
            'consultores' => DB::table('consultor')->get()->toArray(),
            'advertencia' => $advertencia
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

    public function update(Request $request)
    {
        $id = $request->post('id');
        $consultor = $request->post('consultor');
        $id_tipoadvertencia = $request->post('id_tipoadvertencia');
        $observacoes = $request->post('observacoes');

        $advertencia = AdvertenciaModel::find($id);

        if (!is_numeric($consultor)) {
            return $this->getCadastroTemplate('warning', 'Selecione um consultor', 'editar', $advertencia, $id);
        }

        if (!is_numeric($id_tipoadvertencia)) {
            return $this->getCadastroTemplate('warning', 'Selecione um tipo de advertência', 'editar', $advertencia, $id);
        }

        try {
            DB::table('advertencia')
                ->where('id', $id)
                ->update([
                    'id_consultor' => $consultor,
                    'id_tipoadvertencia' => $id_tipoadvertencia,
                    'observacoes' => $observacoes,
                ]);
            $advertencia = AdvertenciaModel::find($id);
            return $this->getCadastroTemplate('success', 'Advertência atualizada com sucesso', 'editar', $advertencia, $id);
        } catch (Throwable $e) {
            return $this->getCadastroTemplate('danger', $e->getMessage(), 'editar', $advertencia, $id);
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
     * @param string $template
     * @param array|AdvertenciaModel|null $advertencia
     * @param int|null $id
     * @return \Illuminate\Contracts\Foundation\Application|Factory|\Illuminate\Contracts\View\View|Application|View
     */
    private function getCadastroTemplate(
        string                      $type,
        string                      $message,
        string                      $template = 'cadastrar',
        array|AdvertenciaModel|null $advertencia = null,
        ?int                        $id = null
    )
    {
        return view('advertencias.' . $template, [
            'consultores' => DB::table('consultor')->get()->toArray(),
            'message' => $message,
            'type' => $type,
            'advertencia' => $advertencia,
            'id' => $id
        ]);
    }
}