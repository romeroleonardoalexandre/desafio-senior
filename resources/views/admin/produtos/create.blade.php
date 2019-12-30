@extends('layouts.admin')

@section('content')

    <!-- BEGIN: Page Main-->
    <div id="main">
        <div class="row">
            <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
            <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
                <!-- Search for small screen-->
                <div class="container">
                    <div class="row">
                        <div class="col s10 m6 l6">
                            <h5 class="breadcrumbs-title mt-0 mb-0">Produtos</h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a>
                                <li class="breadcrumb-item"><a href="{{ route($otherParams['routePrefix'] . '.index') }}">Lista</a>
                                </li>
                                <li class="breadcrumb-item active">{{ isset($entity) ? 'Alterar' : 'Adicionar' }} produto
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12">
                <div class="container">
                    <div class="seaction">

                        <div class="card">
                            <div class="card-content">
                                <p class="caption mb-0">Edição de produtos</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- jQuery Plugin Initialization -->
            <div class="row">
                <div class="col l12">
                    <div id="basic-form" class="card card card-default scrollspy">
                        <div class="card-content">
                            @if(isset($entity) && !is_null($entity))
                                {!! Form::model($entity, ['url' => route($otherParams['routePrefix'] . '.update', ['id' => sha1($entity->id)]), 'class' => 'col s12', 'role' => 'form', 'files' => true]) !!}
                                {{ Form::hidden('_method', 'PUT') }}
                            @else
                                {!! Form::open(['route' => $otherParams['routePrefix'] . '.store', 'class' => 'col s12', 'role' => 'form', 'files' => true]) !!}
                            @endif
                            {{ csrf_field() }}

                            <div class="row">
                                <div class="input-field col s12">
                                    {{ Form::text('hash', null , ['class' => 'hash']) }}
                                    {{ Form::label('hash', __('Identificador'), []) }}
                                    @if ($errors->has('hash') || $errors->has('hash'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('hash') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    {{ Form::text('descricao', null, ['class' => 'descricao']) }}
                                    {{ Form::label('title', __('Descrição'), []) }}
                                    @if ($errors->has('descricao') || $errors->has('descricao'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('descricao') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    {{ Form::text('preco', null, ['class' => 'preco']) }}
                                    {{ Form::label('preco', __('Preço'), []) }}
                                    @if ($errors->has('preco') || $errors->has('preco'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('preco') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="row">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <button class="btn cyan waves-effect waves-light right" type="submit" name="action">{{ __('Enviar') }}
                                            <i class="material-icons right">send</i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close()  !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('styles')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/magnific-popup/magnific-popup.css') }}">
@stop
@section('scripts')
    @parent

    <script src="{{ asset('app-assets/vendors/magnific-popup/jquery.magnific-popup.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/imagesloaded.pkgd.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('app-assets/js/scripts/media-gallery-page.js') }}"></script>
@stop
