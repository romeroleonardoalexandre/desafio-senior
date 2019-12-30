<?php

namespace App;

use App\Venda;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['descricao', 'hash', 'preco'];

    public function vendas()
    {
        return $this->belongsToMany(Venda::Class);
    }
}
