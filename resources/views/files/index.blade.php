@extends('layout.layout')
@section('contents')
<div class="row" style="margin-top: 1%;margin-bottom:50px;">
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

            <div class="row" style="padding-top:15px;">
                @foreach($getFiles as $files)
                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center" style="border:1px solid gray;padding:20px; background-color:{{ $files ? $files->color_code : null }}" id="row{{$files->id}}">
                    <a href="{{route('admin:files.details',$files->id)}}">
                        <i class="fa fa-folder-open" style="font-size:50px;" data-toggle="tooltip" title="Secret"></i>
                    </a>
                    <p>{{$files->title}}</p>
                    <p>
                        <a href="{{route('admin:files.details',$files->id)}}" class="far fa-eye" style="padding:7px 5px;"></a>
                        <a href="#edit-modal" onclick="editFile({{$files->id}})" type="button" class="waves-effect waves-light far fa-edit"  data-animation="door" data-plugin="custommodal" data-overlaySpeed="100" data-overlayColor="#36404a" style="padding:7px 5px;"></a>
                        <a href="#" class="far fa-trash-alt btn_delete" style="padding:7px 5px;" attr="{{$files->id}}"></a> 
                    </p>
                </div>
                @endforeach
            </div>
			<div class="row" style="padding-top:15px;">
			{{ $getFiles->links() }}
			</div>
        </div>


        <!-- Modal -->
        {{-- Create Modal --}}
        <div id="create-modal" class="modal-demo">
            <button type="button" class="close" onclick="Custombox.modal.close();">
                <span>&times;</span><span class="sr-only">Close</span>
            </button>
            <h4 class="custom-modal-title">Create {{$title}}</h4>
            <div class="text-muted">
                <form method="POST" action="{{ route('admin:saveFile') }}" enctype="multipart/form-data">
		            @csrf()
					<div class="card m-0">
						<div class="card-body">
							<div class="row gutters">
								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
									<div class="form-group">
										<label>Tile</label>
										<input type="text" class="form-control" name="title" placeholder="File Title" required="">
									</div>
								</div>
								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
									<div class="form-group">
										<label>Color Code (optional)</label>
										<input type="color" class="form-control" name="color_code" placeholder="File Color Code">
									</div>
								</div>
								<!-- <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
									<div class="form-group">
										<label>Password (optional)</label>
										<input type="text" class="form-control" name="password" placeholder="File Password to protect">
									</div>
								</div> -->
							</div>
							<div class="row mb-4" style="justify-content: center;">
								<p class="btn btn-info" onClick="appendRow()"><i class="fa fa-plus"></i>Add Row</button>
							</div>
							<div class="row gutters" id="appendRow" style="height:250px; overflow-y:scroll;">
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
									<div class="form-group">
										<label>Document Title</label>
										<input type="text" class="form-control" name="doc_title[]" placeholder="Document Title" required="">
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
									<div class="form-group">
										<label>Document</label>
										<input type="file" name="doc_file[]" class="form-control" />
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer" style="background-color:whitesmoke;">
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</form>
            </div>
        </div>
		<div id="edit-modal" class="modal-demo">
            <button type="button" class="close" onclick="Custombox.modal.close();">
                <span>&times;</span><span class="sr-only">Close</span>
            </button>
            <h4 class="custom-modal-title">Create {{$title}}</h4>
            <div class="text-muted edit_form">
                
            </div>
        </div>
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
		  	$('#row'+id).hide();
			$.ajax({
				url: "{{ url('/file/delete') }}"+'/'+id,
				success:function(result){
					Swal.fire(
				      'Deleted!',
				      'Your File has been deleted.',
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
<script>
	function appendRow(){
		$('#appendRow').append('<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">'+
									'<div class="form-group">'+
										'<label>Document Title</label>'+
										'<input type="text" class="form-control" name="doc_title[]" placeholder="Document Title" required="">'+
									'</div>'+
								'</div>'+
								'<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">'+
									'<div class="form-group">'+
										'<label>Document</label>'+
										'<input type="file" name="doc_file[]" class="form-control" />'+
									'</div>'+
								'</div>');
	}
</script>
<script>
	function editFile(id){
		$.ajax({
			url: "{{ url('/file/edit') }}"+'/'+id,
			success:function(result){
				$('.edit_form').html(result);
			}
		});
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