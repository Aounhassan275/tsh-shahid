@extends('admin.layout.index')
@section('contents')

<div class="row mb-2 mb-xl-4">
    <div class="col-auto d-none d-sm-block">
    <h3>Add Coupon | GET 5X</h3>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Add Coupon</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('admin.coupon.store')}}" enctype="multipart/form-data" >
                   @csrf
                   <div class="row">
                        <div class="form-group col-4">
                            <label class="form-label">Coupon Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Coupon Name" required>
                        </div>   
                        <div class="form-group col-4">
                            <label class="form-label">Coupon Code</label>
                            <input type="text" name="code" class="form-control" placeholder="Enter Coupon Code" required>
                        </div>   
                        <div class="form-group col-4">
                            <label class="form-label">Coupon Percentage</label>
                            <input type="number" step="0.01" name="percentage" class="form-control" placeholder="Enter Coupon Percentage" required>
                        </div>   
                    </div>   
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="col-12 ">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">View Coupons</h5>
        </div>
        <table class="table" id="datatables-reponsive">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Coupon Code</th>
                    <th>Coupon Name</th>
                    <th>Coupon Percentage</th>
                    <th>Action</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach (App\Models\Coupon::all() as $key => $coupon)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$coupon->code}}</td>
                    <td>{{$coupon->name}}</td>
                    <td>{{$coupon->percentage}}</td>
                    <td>
                        <button data-toggle="modal" data-target="#edit_modal" name="{{$coupon->name}}" 
                                code="{{$coupon->code}}" percentage="{{$coupon->percentage}}" id="{{$coupon->id}}" class="edit-btn btn btn-primary">Edit</button>
                        </td>
                    <td>
                        <form action="{{route('admin.coupon.destroy',$coupon->id)}}" method="POST">
                            @method('DELETE')
                            @csrf
                        <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div id="edit_modal" class="modal fade">
    <div class="modal-dialog">
        <form id="updateForm" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Update Coupon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Coupon Name</label>
                        <input type="text" name="name" id="coupon_name" class="form-control" placeholder="Enter Coupon Name" required>
                    </div>   
                    <div class="form-group">
                        <label class="form-label">Coupon Code</label>
                        <input type="text" name="code" id="coupon_code" class="form-control" placeholder="Enter Coupon Code" required>
                    </div>   
                    <div class="form-group">
                        <label class="form-label">Coupon Percentage</label>
                        <input type="number" step="0.01" name="percentage" id="coupon_percentage" class="form-control" placeholder="Enter Coupon Percentage" required>
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        $('.edit-btn').click(function(){
            let name = $(this).attr('name');
            let id = $(this).attr('id');
            let code = $(this).attr('code');
            let percentage = $(this).attr('percentage');
            $('#coupon_name').val(name);
            $('#coupon_code').val(code);
            $('#coupon_percentage').val(percentage);
            $('#id').val(id);
            $('#updateForm').attr('action','{{route('admin.coupon.update','')}}' +'/'+id);
        });
    });
</script>
<script>
    $(function() {
        // Datatables Responsive
        $("#datatables-reponsive").DataTable({
            responsive: true
        });
    });
</script>
@endsection