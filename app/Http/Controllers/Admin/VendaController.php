<?php

namespace App\Http\Controllers\Admin;

use App\Produto;
use App\Venda;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class VendaController extends Controller
{

    /**
     * Where to redirect users after form submited.
     *
     * @var string
     */
    protected $redirectTo = 'vendas';

    /**
     * @var $entity
     */
    protected $entity = Venda::class;

    /**
     * @var string
     */
    protected $viewPrefix = 'admin.venda';

    /**
     * @var string
     */
    protected $routePrefix = 'admin.venda';

    /**
     * @var array
     */
    protected $othersParams = array();

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $vendas = DB::table('vendas')->where('confirmado', '=' ,'S')->sum('valor_total');
        return view($this->routePrefix . '.index', ['venda_numero' => Venda::max('id') + 1, 'total_vendas' => $this->getTotalVendas()]);
    }


    /**
     * Busca total de vendas efetivadas
     *
     * @return string
     */
    private function getTotalVendas()
    {
        return $vendas = DB::table('vendas')->where('confirmado', '=' ,'S')->sum('valor_total');
    }

    public function store(Request $request, bool $returnEntity = false)
    {

        if(isset($request['produtos']))
        {
            $total = 0;
            foreach($request['produtos'] as $prod)
            {
                $produto = Produto::find($prod);
                $total += (float) $produto->preco;

            }

            $venda = Venda::create(['valor_total'=> $total, 'confirmado'=> $request['action']]);

            foreach($request['produtos'] as $prod)
            {
                $produto = Produto::find($prod);

                $venda->produtos()->attach($produto);

            }

        }

        return view($this->routePrefix . '.index', ['venda_numero' => Venda::max('id') + 1, 'total_vendas' => $this->getTotalVendas()]);

    }

     /**
     * Ajax para buscar os produtos
     *
     * @return mixed
     */
    public function buscaProduto(Request $request)
    {

        $input = $request->all();

        $produto = Produto::where('hash', '=' , $input['produto'])->first();

        if(!is_null($produto))
        {
            return response()->json(
                [
                    'success' => true,
                    'data' => [
                        'id'        => $produto['id'],
                        'hash'      => $produto['hash'],
                        'descricao' => $produto['descricao'],
                        'preco'     => $produto['preco']
                    ]
                ]
            );

        }
        else
        {
            return response()->json(
                [
                    'success' => false
                ]
            );
        }

    }
}
