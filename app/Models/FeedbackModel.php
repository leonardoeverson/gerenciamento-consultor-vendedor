<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FeedbackModel extends Model
{
    public $timestamps = false;

    protected $table = 'feedback';

    /**
     * @return array<array{
     * id: int,
     * descricao: string,
     * estrategia: string,
     * observacoes: string|null,
     * nome: string,
     * datahora: string,
     * }>
     */
    public static function getFeedbacks(): array
    {
        $sql = 'SELECT feedback.id, 
                       feedback.descricao,
                       feedback.estrategia,
                       feedback.observacoes,
                       consultor.nome,
                       feedback.datahora
                FROM feedback
                JOIN consultor ON feedback.id_consultor = consultor.id';

        return DB::select($sql);
    }
}
