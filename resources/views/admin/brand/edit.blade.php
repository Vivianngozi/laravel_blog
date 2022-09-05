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
                    <div class="card-header">Edit Brand</div>
                      
                    <div class="card-body">
                    <form method="POST" action="{{url('/brand/update/'.$brands->id)}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="old_image" value="{{$brands->brand_image}}">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Update Brand Name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="brand_name" value="{{$brands->brand_name}}">
    
    @error('brand_name')
    <span class="text-danger">{{ $message}}</span>

    @enderror
  </div>


  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Update Brand Image</label>
    
    <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="brand_image" value="{{$brands->brand_image}}"><br>
    <img src="{{asset($brands->brand_image)}}" alt="brand image" style="height: 70px; width: 100px;">

    @error('brand_image')
    <span class="text-danger">{{ $message}}</span>

    @enderror
  </div>
  
  <button type="submit" class="btn btn-primary">Update Brand</button>
</form>
                    </div>

         
  

                    </div>
    
    </div>
            </div>
    
        </div>
   
    </div>
@endsection
