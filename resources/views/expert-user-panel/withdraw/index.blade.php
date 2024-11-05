@extends('expert-user-panel.layout.index')
@section('title')
Withdraws
@endsection
@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2><strong>Withdraw</strong> </h2>
                <ul class="header-dropdown">
                    <li class="remove">
                        <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                    </li>
                </ul>
            </div>
            <div class="body">
                <form method="GET" class="form-inline">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Start Date</label>
                            <input type="date" name="from" class="form-control" value="{{date('Y-m-d', strtotime(@$data['default_from']))}}">
                        </div>
                        <div class="form-group col-md-4">
                            <label>End Date</label>
                            <input type="date" name="to" value="{{date('Y-m-d', strtotime(@$data['default_to']))}}" class="form-control" >
                        </div>
                        <div class="form-group col-md-2">
                            <label></label>
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>Sr#</th>
                                <th>Account Name</th>
                                <th>Account Number</th>
                                <th>Amount</th>
                                <th>Method</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($withdraws as $key => $withdraw)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$withdraw->name}}</td>
                                    <td>{{$withdraw->account}}</td>
                                    <td>{{$withdraw->payment}}</td>
                                    <td>{{$withdraw->method}}</td>
                                    <td> @if($withdraw->status=="Completed")
                                        <span class="badge badge-success">{{$withdraw->status}}</span>
                                        @elseif($withdraw->status=="in process")
                                        <span class="badge badge-danger">{{$withdraw->status}}</span>
                                        @else
                                        <span class="badge badge-primary">{{$withdraw->status}}</span>
                                        @endif
                                    </td>
                                    <td >{{$withdraw->created_at->format('M d,Y h:i A')}}</td>
                                    <td>
                                        @if($withdraw->status=="Completed")
                                        @elseif($withdraw->status=="in process")
                                        @else
                                        <a href="{{route('user.withdraw.edit',$withdraw->id)}}"><button class="btn btn-primary">Edit</button></a>
                                        <form action="{{route('user.withdraw.destroy',$withdraw->id)}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                        <button class="btn btn-danger">Delete</button>
                                        </form>
                                        @endif

                                    </td>
                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection