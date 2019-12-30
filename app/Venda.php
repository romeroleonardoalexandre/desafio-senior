<?php

namespace App;

use App\Produto;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'valor_total', 'confirmado'
    ];

    public function produtos()
    {
        return $this->belongsToMany(Produto::class);
    }

}
