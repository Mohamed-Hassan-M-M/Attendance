<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/dist/js/adminlte.js')}}"></script>
<!-- Datatable -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

<!-- custom js -->
<script>
    $(document).ready( function () {
        $('#table_id').DataTable({
            @if(app()->getLocale() == 'ar')
            "language": {
                "emptyTable": "لا يوجد بيانات",
                "info": "عرض صفحة _PAGE_ من _PAGES_",
                "infoEmpty": "لا يوجد بيانات لعرضها",
                "search": "بحث: ",
                "paginate": {
                    "next":       "التالي",
                    "previous":   "السابق"
                },
                "infoFiltered":   "(تمت التصفية من _MAX_ اجماي البيانات)",
                "zeroRecords":    "لم يتم العثور على بيانات مطابقة",
                "lengthMenu":     "عرض _MENU_ صفوف",
            }
            @endif
        });

        $(".confirm-del").click(function(){
            if (!confirm("Do you want to delete?")){
                return false;
            }
        });
    });
    function checkLang(strtmp){
        switch (strtmp) {
            case 'day off':
                @if(app()->getLocale() == 'ar') return 'أجازة'; @else return 'day off'; @endif
            case 'absent':
                @if(app()->getLocale() == 'ar') return 'غياب'; @else return 'absent'; @endif
            default:
                return strtmp;
        }
    }
</script>
<!-- Bootstrap RTL -->
@if(LaravelLocalization::getCurrentLocaleName() == 'Arabic')
    <script
        src="https://cdn.rtlcss.com/bootstrap/v4.5.3/js/bootstrap.min.js"
        integrity="sha384-VmD+lKnI0Y4FPvr6hvZRw6xvdt/QZoNHQ4h5k0RL30aGkR9ylHU56BzrE2UoohWK"
        crossorigin="anonymous"></script>
@endif

@yield('script')
