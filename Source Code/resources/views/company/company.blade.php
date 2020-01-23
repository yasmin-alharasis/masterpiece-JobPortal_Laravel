@extends('layouts.main')
@section('content')
<br><br><br><br><br><br>
<div class="container">
    <h2>Companies</h2>
    <div class="row">
    @foreach($companies as $company)
        <div class="col-md-3">
            <div class="card" style="width: 18rem;">
                @if(empty($company->logo))
                    <img src="{{asset('avatar/man.jpg')}}" class="card-img-top" width="100" />
                @else   
                    <img src="{{asset('uploads/logo')}}/{{$company->logo}}" class="card-img-top" width="100" />
                @endif
                <div class="card-body">
                    <h5 class="card-title text-center">{{$company->cname}}</h5>
                    
                   <center><a href="{{route('company.index',[$company->id,$company->slug])}}" class="btn btn-primary">View</a></center> 
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <br><br>
{{$companies->appends(Illuminate\Support\Facades\Input::except('page'))->links()}}
</div>
<br><br><br><br>
@endsection