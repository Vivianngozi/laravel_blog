@extends('admin.admin_master')


@section('admin')

<div class="content-wrapper">
          <div class="content">							
            <div class="row">
<div class="col-lg-12">
	<div class="card card-default">
		<div class="card-header card-header-border-bottom">
			<h2>Create Slider</h2>
	    </div>
		<div class="card-body">
			<form method="POST" action="{{route('store.slider')}}" enctype="multipart/form-data">
                @csrf
				<div class="form-group">
					<label for="exampleFormControlInput1">Slider Title</label>
						<input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Slider Title" name="title">
							
				</div>
                @error('title')
                <span class="text-danger">{{$message}}</span>
                @enderror
			
				<div class="form-group">
					<label for="exampleFormControlTextarea1">Description</label>
					<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
				</div>

                @error('description')
                <span class="text-danger">{{$message}}</span>
                @enderror

				<div class="form-group">
					<label for="exampleFormControlFile1">Image</label>
					<input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
				</div>

                @error('image')

                <span class="text-danger">{{$message}}</span>
                @enderror

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