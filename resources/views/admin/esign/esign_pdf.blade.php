<div class="col-md-12">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">SIGNATURE DOCUMENT</h3>
        </div>


        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">INVISIBLE</a></li>


                {{-- <li><a href="#tab_2" data-toggle="tab">Visible with ImageTTD</a></li> --}}


                <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <form class="form-prevent form-horizontal" action="{{ url('admin-panel/send_esign_pdf') }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="signed_file" class="col-sm-2 control-label">File Dokumen (PDF)</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="signed_file" name="signed_file" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">NIK</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nik" name="nik" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Passphrase</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="passphrase" name="passphrase" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tampilan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="tampilan" name="tampilan"
                                        value="invisible" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">reason</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="reason" name="reason" required>
                                </div>
                            </div>


                        </div>

                        <div class="box-footer">
                            <a href="{{ url('admin-panel/esigns') }}" class="btn btn-default">Back</a>
                            <button class="btn btn-success button-prevent pull-right" type="submit">
                                <div class="spinner"><i role="status"
                                        class="spinner-border spinner-border-sm"></i>
                                    Loading...
                                </div>
                                <div class="hide-text">Submit</div>
                            </button>
                        </div>

                    </form>
                </div>

                {{-- <div class="tab-pane" id="tab_2">
                    <form class="form-prevent form-horizontal" action="{{ url('admin-panel/send_esign_pdf') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="file" class="col-sm-2 control-label">File Dokumen (PDF)</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="file" name="file">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="imageTTD" class="col-sm-2 control-label">image TTD</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="imageTTD" name="imageTTD">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">NIK</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nik" name="nik">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Passphrase</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="passphrase" name="passphrase">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tampilan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="tampilan" name="tampilan"
                                        value="visible" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Page</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="page" name="page" value="1">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">reason</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="reason" name="reason">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Location</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="location" name="location">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">image</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="image" name="image" value="true"
                                        readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">xAxis</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="xAxis" name="xAxis" value="0">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">yAxis</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="yAxis" name="yAxis" value="0">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">width</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="width" name="width" value="550">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">height</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="height" name="height" value="150">
                                </div>
                            </div>

                        </div>

                        <div class="box-footer">
                            <button class="btn btn-success button-prevent pull-right" type="submit">
                                <div class="spinner"><i role="status" class="spinner-border spinner-border-sm"></i>
                                    Loading...
                                </div>
                                <div class="hide-text">Submit</div>
                            </button>
                        </div>

                    </form>
                </div> --}}



            </div>

        </div>
    </div>
    
    @if (Session::has('msg'))
     
        <div col-md-12>
            <div class="alert alert-info">
                

                            {!! Session::has('msg') ? Session::get('msg') : '' !!}

                       

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
