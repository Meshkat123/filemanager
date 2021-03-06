@extends('layout.layout')
@section('contents')
<div class="row" style="margin-top: 1%;">
    <div class="col-12">
        <div class="card-box">
        	<div class="row">
        		<div class="col-10">
		            <h4 class="header-title text-center">{{$title}}</h4>
		        </div>
		        <div class="col-2">
		            <a href="#create-modal" class="btn btn-primary waves-effect waves-light" data-animation="door" data-plugin="custommodal"data-overlaySpeed="100" data-overlayColor="#36404a" style="color: white;float: right;"><i class="fas fa-plus"></i> Create</a>
		        </div>
	        </div>
            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
	                <tr>
	                    <th>Image</th>
	                    <th>Name</th>
	                    <th>Email</th>
	                    <th>Phone</th>
	                    <th>Status</th>
	                    <th>Updated date</th>
	                    <th>Action</th>
	                </tr>
                </thead>
                <tbody>
                	@foreach($get_user as $user)
	                <tr id="user{{$user->id}}">
	                    <td><img src="{{asset($user->image)}}" style="width: 50px;"></td>
	                    <td>{{$user->name}}</td>
	                    <td>{{$user->email}}</td>
	                    <td>{{$user->phone}}</td>
	                    @if($user->status == 1)
	                    <td style="background-color: green;color: white;" id="status{{$user->id}}">Active</td>
	                    @else
	                    <td style="background-color: tomato;color: white;" id="status{{$user->id}}">Pending</td>
	                    @endif
	                    <td>{{date('d M Y',strtotime($user->updated_at))}}</td>
	                    <td>
						  	<a href="#edit-modal{{$user->id}}" type="button" class="btn btn-info waves-effect waves-light"  data-animation="door" data-plugin="custommodal" data-overlaySpeed="100" data-overlayColor="#36404a">
						  		<i class="far fa-edit"></i>
						  	</a>
						  	<a href="#" class="material-switch">
	                        	@if($user->status == 1)
	                            <input id="postApprove{{$user->id}}" name="action" type="checkbox" onclick="actionUser({{$user->id}},{{$user->status}})" checked=""/>
	                            <label for="postApprove{{$user->id}}" class="label-danger" ></label>
	                            @else
	                            <input id="postApprove{{$user->id}}" name="action" type="checkbox" onclick="actionUser({{$user->id}},{{$user->status}})"/>
	                            <label for="postApprove{{$user->id}}" class="label-danger" ></label>
	                            @endif
	                        </a>
						  	<a href="javascript:void(0);" type="button" class="btn btn-icon btn-danger btn_delete" attr="{{$user->id}}">
						  		<i class="far fa-trash-alt"></i>
						  	</a>
						</td>
	                </tr>
	                @endforeach
                </tbody>
            </table>
        </div>


        <!-- Modal -->
        {{-- Create Modal --}}
        <div id="create-modal" class="modal-demo">
            <button type="button" class="close" onclick="Custombox.modal.close();">
                <span>&times;</span><span class="sr-only">Close</span>
            </button>
            <h4 class="custom-modal-title">Create {{$title}}</h4>
            <div class="text-muted">
                <form method="POST" action="{{ route('admin:saveUser') }}" enctype="multipart/form-data">
		            @csrf()
					<div class="card m-0">
						<div class="card-body">
							<div class="row gutters">
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
									<div class="form-group">
										<label>Name</label>
										<input type="text" class="form-control" name="name" placeholder="User Name" required="">
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
									<div class="form-group">
										<label>Email</label>
										<input type="email" class="form-control" name="email" placeholder="User Email" required="">
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
									<div class="form-group">
										<label>Phone</label>
										<input type="text" class="form-control" name="phone" placeholder="User Phone ex. 880168.." required="">
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
									<div class="form-group">
										<label>Password</label>
										<input type="password" class="form-control" name="password" placeholder="Type your password min:8 char" required="">
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
									<div class="form-group">
										<label>Re-Password</label>
										<input type="password" class="form-control" name="re_password" placeholder="Re-type your password" required="">
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
									<div class="form-group">
										<label>Image</label>
										<input type="file" name="image" class="form-control" onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])" />
									<img src="" style="width: 50%;" id="image">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</form>
            </div>
        </div>
        @foreach($get_user as $key)
	        {{-- Edit Modal --}}
	        <div id="edit-modal{{$key->id}}" class="modal-demo">
	            <button type="button" class="close" onclick="Custombox.modal.close();">
	                <span>&times;</span><span class="sr-only">Close</span>
	            </button>
	            <h4 class="custom-modal-title">Edit {{$key->name}}</h4>
	            <div class="text-muted">
	                <form method="POST" action="{{route('admin:updateUser') }}" enctype="multipart/form-data">
			            @csrf()
						<div class="card m-0">
							<div class="card-body">
								<div class="row gutters">
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
										<div class="form-group">
											<label>Name</label>
											<input type="text" class="form-control" name="name" placeholder="User Name" required="" value="{{$key->name}}">
											<input type="hidden" class="form-control" name="id" value="{{$key->id}}">
										</div>
									</div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
										<div class="form-group">
											<label>Email</label>
											<input type="email" class="form-control" name="email" placeholder="User Email" required="" value="{{$key->email}}">
										</div>
									</div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
										<div class="form-group">
											<label>Phone</label>
											<input type="text" class="form-control" name="phone" placeholder="User Phone ex. 880168.." required="" value="{{$key->phone}}">
										</div>
									</div>
									{{-- <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
										<div class="form-group">
											<label>Password</label>
											<input type="password" class="form-control" name="password" placeholder="Type your password min:8 char" required="">
										</div>
									</div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
										<div class="form-group">
											<label>Re-Password</label>
											<input type="password" class="form-control" name="re_password" placeholder="Re-type your password" required="">
										</div>
									</div> --}}
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
										<div class="form-group">
											<label>Image</label>
											<input type="file" name="image" class="form-control" onchange="document.getElementById('image{{$key->id}}').src = window.URL.createObjectURL(this.files[0])" />

											<img src="{{asset($key->image)}}" style="width: 100px;" id="image{{$key->id}}">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary">Save</button>
						</div>
					</form>
	            </div>
	        </div>
        @endforeach
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
	$(document).on('click', '.btn_delete',function(event){
		event.preventDefault();
		var id = $(this).attr("attr");
		Swal.fire({
		  title: 'Are you sure?',
		  text: "You won't be able to revert this!",
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
		  if (result.value) {
		  	$('#user'+id).hide();
			$.ajax({
				url: "{{ url('/user/delete') }}"+'/'+id,
				success:function(result){
					Swal.fire(
				      'Deleted!',
				      'Your Image has been deleted.',
				      'success'
				    )
				}
			});
		  }
		})
	});
</script>
<script>
	function actionUser(id,id2){

		if ($('#postApprove'+id).prop('checked') == true) {
			$('#status'+id).css('background-color','green');
			$('#status'+id).empty();
			$('#status'+id).text('Accepted');

			$.ajax({
	            url: "{{ url('approveUser') }}"+'/'+id+'/'+1,
	            method: 'get',

	            success: function(result){
	            		console.log(result);
	            }
        	});
		}else{
			$('#status'+id).css('background-color','tomato');
			$('#status'+id).empty();
			$('#status'+id).text('Pending');
			$.ajax({
	            url: "{{ url('approveUser') }}"+'/'+id+'/'+0,
	            method: 'get',

	            success: function(result){
	            		console.log(result);
	            }
        	});

		}
		
	}
</script>
@stop
@section('css')
<style>
	#datatable-buttons_filter{
		float: right !important;
	}
	.material-switch > input[type="checkbox"] {
	    display: none;   
	}

	.material-switch > label {
	    cursor: pointer;
	    height: 0px;
	    position: relative; 
	    width: 40px;  
	}

	.material-switch > label::before {
	    background: rgb(255 99 71);
	    box-shadow: inset 0px 0px 10px rgba(0, 0, 0, 0.5);
	    border-radius: 8px;
	    content: '';
	    height: 16px;
	    margin-top: -8px;
	    position:absolute;
	    opacity: 0.3;
	    transition: all 0.4s ease-in-out;
	    width: 40px;
	}
	.material-switch > label::after {
	    background: rgb(255 99 71);
	    border-radius: 16px;
	    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
	    content: '';
	    height: 24px;
	    left: -4px;
	    margin-top: -8px;
	    position: absolute;
	    top: -4px;
	    transition: all 0.3s ease-in-out;
	    width: 24px;
	}
	.material-switch > input[type="checkbox"]:checked + label::before {
	    background: green;
	    opacity: 0.5;
	}
	.material-switch > input[type="checkbox"]:checked + label::after {
	    background: green;
	    left: 20px;
	}
</style>
@stop
@section('js')
<!-- Datatable plugin js -->
<script src="{{asset('admin/libs/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/libs/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Datatables init -->
<script src="{{asset('admin/js/pages/datatables.init.js')}}"></script>
@stop