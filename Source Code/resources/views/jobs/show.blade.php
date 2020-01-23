@extends('layouts.main')
@section('content')
   <div class="album text-muted">
     <div class="container">
     <br><br><br><br><br><br>
     

       <div class="row">
          <div class="title" style="margin-top: 20px;">
                <h2>{{$job->title}}</h2> 

          </div>

      <img src="{{asset('hero-job-image.jpg')}}" style="width: 100%;">

          <div class="col-lg-8">
            
            
            <div class="p-4 mb-8 bg-white">
              <!-- icon-book mr-3-->
              <h3 class="h5 text-black mb-3"><i class="fa fa-book" style="color: blue;">&nbsp;</i>Description <a href="#"data-toggle="modal" data-target="#exampleModal1"><i class="fa fa-envelope-square" style="font-size: 34px;float:right;color:green;"></i></a></h3>
              <p> {{$job->description}}.</p>
              
            </div>
            <div class="p-4 mb-8 bg-white">
              <!--icon-align-left mr-3-->
              <h3 class="h5 text-black mb-3"><i class="fa fa-user" style="color: blue;">&nbsp;</i>Roles and Responsibilities</h3>
              <p>{{$job->roles}} .</p>
              
            </div>
            
            <div class="p-4 mb-8 bg-white">
              <h3 class="h5 text-black mb-3"><i class="fa fa-clock-o" style="color: blue;">&nbsp;</i>Experience</h3>
              <p>{{$job->experience}}&nbsp;years</p>
              
            </div>
           
            <div class="p-4 mb-8 bg-white">
              <h3 class="h5 text-black mb-3"><i class="fa fa-dollar" style="color: blue;">&nbsp;</i>Salary</h3>
              <p>{{$job->salary}}</p>
            </div>

          </div>

          
            <div class="col-md-4 p-4 site-section bg-light">
              <h3 class="h5 text-black mb-3 text-center">Short Info</h3>
                    <p>Company name:{{$job->company->cname}}</p>
                    <p>Address:{{$job->address}}</p>
                    <p>Employment Type:{{$job->type}}</p>
                    <p>Position:{{$job->position}}</p>
                    <p>Posted:{{$job->created_at->diffForHumans()}}</p>
                    <p>Last date to apply:{{ date('F d, Y', strtotime($job->last_date)) }}</p>



              <p><a href="{{route('company.index',[$job->company->id,$job->company->slug])}}" class="btn btn-warning" style="width: 100%;">Visit Company Page</a></p>
            
              <p>
                @if(Auth::check()&&Auth::user()->user_type=='seeker')
                
                <form action="{{route('apply',[$job->id])}}" method="POST">
                @csrf
                    @if(Session::has('message'))
                      <div class="alert alert-success">
                       {{Session::get('message')}}
                      </div>
                     @endif
                @if(!$job->checkApplication())
                <button type="submit" class="btn btn-success" style="width:100%">Apply</button>
                @else
                </form>
                <center class="btn btn-success" style="width:100%"><span style="color: #000; ">You applied this job</span></center>
                @endif
                @endif
              </p>
               </div>
       

<br>
<br>
<br>

     </div>
   </div>
@endsection
