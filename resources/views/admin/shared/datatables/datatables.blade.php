<table id="page-length-option" class="display" columndefs="{{ $columnDefs }}">
    <thead>
    <tr>
        <td>#</td>
        @foreach($fields as $key => $field)
            <td>{{ $key }}</td>
        @endforeach
        <td></td>
    </tr>
    </thead>
    <tbody>
    @foreach($entities as $entity)
        <?php  $entity = $entity->toArray(); ?>
    <tr>
        @foreach($entity as $field)
        <td>{{ $field }}</td>
        @endforeach

    </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td>#</td>
        @foreach($fields as $key => $field)
            <td>{{ $key }}</td>
        @endforeach
        <td></td>
    </tr>
    </tfoot>
</table>

@section('styles')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/data-tables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/data-tables/css/select.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/data-tables.css') }}">
@stop

@section('scripts')
    @parent
    <script src="{{ asset('app-assets/vendors/data-tables/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/data-tables/js/dataTables.select.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/js/scripts/data-tables.js') }}" type="text/javascript"></script>
@stop
