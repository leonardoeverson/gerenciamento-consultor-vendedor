<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdvertenciaModel extends Model
{
    protected $table = 'advertencia';

    /**
     * @return array<array{
     * id: int,
     * consultor: string,
     * observacoes: string,
     * tipo_advertencia: string,
     * datahora: string,
     * }>
     */
    public static function getAll(): array
    {
        $sql = 'select
                    advertencia.id,
                    nome consultor,
                    observacoes,
                    descricao tipo_advertencia,
                    advertencia.datahora
                from advertencia
                    join consultor on consultor.id = advertencia.id_consultor
                    join advertencia_tipo on advertencia.id_tipoadvertencia = advertencia_tipo.id';
        return DB::select($sql);
    }
}