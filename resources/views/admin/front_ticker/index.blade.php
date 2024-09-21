@extends('admin.layout.index')
@section('contents')

<div class="row mb-2 mb-xl-4">
    <div class="col-auto d-none d-sm-block">
    <h3>Add Frontend Ticker | {{App\Models\Setting::siteName()}}</h3>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Add Frontend Ticker</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('admin.front_ticker.store')}}" >
                   @csrf
                   <div class="row">
                       
                        <div class="form-group col-6">
                            <label class="form-label">Ticker Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="form-group col-12">
                            <label class="form-label">Ticker Message</label>
                            <textarea name="message" id="" cols="100" rows="2" class="form-control"></textarea>
                        </div>
                   </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="col-12 ">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">View Frontend Ticker Messages</h5>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th style="width:auto;">Ticker Title</th>
                    <th style="width:auto;">Ticker Message</th>
                    <th style="width:auto;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach (App\Models\FrontTicker::all() as $key => $ticker)
                <tr> 
                    <td>{{$ticker->title}}</td>
                    <td>{{$ticker->message}}</td>
                    <td class="table-action">
                        <form action="{{route('admin.front_ticker.destroy',$ticker->id)}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn"><i class="align-middle" data-feather="trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection