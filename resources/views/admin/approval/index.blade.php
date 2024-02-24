
<div class="row">
    <div class="col-md-12">
        @if ($role == 'KEPALA SEKSI' || $role == 'Administrator')
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h4>KA. SEKSI</h4>
                        <br><br>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <a href="{{ url('admin-panel/approval_1?to=1') }}" class="small-box-footer">
                        View <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        @endif

        @if ($role == 'KEPALA BIDANG' || $role == 'Administrator')
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h4>KA. BIDANG</h4>
                        <br><br>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <a href="{{ url('admin-panel/approval_1?to=2') }}" class="small-box-footer">
                        View <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        @endif

        @if ($role == 'SEKRETARIS' || $role == 'Administrator')
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h4>SEKRETARIS</h4>
                        <br><br>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <a href="{{ url('admin-panel/approval_1?to=3') }}" class="small-box-footer">
                        View <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        @endif

        @if ($role == 'KEPALA DINAS' || $role == 'Administrator')
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h4>KA. DINAS</h4>
                        <br><br>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <a href="{{ url('admin-panel/approval_1?to=4') }}" class="small-box-footer">
                        View <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        @endif
    </div>

</div>
