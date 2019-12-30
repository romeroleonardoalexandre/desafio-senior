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
                            <h5 class="breadcrumbs-title mt-0 mb-0">{{ __('Produtos') }}</h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a>
                                </li>
                                <li class="breadcrumb-item active">{{ __('Lista de produtos') }}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12">
                <div class="container">
                    <div class="section section-data-tables">

                        <div class="card">
                            <div class="card-content">
                                <p class="caption mb-0">{{ __('Manutenção de produtos') }}</p>
                            </div>
                        </div>

                        <!-- Page Length Options -->
                        <div class="row">
                            <div class="col s12">
                                <div class="card">
                                    <div class="card-content">
                                        <h4 class="card-title"></h4>
                                        <a href="{{ route( $otherParams['routePrefix'] . '.create') }}" class="waves-effect waves-light btn mb-1">Novo</a>
                                        <div class="row">
                                            <div class="col s12">
                                                @include('admin.shared.datatables.datatables',[
                                                    'entities' => $entities,
                                                    'columnDefs' => $columnDefs,
                                                    'otherParams' => $otherParams
                                                ])
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
