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
    public static function getFeedbacks(
        ?string $inicio = null,
        ?string $fim = null,
        ?int    $id_consultor = null,
    ): array
    {
        $values = [];
        $sql = 'SELECT feedback.id, 
                       feedback.descricao,
                       feedback.estrategia,
                       feedback.observacoes,
                       consultor.nome,
                       feedback.datahora
                FROM feedback
                JOIN consultor ON feedback.id_consultor = consultor.id';

        if ($inicio !== null && $fim !== null) {
            $sql .= ' WHERE date_format(feedback.datahora, "%Y-%m-%d") between ? and ?';
            $values = [$inicio, $fim];
        }

        if ($id_consultor !== null) {
            $sql .= ' AND feedback.id_consultor = ?';
            $values[] = $id_consultor;
        }

        $sql .= ' ORDER BY feedback.datahora DESC';
        return DB::select($sql, $values);
    }

    /**
     * @param int $id
     * @return array{
     *  id: int,
     *  descricao: string,
     *  estrategia: string,
     *  observacoes: string|null,
     *  nome: string,
     *  datahora: string,
     * }
     */
    public static function getById(int $id): array
    {
        $sql = 'SELECT feedback.id, 
                       feedback.descricao,
                       feedback.estrategia,
                       feedback.observacoes,
                       consultor.nome,
                       consultor.id as id_consultor,
                       feedback.datahora
                FROM feedback
                JOIN consultor ON feedback.id_consultor = consultor.id
                WHERE feedback.id = ?';

        return DB::select($sql, [$id]);
    }

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
    public static function getRecentes(): array
    {
        $sql = 'SELECT feedback.id, 
                       feedback.descricao,
                       feedback.estrategia,
                       feedback.observacoes,
                       consultor.nome,
                       feedback.datahora
                FROM feedback
                JOIN consultor ON feedback.id_consultor = consultor.id
                ORDER by feedback.id DESC
                LIMIT 3';

        return DB::select($sql);
    }
}
