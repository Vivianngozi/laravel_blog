@extends('admin.admin_master')


@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">

            
              <h4>Home Service</h4>
            <a href="{{route('add.service')}}"><button class="btn btn-info mb-4">Add Service</button></a>
        

            <div class="col-md-12">
                <div class="card">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                         <strong>{{session('success')}}</strong>
                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                @endif

                    <div class="card-header">All Service</div>
             
            <table class="table">
  <thead>

    <tr>
      <th scope="col" width="5%">Sl</th>
      <th scope="col" width="15%">Title</th>
      <th scope="col" width="25%">Description</th>
      <th scope="col" width="15%">Action</th>
    </tr>
  </thead>
  <tbody>
  @php($i = 1)

  @foreach($homeservice as $service)
    <tr>
    
      <th scope="row">{{$i++}}</th>
      <td>{{$service->title}}</td>
      <td>{{$service->desc}}</td>
      <td>
        <a href="{{url('/service/edit/'.$service->id)}}" class="btn btn-info">Edit</a>
        <a href="{{ url('/delete/service/'.$service->id) }}" onclick="return confirm('Are you sure, you want to delete this')" class="btn btn-danger">Delete</a>
        
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
