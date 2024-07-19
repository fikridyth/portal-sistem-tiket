<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.umd.min.js"></script>
{{-- Swal --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- Jquery --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
{{-- DataTable --}}
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

{{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> --}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

{{-- Validation --}}
<script>
    $(document).ready(function() {
        $('#tab-register').change(function() {
            $('#registerEmail, #registerPassword').val('');
        });
    });

    $(document).ready(function() {
        @if ($errors->any())
            var status = `01`;
            var message = ``;
            @foreach ($errors->all() as $error)
                message += `{{ $error }}<br/>`;
            @endforeach
            show_alert_dialog(status, message);
        @endif
    });

    function show_alert_dialog(status, message) {
        if (status == "00")
            Swal.fire({
                title: "Success",
                html: message,
                icon: "success",
            });
        else
            Swal.fire({
                title: "Process Failed",
                html: message,
                icon: "warning",
            });
    }
</script>

{{-- Redirect Swal --}}
@if (session('alert'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('alert')['message'] }}',
            showConfirmButton: true,
        });
    </script>
@endif

{{-- Delete Swal --}}
<script>
    function deleteData(row_id) {
        const formId = 'delete-form-' + row_id;

        Swal.fire({
            title: 'Notification',
            text: "Delete Data?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form directly
                document.getElementById(formId).submit();
            }
        });
    }
</script>
