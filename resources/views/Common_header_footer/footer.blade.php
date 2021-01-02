



<script src="{{asset('Admin_asset/dist-assets/js/plugins/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('Admin_asset/dist-assets/js/plugins/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('Admin_asset/dist-assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('Admin_asset/dist-assets/js/scripts/script.min.js')}}"></script>
<script src="{{asset('Admin_asset/dist-assets/js/scripts/sidebar.large.script.min.js')}}"></script>
<script src="{{asset('Admin_asset/dist-assets/js/scripts/sidebar.script.min.js')}}"></script>
<script src="{{asset('Admin_asset/dist-assets/js/plugins/echarts.min.js')}}"></script>
<script src="{{asset('Admin_asset/dist-assets/js/scripts/echart.options.min.js')}}"></script>
<script src="{{asset('Admin_asset/dist-assets/js/scripts/dashboard.v1.script.min.js')}}"></script>
<script src="{{asset('Admin_asset/dist-assets/js/scripts/customizer.script.min.js')}}"></script>
<script src="{{asset('Admin_asset/image_upload/js/image-uploader.min.js')}}"></script>
<link href="{{asset('css/select2.min.css')}}" rel="stylesheet" />
<script src="{{asset('js/select2.min.js')}}"></script>

<script src="{{asset('Admin_asset/dist-assets/js/plugins/datatables.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="{{asset('Admin_asset/letesttoastr.min.js')}}"></script>
<link href="{{asset('Admin_asset/letesttoastr.css')}}" rel="stylesheet" />
<script type="text/javascript" src="{{ asset('Admin_asset/toastr.min.js') }}"></script>


@yield('pagescript');


<script>
    @if(Session::has('messege'))
    var type="{{Session::get('alert-type','info')}}"
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('messege') }}");
            break;
        case 'success':
            toastr.success("{{ Session::get('messege') }}");
            break;
        case 'warning':
            toastr.warning("{{ Session::get('messege') }}");
            break;
        case 'error':
            toastr.error("{{ Session::get('messege') }}");
            break;
    }
    @endif
</script>

<script>
    $(document).on("click", "#delete", function(e){
        e.preventDefault();
        var link = $(this).attr("href");
        swal({
            title: "Are you Want to delete?",
            text: "Once Delete, This will be Permanently Delete!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = link;
                } else {
                    swal("Safe Data !");
                }
            });
    });
</script>

</body>

<script>
    $('#ul-contact-list').DataTable();
</script>

<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>

{{--<script type="text/javascript">--}}
{{--    $(document).ready(function () {--}}
{{--        $('.data-table').DataTable();--}}
{{--    });--}}
{{--</script>--}}

{{--<script>--}}
{{--    $('#datepicker').datepicker({--}}
{{--        uiLibrary: 'bootstrap4',--}}
{{--        format:'dd-mm-yyyy'--}}
{{--    });--}}
{{--</script>--}}



{{--<script>--}}
{{--    $('.select2').select2();--}}
{{--</script>--}}

</html>
