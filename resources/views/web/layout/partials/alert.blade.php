@if (Session::has('errors'))
    @foreach (Session::get('errors')->all() as $error)
        <script>toastr.error('{{$error}}'); </script>
    @endforeach
@endif

@if (Session::has('warning'))
 <script>toastr.warning('{{Session::get('warning')}}'); </script>
@endif

@if (Session::has('info'))
 <script>toastr.info('{{Session::get('info')}}'); </script>
@endif


@if (Session::has('success'))

 <script>toastr.success('{{Session::get('success')}}'); </script>

@endif
