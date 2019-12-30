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
                            <h5 class="breadcrumbs-title mt-0 mb-0">Usuários</h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a>
                                <li class="breadcrumb-item"><a href="{{ route($otherParams['routePrefix'] . '.index') }}">Lista</a>
                                </li>
                                <li class="breadcrumb-item active">{{ isset($entity) ? 'Alterar' : 'Adicionar' }} usuário
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
                                <p class="caption mb-0">Edição de usuários</p>
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
                                    {{ Form::text('name', null, []) }}
                                    {{ Form::label('name', __('Nome'), []) }}
                                    @if ($errors->has('name') || $errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    {{ Form::text('email', null, []) }}
                                    {{ Form::label('email', __('E-mail'), []) }}
                                    @if ($errors->has('email') || $errors->has('email'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    {{ Form::password('password', []) }}
                                    {{ Form::label('password', __('Senha'), ['autocomplete' => 'new-password']) }}
                                    @if ($errors->has('password') || $errors->has('password'))
                                        <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    {{ Form::password('password_confirmation', []) }}
                                    {{ Form::label('password_confirmation', __('Repita a senha'), ['autocomplete' => 'new-password']) }}
                                    @if ($errors->has('password_confirmation') || $errors->has('password_confirmation'))
                                        <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
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