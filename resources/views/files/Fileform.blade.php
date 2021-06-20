<form method="POST" action="{{ route('admin:updateFile') }}" enctype="multipart/form-data">
    @csrf()
    <div class="card m-0">
        <div class="card-body">
            <div class="row gutters">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="form-group">
                        <label>Tile</label>
                        <input type="text" class="form-control" name="title" placeholder="File Title" value="{{$getFiledoc->title}}" required="">
                        <input type="hidden" class="form-control" name="id" placeholder="File Title" value="{{$getFiledoc->id}}" required="">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="form-group">
                        <label>Color Code (optional)</label>
                        <input type="color" class="form-control" name="color_code" placeholder="File Color Code"  value="{{$getFiledoc->color_code}}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer" style="background-color:whitesmoke;">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>