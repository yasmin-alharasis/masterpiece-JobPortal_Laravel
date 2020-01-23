@extends('layouts.app')

@section('content')
<div class="container">
        <div class="col-md-12">
           <div class="company-profile">
                @if(empty($company->cover_photo))
                <img src="{{asset('Cover-Photo-Background.png')}}" style="width:100%">
                @else
                <img src="{{asset('uploads/coverphoto/')}}/{{$company->cover_photo}}" style="width:100%">
                @endif
                <div class="company-desc">

                @if(empty($company->logo))
                    <img src="{{asset('avatar/man.jpg')}}" width="100" />
                @else   
                    <img src="{{asset('uploads/logo')}}/{{$company->logo}}" width="100" />
                 @endif

                    <h1>{{$company->cname}}</h1>
                    <h3>{{$company->slogan}}</h3>
                    <p>
                    <strong>Address</strong>-{{$company->address}}&nbsp;
                    <strong>Phone</strong>-{{$company->phone}}&nbsp;
                    <strong>Website</strong>-{{$company->website}}&nbsp;
                    </p>
                    <p>{{$company->description}}</p>
                </div>
                <div class="table">
                <table>
                    <thead>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </thead>
                    <tbody>
                    @foreach($company->jobs as $job)
                    <tr>
                        <td><img src="{{asset('avatar/man.jpg')}}" width="80"/></td>
                        <td>Position:{{$job->position}}<br><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;{{$job->type}}</td>
                        <td><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;Address:{{$job->address}}</td>
                        <td><i class="fa fa-globe" aria-hidden="true"></i>&nbsp;Date:{{$job->created_at->diffForHumans()}}</td>
                        <td><a href="{{route('jobs.show',[$job->id,$job->slug])}}">
                        <button class="btn btn-success btn-sm">
                        Apply
                        </button></a></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
           </div>
        </div>   
</div>
@endsection
<style>
.fa{
    color: #4183D7;
}
</style>
