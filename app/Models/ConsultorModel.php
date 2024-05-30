<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ConsultorModel extends Model
{
    public $timestamps = false;

    protected $table = 'consultor';

    protected function casts()
    {
        return [
            'datahora' => 'datetime',
        ];
    }

    public static function get(int $id)
    {
        return DB::table('consultor')->where(['id' => $id])->get()->first();
    }

    public static function updateItem(int $id, array $data)
    {
        return DB::table('consultor')->where(['id' => $id])->update($data);
    }
}
