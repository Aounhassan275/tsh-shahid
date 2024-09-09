@extends('admin.layout.index')
@section('contents')

<div class="row mb-2 mb-xl-4">
    <div class="col-auto d-none d-sm-block">
    <h3>Add In-Stock Level | {{App\Models\Setting::siteName()}}</h3>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Add In-Stock Level</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('admin.in_stock_level.store')}}" enctype="multipart/form-data" >
                   @csrf
                   <div class="row">
                        <div class="form-group col-6">
                            <label class="form-label">In-Stock Level Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Enter In-Stock Level Title" required>
                        </div>
                        <div class="form-group col-6">
                            <label class="form-label">In-Stock Level Amount</label>
                            <input type="number" step="0.01" name="amount" class="form-control" placeholder="Enter In-Stock Level Amount" required>
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
            <h5 class="card-title">View In-Stock Levels</h5>
        </div>
        <table class="table" id="datatables-reponsive">
            <thead>
                <tr>
                    <th>#</th>
                    <th>In-Stock Level Title</th>
                    <th>In-Stock Level Amount</th>
                    <th>Action</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach (App\Models\InStockLevel::all() as $key => $in_stock_level)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$in_stock_level->title}}</td>
                    <td>{{$in_stock_level->amount}}</td>
                    <td>
                        <button data-toggle="modal" data-target="#edit_modal" 
                            title="{{$in_stock_level->title}}" 
                            amount="{{$in_stock_level->amount}}"  id="{{$in_stock_level->id}}" class="edit-btn btn btn-primary">Edit</button>
                        </td>
                    <td>
                        <form action="{{route('admin.in_stock_level.destroy',$in_stock_level->id)}}" method="POST">
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
                    <h5 class="modal-title mt-0" id="myModalLabel">Update In-Stock Level</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">In-Stock Level Title</label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Enter In-Stock Level Title" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">In-Stock Level Amount</label>
                        <input type="number" step="0.01" name="amount" id="amount" class="form-control" placeholder="Enter In-Stock Level Amount" required>
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
            let amount = $(this).attr('amount');
            let title = $(this).attr('title');
            let id = $(this).attr('id');
            $('#title').val(title);
            $('#amount').val(amount);
            $('#id').val(id);
            $('#updateForm').attr('action','{{route('admin.in_stock_level.update','')}}' +'/'+id);
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