<div class="col-md-12">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">VALIDASI DOCUMENT</h3>
        </div>


        <form class="form-prevent form-horizontal" action="{{ url('admin-panel/send_verify_pdf') }}" method="post"
            enctype="multipart/form-data">
            @csrf
            <div class="box-body">
                <div class="form-group">
                    <label for="file" class="col-sm-2 control-label">File Dokumen (PDF)</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="file" name="signed_file" required>
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
        <div col-md-6>
            <div class="alert alert-info">
                <table class="table">
                    <tr>
                        <td>
                            
                                {!! Session::has('msg') ? Session::get('msg') : '' !!}
                            
                        </td>
                    </tr>
                </table>
                
                
            </div>
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
