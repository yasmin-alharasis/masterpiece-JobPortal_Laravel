@extends('layouts.app')

@section('content')

<div class="container">
@if(Session::has('message'))
      <div class="alert alert-success">{{Session::get('message')}}</div>
@endif
    <div class="row">
        <div class="col-md-4">
           @include('admin.left-menu')
        </div>
        <div class="col-md-8">
        <div class="card">
                <div class="card-header">
                    Edit Post
                </div>
                <div class="card-body">
                    <form action="{{route('post.update',[$post->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf  
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{$post->title}}">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Content</label>
                            <textarea type="text" name="content" class="form-control @error('content') is-invalid @enderror" >{{$post->content}}</textarea>
                            @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror " >
                            <img src="{{asset('uploads/image/'.$post->image)}}" width="80">
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
							<label>Status</label>
							<select name="status" class="form-control">
                                <option value="1"{{$post->status=='1'?'selected':''}}>Live</option>
								<option value="0"{{$post->status=='0'?'selected':''}}>Draft</option>
							</select>
                            
						</div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection