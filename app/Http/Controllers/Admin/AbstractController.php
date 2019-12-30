<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Toastr;

abstract class AbstractController extends Controller
{

    /**
     * Where to redirect users after form submited.
     *
     * @var string
     */
    protected $redirectTo = '/adm';

    /**
     * @var $entity
     */
    protected $entity = null;

    /**
     * @var $entity
     */
    protected $event = null;

    /**
     * @var string
     */
    protected $viewPrefix = '';

    /**
     * @var string
     */
    protected $routePrefix = '';

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
     * Display a listing of the resource.
     * @return Response
     */
    public function index($fields = [], $filters = [], $columnDefs = '')
    {
        $withs = [];
        $table = new $this->entity();
        $table = $table->getTable();
        $viewFields = $fields;
        if(!empty($fields)){
            foreach ($fields as $fieldKey => $field){
                if(is_array($field)){
                    $relation = explode('.', $field[0]);
                    if(count($relation) > 1){
                        array_push($withs, [$relation[0],$relation[1], $field[1]]);
                        unset($fields[$fieldKey]);
                    }
                } else {
                    $fields[$fieldKey] = $table . '.' . $field;
                }
            }
        }
        $entities = $this->entity::select((!empty($fields) ? array_merge([$table . '.id'], $fields) : '*'));

        if(!empty($filters)){
            foreach ($filters as $filter){
                $entities->where($filter[0], $filter[1], $filter[2]);
            }
        }

        foreach ($withs as $with){
            $entities->join($with[0], $with[0] . '.id', '=', $table . '.' . $with[2]);
            $entities->addSelect($with[0] . '.' . $with[1] .  ' as ' . $with[0].ucfirst($with[1]));
        }
        $entities = $entities->get();
        return view($this->viewPrefix . '.index', ['fields' => $viewFields, 'entities' => $entities, 'columnDefs'=> $columnDefs, 'otherParams' => $this->otherParams()]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return (String) view( $this->viewPrefix . '.create', array('otherParams' => $this->otherParams()));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request, bool $returnEntity = false)
    {
        $this->validator($request->all())->validate();

        if(!is_null($this->event)){
            event(new $this->event($entity = $this->entity::create($request->all())));
        }else{
            $entity = $this->entity::create($request->all());
        }

        if (request()->hasFile('file'))
        {
            foreach (request()->file('file') as $file){
                $entity->addMedia($file)->toMediaCollection($this->redirectTo);
            }
        }

        Toastr::success('Cadastro efetuado com sucesso!', 'Title', ["positionClass" => "toast-top-center"]);
        if(!$returnEntity){
            $query = array();
            if(isset($request['module']) || isset($request['resource']))
                $query = ['module' => $request['module'], 'resource' => $request['resource']];
            if(isset($request['reopen']))
                $query = ['reopen' => sha1($entity->id)];
            return redirect()->route($this->routePrefix . '.index', $query);
        }else
            return $entity;
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(string $id)
    {
        $entity = $this->entity::where(DB::raw('sha1(id)'), '=', $id)->first();
        if(!$entity){
            $query = array();
            if(isset($request['module']) || isset($request['resource']))
                $query = ['module' => $request['module'], 'resource' => $request['resource']];

            Toastr::error(__('Registro não encontrato'))->push();
            return redirect()->route($this->routePrefix . '.index', $query);
        }
        return view($this->viewPrefix . '.create', array('entity' => $entity, 'otherParams' => $this->otherParams()));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, string $id,  bool $returnEntity = false)
    {
        $this->validator(array_merge($request->all(), array('id' => $id)))->validate();

        $entity = $this->entity::where(DB::raw('sha1(id)'), '=', $id)->first();

        $entity->fill($request->all());

        $entity->save();

        if (request()->hasFile('file'))
        {
            foreach (request()->file('file') as $file){
                $entity->addMedia($file)->toMediaCollection($this->redirectTo);
            }
        }
        if(!$returnEntity){
            $query = array();
            if(isset($request['module']) || isset($request['resource']))
                $query = ['module' => $request['module'], 'resource' => $request['resource']];
            if(isset($request['reopen']))
                $query = ['reopen' => sha1($entity->id)];

            Toastr::success('Registro alterado com sucesso!')->push();
            return redirect()->route($this->routePrefix . '.index', $query);

        }else
            return $entity;
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request, string $id)
    {
        $entity = $this->entity::where(DB::raw('sha1(id)'), '=', $id)->first();

        if($this->event)
            event(new $this->event($entity, 'destroy'));
        $entity->delete();
        echo 'ok';
    }

    /**
     * Return a params array for send to view
     * @param Array $otherParams
     * @return Array
     */
    public function otherParams($otherParams = array())
    {
        return array_merge(
            array(
                'entity' => $this->entity,
                'viewPrefix' => $this->viewPrefix,
                'routePrefix' => $this->routePrefix,
                'permissionPrefix' => str_replace('.', '-', $this->routePrefix)
            ),
            $otherParams,
            $this->othersParams
        );
    }

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }

    /**
     * Remove os acentos e caracteres especiais
     * @param $str
     * @return string
     */
    public function removeAcentos($str){
        $regexp = '/&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml|caron);/i';
        $str = html_entity_decode(preg_replace($regexp, '$1', htmlentities($str)));
        $str = str_replace(' ', '-', trim($str));
        $str = str_replace('/', '-', trim($str));
        return strtolower($str);
    }
}
