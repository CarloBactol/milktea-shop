@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">User ShippingFee</h1>
            </div>
            <table class="table" id="table_left">
                <thead>
                    <th>ID</th>
                    <th>Fee</th>
                    <th>Email</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($shipping as $ship)
                    <tr>
                        <td>{{ $ship->id }}</td>
                        <td>&#8369;{{ $ship->shipping }}</td>
                        <td>{{ $ship->email }}</td>
                        <td>
                            {{-- <a href="{{ url('/admin/edit-shipping-fee/'.$ship->id) }}"
                                class="btn btn-sm btn-info"><i class="fas fa-edit" aria-hidden="true"></i></a> --}}
                            <a href="{{ url('/admin/delete-shipping-fee/'.$ship->id) }}"
                                class="btn btn-sm btn-danger"><i class="fas fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <div class="col-md-12 border mb-4 py-4">
                <h5>Miles Fee </h5>
                <a id="creatMiles" class="btn btn-primary mb-3 float-right" href="javascript:void(0)">Add
                    Miles</a>
                <table class="table table-bordered table-hover table-striped" id="table_right">
                    <thead>
                        <th>ID</th>
                        <th>Miles</th>
                        <th>Price</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
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
                <form id="mile_form" class="regular_form d-flex">
                    <input id="mile_id" type="hidden" value="">
                    <input type="number" id="miles" value="" class="form-control float-left" placeholder="Enter miles"
                        required>
                    <input type="number" id="price" value="" class="form-control float-left" placeholder="Enter price"
                        required>
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
        // Table left
        var table = $('#table_left').DataTable({
            processing: true, // for show progress bar
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

        // table right
        var table = $('#table_right').DataTable({
            serverSide: true,
            processing: true, // for show progress bar
            ajax: "{{ route('mile_fees.index') }}", // 
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'miles', name: 'miles'},
                {data: 'price', name: 'price'},
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
       $('#creatMiles').click(function () { 
             $('#mile_id').val('');
            $('#modalHeading').html('Create New Miles');
            $('#ajaxModal').modal('show');
            $("#mile_form").trigger("reset"); // reset form input
       });

       $("#saveBtn").click(function (e) { 
        e.preventDefault();
        $(this).html('Save');
           var id = $('#mile_id').val();
           var miles = $('#miles').val();
           var price = $('#price').val();
          
            $.ajax({   
            data: {
                id: id,
                miles: miles,
                price: price,
            }, 
            url: "{{ route('mile_fees.store') }}",
            type: "POST",
            dataType: "json",
            success: function (data) {
                $("#mile_form").trigger("reset"); // reset form input
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
        $('body').on('click', '.deleteMile', function(){
        var mile_id = $(this).data('id'); // from data-id="" href
        confirm('Are you sure you want to delete!');
        $.ajax({
            type: "DELETE",
            data: {id: mile_id},
            url: "{{ route('mile_fees.store') }}" + '/' + mile_id,
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
        $('body').on('click', '.editMile', function(){
            var mile_id = $(this).data('id'); // from data-id="" href
            $.get("{{ route('mile_fees.index') }}" +"/" +mile_id + "/edit",
                function (data) {
                    $('#modalHeading').html('Edit Miles');
                    $('#ajaxModal').modal('show');
                    $('#mile_id').val(data.id);
                    $('#miles').val(data.miles);
                    $('#price').val(data.price);
                },
            );
       })


    });

</script>

@endpush