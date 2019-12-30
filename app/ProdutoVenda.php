<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendaProduto extends Model
{

    public $primaryKey = 'id';

    protected $table = 'venda_produto';

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
