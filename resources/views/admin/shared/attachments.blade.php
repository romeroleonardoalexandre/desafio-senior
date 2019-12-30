<div class="row {{ isset($hidden) && !$hidden ? : 'hide' }}" id="anexos">
    <div class="col l12">
        <h3>Anexos</h3>
        <div class="row">
            @if(isset($entity))
                <?php
                $medias = $entity->getMedia($collection);
                if(count($medias)){
                ?>

                @foreach($medias as $media)
                    <?php
                        $ext = explode('.', $media->file_name);
                        $ext = end($ext);
                        $ico = 'fa-file-o';
                        switch ($ext){
                            case  'txt' :
                                $ico = 'fa-file-text-o';
                                break;

                            case  'pdf' :
                                $ico = 'fa-file-pdf-o';
                                break;

                            case  'doc' :
                            case  'docx'  :
                                $ico = 'fa-file-word-o';
                                break;

                            case  'mp3' :
                            case  'wav' :
                            case  'ogg' :
                            case  'wma' :
                                $ico = 'fa-file-sound-o';
                                break;

                            case  'xls' :
                            case  'csv' :
                            case  'xlsx'  :
                                $ico = 'fa-file-excel-o';
                                break;

                            case  'ppt' :
                            case  'pptx':
                                $ico = 'fa-file-powerpoint-o';
                                break;

                            case  'jpg' :
                            case  'jpeg':
                            case  'png' :
                            case  'pneg':
                            case  'gif' :
                                $ico = 'image';
                                break;

                            case  'zip' :
                            case  'rar' :
                            case  'gzip':
                            case  'tar' :
                                $ico = 'fa-file-zip-o';
                                break;

                            case  'mp4' :
                            case  'mov' :
                            case  'wmv' :
                            case  'avi' :
                            case  '3gp' :
                            case  'mkv' :
                                $ico = 'fa-file-zip-o';
                                break;

                            case  'sql' :
                                $ico = 'fa-database';
                                break;

                        }
                    ?>
                    <div  class="col s12 m3"  id="attachment-{{ sha1($media->id) }}">
                        <div class="popup-gallery">
                            <a href="{{ asset($media->getUrl()) }}">
                                <div class="card gradient-shadow gradient-45deg-light-blue-cyan border-radius-3 animate fadeUp">
                                    <div class="card-content center">
                                        <i class="material-icons white-text">{{ $ico }}</i>
                                        <h5 class="white-text lighten-4">{{ $ext }}</h5>
                                        <p class="white-text lighten-4">{{$media->file_name}}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <a href="#" onclick="Scripts.confirm('{{ route('removemedia', ['id' => sha1($media->id)]) }}', ['{{ __('que deseja excluir esse anexo?') }}', '{{ __('Excluído') }}', '{{ __('Anexo excluido com sucesso!') }}'], 'DELETE', function(){$('#attachment-{{ sha1($media->id) }}').hide()})"><i class="material-icons">delete_forever</i> <small>Remover</small></a>
                    </div>
                        {{----}}
                        {{--<div class="hpanel">--}}
                            {{--<div class="panel-body file-body">--}}
                                {{--<i class="material-icons right">{{ $ico }}</i> {{ $ext }}--}}
                            {{--</div>--}}
                            {{--<div class="panel-footer">--}}
                                {{--<a href="{{ asset($media->getUrl()) }}" target="_blank">{{$media->file_name}}</a>--}}
                                {{--<a href="#" onclick="Scripts.confirm('{{ route('removemedia', ['id' => sha1($media->id)]) }}', ['{{ __('que deseja excluir esse anexo?') }}', '{{ __('Excluído') }}', '{{ __('Anexo excluido com sucesso!') }}'], 'DELETE', function(){$('#attachment-{{ sha1($media->id) }}').hide()})"><i class="fa fa-trash-o"></i> </a>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                @endforeach
                <?php
                }else{
                ?>
                <p class="text-center">Nenhum arquivo encontrado!</p>
                <?php
                }
                ?>
            @endif

        </div>
        <div class="row">
            <div class="col l6">
                <div class="input-field col s12 hide" id="file">
                    {{ Form::file('file[]', ['class' => 'form-control',  'accept' => isset($acceptTypes) ? $acceptTypes : null]) }}
                </div>
                <div id="cloneArea"></div>
                <br>
                <button type="button" class="btn btn-info btn-sm copybutton" data-target="#file" data-to="#cloneArea"><i class="fa fa-plus"></i> {{ __('Adicionar anexo') }}</button>
            </div>
        </div>
    </div>
</div>
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