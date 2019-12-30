<?php

namespace App\Http\Controllers\Admin;

use App\Address;
use App\Produto;
use App\Provider;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use URLify;

class ProdutoController extends AbstractController
{

    /**
     * Where to redirect users after form submited.
     *
     * @var string
     */
    protected $redirectTo = 'Produtos';

    /**
     * @var $entity
     */
    protected $entity = Produto::class;

    /**
     * @var string
     */
    protected $viewPrefix = 'admin.produtos';

    /**
     * @var string
     */
    protected $routePrefix = 'admin.produtos';

    /**
     * @var array
     */
    protected $othersParams = array();

    public function __construct()
    {
        parent::__construct();

    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index($fields = [], $filters = [], $columnDefs = '')
    {
        return parent::index(['Produto' => 'descricao', 'Codigo' => 'hash', 'Preço' => 'preco'], [], '[{"targets": [3], "searchable": false, "orderable": false}]');
    }

    public function store(Request $request, bool $returnEntity = false)
    {

        $input = $request->all();
        //verifica se ja existe cadastrado um produto com mesmo codigo
        $produto = Produto::where('hash', '=' , $input['hash'])->first();

        if(is_null($produto))
        {
            $entity = parent::store($request, true);

            return redirect()->route($this->routePrefix . '.index');
        }else{
            return  redirect()->route($this->routePrefix . '.create');
        }


    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'descricao' => 'required|string|max:255',
            'hash' => 'required|string|max:255',
            'preco' => 'required|integer|min:0',
        ]);
    }

}
