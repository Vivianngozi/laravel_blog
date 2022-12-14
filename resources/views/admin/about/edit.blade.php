@extends('admin.admin_master')


@section('admin')

<div class="content-wrapper">
          <div class="content">							
            <div class="row">
<div class="col-lg-12">
	<div class="card card-default">
		<div class="card-header card-header-border-bottom">
			<h2>Edit Home About</h2>
	    </div>
		<div class="card-body">
			<form method="POST" action="{{url('/update/homeabout/'.$homeabout->id)}}" enctype="multipart/form-data">
                @csrf
				<div class="form-group">
					<label for="exampleFormControlInput1">About Title</label>
						<input type="text" class="form-control" id="exampleFormControlInput1" name="title" value="{{$homeabout->title}}">
							
				</div>
                @error('title')
                <span class="text-danger">{{$message}}</span>
                @enderror
			
				<div class="form-group">
					<label for="exampleFormControlTextarea1">Short Description</label>
					<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="short_dis">{{$homeabout->short_dis}}</textarea>

                    @error('short_dis')
                <span class="text-danger">{{$message}}</span>
                @enderror
				</div>

                <div class="form-group">
					<label for="exampleFormControlTextarea1">Long Description</label>
					<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="long_dis">{{$homeabout->long_dis}}</textarea>

                    @error('long_dis')
                <span class="text-danger">{{$message}}</span>
                @enderror
				</div>
				

				<div class="form-footer pt-4 pt-5 mt-4 border-top">
					<button type="submit" class="btn btn-primary btn-default">Submit</button>
													
				</div>
			</form>
						</div>
									</div>

									

								</div>
                                </div>
									</div>

									

								</div>

@endsection