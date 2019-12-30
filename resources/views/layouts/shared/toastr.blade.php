@if(Session::has('toastr.alerts'))
    <script>
        @foreach(Session::get('toastr.alerts') as $alert)
        alert($alert);
        M.toast({html: '{{ $alert['message'] }}', classes: 'rounded'});
        //toastr.{{ $alert['type'] }}('{{ $alert['message'] }}' @if( ! empty($alert['title'])), '{{ $alert['title'] }}' @endif);
        @endforeach
    </script>
@endif
{!! Toastr::message() !!}

