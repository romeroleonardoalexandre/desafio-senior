@extends('layouts.admin')

@section('content')
    <!-- BEGIN: Page Main-->
    <div id="main">
        <div class="row">
            <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
            <div class="col s12">
                <div class="container">
                    <div class="row">
                        <div class="col s12 m6">
                            <div class="card blue-grey darken-1">
                                <div class="card-content white-text">
                                <span class="card-title">Total vendido</span>
                                <h1 style="text-align:center;color:#FFFFFF;">{{ $total_vendas }}</h1>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col s12 m12 12">
                            <div class="card animate fadeLeft">
                                <div class="card-content">
                                    <h4 class="card-title mb-0">Venda {{ $venda_numero }}</h4>
                                    {!! Form::open(['route' => 'admin.vendas.store', 'class' => 'col s12', 'role' => 'form']) !!}

                                    <div class="col s12 m6">
                                        <div id="listagem" class="collection col s12 m12">

                                        </div>
                                        <div class="collection col s12 m12">
                                            <div class="collection-item" id="total"><span class="badge" id="total_span"></span>Total</div>
                                        </div>
                                    </div>
                                    <div class="col s12 m6 6">

                                        <div class="input-field col s10 m10 8">
                                            <input placeholder="Código produto" id="produto" type="text">
                                            <label for="produto">Produto</label>
                                        </div>
                                        {{ csrf_field() }}
                                        <div class="input-field col s2 m2 4">
                                            <a id="busca" class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">search</i></a>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <button class="btn red waves-effect waves-light left" type="submit" name="action" value="N" >{{ __('Cancelar') }}
                                                    <i class="material-icons right">cancel</i>
                                                </button>
                                                <button class="btn cyan waves-effect waves-light right" type="submit" name="action" value="S" >{{ __('Confirmar') }}
                                                    <i class="material-icons right">check_circle</i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    {!! Form::close()  !!}
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m8 l8 animate fadeRight">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Page Main-->


@endsection

@section('scripts')
    <script>

        (function (window, document, $) {

            $('#busca').click(()=>{
                $.ajax({
                    type:'POST',
                    url: "{{ route('ajax.busca') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{
                        produto: $('#produto').val()
                    },
                    success:function(response){

                        if(response.success)
                        {

                            $('#listagem').append('<div class="collection-item itens" data-preco="'+response.data.preco+'"><span class="badge">R$ '+response.data.preco+'</span>'+response.data.descricao+'</div><input type="hidden" name="produtos[]" value="'+response.data.id+'">')
                            let total = 0;
                            $( '.itens' ).each(function( ) {
                                total = (parseFloat(total) + parseFloat($( this ).data('preco')) );
                            });
                            $('#total_span').html('R$ ' + total)
                        }
                        else
                        {
                            alert('Produto não encontrado!!');
                        }
                    }

                });

            })

        })(window, document, jQuery);
    </script>
@endsection

