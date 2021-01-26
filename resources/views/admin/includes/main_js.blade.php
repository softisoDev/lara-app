<!-- BEGIN URL JS-->
<script type="text/javascript">
    const app = {
        host: {!! json_encode(url('/')) !!}+"",
    }
    window.CSRF_TOKEN = '{{ csrf_token() }}';
</script>
<!-- END URL JS-->

<script src="{{asset('admin-assets/js/font-awesome.js')}}"></script>
<script src="{{asset('admin-assets/js/custom.js')}}"></script>
<script src="{{asset('admin-assets/js/jquery-3.5.1.min.js')}}"></script>
<script src="{{asset('admin-assets/js/popper.min.js')}}"></script>
<script src="{{asset('admin-assets/js/bootstrap.min.js')}}"></script>
