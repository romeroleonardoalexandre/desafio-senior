<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdutoVenda extends Model
{

    protected $table = 'produto_venda';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'venda_id', 'produto_id'
    ];

    public function vendas()
    {
        return $this->belongsTo(Venda::class);
    }

    public function produtos()
    {
        return $this->belongsTo(Produto::class);
    }

}
