@extends('layout.layout')
@section('contents')
<div class="row" style="margin-top: 1%;margin-bottom:50px;">
    <div class="col-12">
        <div class="card-box">
			<div class="row mb-4">
        		<div class="col-8">
					<form method="get" action="{{ route('admin:DocSearch') }}" enctype="multipart/form-data">
						<input type="hidden" name="id" placeholder="Search with title" value={{ $id }}>
						<span><input type="text" name="serch" placeholder="Search with title" style="width:70%; border:1px solid whitesmoke;padding:7px;"></span>
						<span><button type="submit" class="btn btn-primary">search</button></span>
					</form>
		        </div>
		        <div class="col-4">
		            <a href="{{ url('file/document/filter?id='.$id.'&filter=a') }}" class="btn btn-danger"><i class="fas fa-arrow-up"></i> A </a>
					<a href="{{ url('file/document/filter?id='.$id.'&filter=d') }}" class="btn btn-warning"><i class="fas fa-arrow-down"></i> D </a>
					<a href="" class="btn btn-success"><i class="fas fa-sync-alt"></i></a>
					<a href="#create-modal" class="btn btn-primary waves-effect waves-light" data-animation="door" data-plugin="custommodal"data-overlaySpeed="100" data-overlayColor="#36404a" style="color: white;float: right;"><i class="fas fa-plus"></i> Create</a>
		        </div>
	        </div>

            <div class="row" style="padding-top:15px;">
                @foreach($getFiledoc as $Filedoc)
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 text-center" style="border:1px solid gray;padding:20px;" id="row{{$Filedoc->id}}">
                    <a href="{{asset($Filedoc->doc_file)}}" target="_blank">
                        <center>
							@if(pathinfo(asset($Filedoc->doc_file), PATHINFO_EXTENSION) == 'docx' || 
								pathinfo(asset($Filedoc->doc_file), PATHINFO_EXTENSION) == 'doc' ||
								pathinfo(asset($Filedoc->doc_file), PATHINFO_EXTENSION) == 'pdf' ||
								pathinfo(asset($Filedoc->doc_file), PATHINFO_EXTENSION) == 'xlsx'
								)
								<i class="fas fa-file-import" style="font-size: 190px;"></i>
							@else
							<img src="{{asset($Filedoc->doc_file)}}" style="height:200px;">
							@endif
                        </center>
                    </a>
                    <p>{{$Filedoc->title}}</p>
                    <p>
                        <a href="{{asset($Filedoc->doc_file)}}" class="fas fa-download" style="padding:7px 5px;"  target="_blank"></a>
                        <a href="{{asset($Filedoc->doc_file)}}" class="far fa-eye" style="padding:7px 5px;"  target="_blank"></a>
                        <!-- <a href="#" class="far fa-edit" style="padding:7px 5px;"></a> -->
                        <a href="#" class="far fa-trash-alt btn_delete" style="padding:7px 5px;" attr="{{$Filedoc->id}}"></a> 
                    </p>
                </div>
                @endforeach
            </div>
			<div class="row" style="padding-top:15px;">
			{{ $getFiledoc->links() }}
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
			<form method="POST" action="{{ route('admin:saveDoc') }}" enctype="multipart/form-data">
		            @csrf()
					<div class="card m-0">
						<div class="card-body">
						<input type="hidden" class="form-control" name="file_id" placeholder="File Title" value="{{ $id }}" required="">
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
				url: "{{ url('/file/doc/delete') }}"+'/'+id,
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