<div class="col-md-12">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">CEK STATUS USER ESIGN</h3>
        </div>


        <form class="form-prevent form-horizontal" action="{{ url('admin-panel/send_verify_user') }}" method="post"
            enctype="multipart/form-data">
            @csrf
            <div class="box-body">
                <div class="form-group">
                    <label for="nik" class="col-sm-2 control-label">NIK Pengguna</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nik" name="nik" required>
                    </div>
                </div>

            </div>

            <div class="box-footer">
                <a href="{{ url('admin-panel/esigns') }}" class="btn btn-default">Back</a>
                <button class="btn btn-success button-prevent pull-right" type="submit">
                    <div class="spinner"><i role="status" class="spinner-border spinner-border-sm"></i>
                        Loading...
                    </div>
                    <div class="hide-text">Submit</div>
                </button>
            </div>

        </form>

        
    </div>
    @if (Session::has('msg'))
            <hr>
            <div class="alert alert-info">
                {!! Session::has('msg') ? Session::get('msg') : '' !!}
            </div>
        @endif
</div>

@php
Admin::style('.spinner {
                    display: none;
                }');
Admin::script('
        (function() {
                $(".form-prevent").on("submit", function() {
                    $(".button-prevent").attr("disabled", "true");
                    $(".spinner").show();
                    $(".hide-text").hide();
                })
        })
();
    
    ');
@endphp
