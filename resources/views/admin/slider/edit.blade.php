@extends('admin.admin_master')


@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">


            

            <div class="col-md-8">
                <div class="card">

                    @if(session('success'))

                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                         <strong>{{session('success')}}</strong>
                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                    <div class="card-header">Edit slider</div>
                      
                    <div class="card-body">
                    <form method="POST" action="{{url('/slider/update/'.$sliders->id)}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="old_image" value="{{$sliders->image}}">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Update slider Title</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="title" value="{{$sliders->title}}">
    
    @error('title')
    <span class="text-danger">{{ $message}}</span>

    @enderror
  </div>

  <div class="form-group">
					<label for="exampleFormControlTextarea1">Description</label>
					<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description">{{$sliders->description}}</textarea>
          @error('description')
   <span class="text-danger">{{ $message}}</span>
 
    @enderror
				</div>
    
  


  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Update slider Image</label>
    
    <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="image" value="{{$sliders->image}}"><br>
    <img src="{{asset($sliders->image)}}" alt="slider image" style="height: 70px; width: 100px;">

    @error('image')
    <span class="text-danger">{{ $message}}</span>

    @enderror
  </div>
  
  <button type="submit" class="btn btn-primary">Update slider</button>
</form>
                    </div>

                    </div>
    
    </div>
            </div>
    
        </div>
   
    </div>
@endsection
