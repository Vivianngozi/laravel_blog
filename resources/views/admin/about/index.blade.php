@extends('admin.admin_master')


@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">

            
              <h4>Home About</h4>
            <a href="{{route('add.about')}}"><button class="btn btn-info mb-4">Add About</button></a>
        

            <div class="col-md-12">
                <div class="card">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                         <strong>{{session('success')}}</strong>
                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                @endif

                    <div class="card-header">All About</div>
             
            <table class="table">
  <thead>

    <tr>
      <th scope="col" width="5%">Sl</th>
      <th scope="col" width="15%">About Title</th>
      <th scope="col" width="25%">Short Description</th>
      <th scope="col" width="25%">Long Description</th>
      <th scope="col" width="15%">Action</th>
    </tr>
  </thead>
  <tbody>
  @php($i = 1)

  @foreach($homeabout as $about)
    <tr>
    
      <th scope="row">{{$i++}}</th>
      <td>{{$about->title}}</td>
      <td>{{$about->short_dis}}</td>
      <td>{{$about->long_dis}}</td>

      <td>
        <a href="{{url('/home/edit/'.$about->id)}}" class="btn btn-info">Edit</a>
        <a href="{{ url('/delete/about/'.$about->id) }}" onclick="return confirm('Are you sure, you want to delete this')" class="btn btn-danger">Delete</a>
        
      </td>
      
    </tr>
    @endforeach
 
  </tbody>
</table>



</div>
            </div>

</div>
    
        </div>




@endsection
