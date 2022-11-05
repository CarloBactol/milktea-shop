@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        {{--Addons List Side --}}
        <div class="col-md-7 border mb-4 py-4">
            <h5>Regular Addons</h5>
            <a id="createNewAddons" class="btn btn-primary mb-3 float-right" href="javascript:void(0)">Add
                New</a>
            <table class="table table-bordered table-hover table-striped" id="tableID">
                <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Action</th>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="ajaxModal" aria-hidden="true" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHeading"></h5>
            </div>
            <div class="modal-body">
                <form id="regular_form" class="regular_form d-flex">
                    <input id="addons_id" type="hidden" value="">
                    <input type="text" id="name" value="" class="form-control float-left" placeholder="Enter name">
                    <button type="submit" class="btn btn-primary float-right" id="saveBtn" value="create">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script src="{{ asset('admin/js/datatable-jquery.js') }}"></script>
<script type="text/JavaScript">


    $(function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        var table = $('#tableID').DataTable({
            serverSide: true,
            processing: true, // for show progress bar
            ajax: "{{ route('regulars.index') }}", // 
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'action', name: 'action'},
            ],
            filter: true, // this is for disable filter (search box)
            orderMulti: false, // for disable multiple column at once
            paging: true,
            // scrollY: 250,
            keys: true,
            scroller: {
                loadingIndicator: true
            },
            
            searching: true // enable search bar
        });

        /*
        * CREATE NEW 
        */
       $('#createNewAddons').click(function () { 
             $('#addons_id').val('');
            $('#modalHeading').html('Create New Regular Addons');
            $('#ajaxModal').modal('show');
            $("#regular_form").trigger("reset"); // reset form input
       });

       $("#saveBtn").click(function (e) { 
        e.preventDefault();
        $(this).html('Save');
           var id = $('#addons_id').val();
           var name = $('#name').val();
            $.ajax({   
            data: {
                id: id,
                name: name,
            }, 
            url: "{{ route('regulars.store') }}",
            type: "POST",
            dataType: "json",
            success: function (data) {
                $("#regular_form").trigger("reset"); // reset form input
                $('#ajaxModal').modal('hide');
                table.draw(); // reload table from dataTables
                toastr.success("Successfully");
            },
            error:function (data){
                console.log('Error',data);
                $('#saveBtn').html('Save');
            }
        });

       });

        /*
        * DELETE 
        */
       $('body').on('click', '.deleteAddons', function(){
        var addons_id = $(this).data('id'); // from data-id="" href
        confirm('Are you sure you want to delete!');
        $.ajax({
            type: "DELETE",
            data: {id: addons_id},
            url: "{{ route('regulars.store') }}" + '/' + addons_id,
            dataType: "json",
            success: function (response) {
                table.draw(); // reload table from dataTables
                toastr.warning("Deleted successfully");
            },
            error:function (data){
                console.log('Error',data);
            },
        });
       })

        /*
        * UPDATE 
        */
        $('body').on('click', '.editAddons', function(){
            var addons_id = $(this).data('id'); // from data-id="" href
            $.get("{{ route('regulars.index') }}" +"/" +addons_id + "/edit",
                function (data) {
                    $('#modalHeading').html('Edit Regular Addons');
                    $('#ajaxModal').modal('show');
                    $('#addons_id').val(data.id);
                    $('#name').val(data.name);
                },
            );
       })
    });

</script>

@endpush