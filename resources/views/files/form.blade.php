<form method="POST" action="{{ route('admin:updateFileType') }}" enctype="multipart/form-data">
    @csrf()
    <div class="card m-0">
        <div class="card-body">
            <div class="row gutters">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="form-group">
                        <label>File Type Title</label>
                        <input type="text" class="form-control" name="type_title" placeholder="File Type Title" value="{{$FileType->type_title}}" required="">
                        <input type="hidden" class="form-control" name="id" placeholder="File Type Title" value="{{$FileType->id}}" required="">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="form-group">
                        <label>File Size</label>
                        <input type="text" class="form-control" name="file_size" placeholder="File Size" value="{{$FileType->file_size}}" required="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>