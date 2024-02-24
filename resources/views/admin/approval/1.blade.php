<div class="row">
    <div class="col-md-12">
        <div class="box">
            <table class="table">
                <tr>
                    <th>No.Reg</th>
                    <th>Pemohon</th>
                    <th>Tanggal Masuk</th>
                    <th>Action</th>
                </tr>
                @forelse ($data as $d)
                    <tr>
                        <td>{{ $d->no_invoice }}</td>
                        <td>{{ $d->applicant_name }}</td>
                        <td>{{ $d->date_start_progres }}</td>
                        <td>
                            <a class="btn btn-default"
                                href="{{ url('admin-panel/getApproval_1?to=' . $to . '&id=' . $d->id) }}"> Approve</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="border text-center p-5">
                            Belum ada permohonan
                        </td>
                    </tr>
                @endforelse
            </table>
        </div>
    </div>
</div>
