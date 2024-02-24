<html>

<head>
    <style>
        body {
            font-family: sans-serif;
            font-size: 10pt;
        }

        header {
            position: fixed;
            top: -30px;
            left: 0px;
            right: 0px;
            height: 550px;


        }

        footer {
            position: fixed;
            bottom: -50px;
            left: 0px;
            right: 0px;
            height: 50px;

            /** Extra personal styles **/
            background-color: #0c71a0;
            color: white;
            text-align: center;
            line-height: 35px;
        }

        .content {}

        p {
            margin: 0pt;
        }

        table.items {
            border: 0.1mm solid #000000;
        }

        td {
            vertical-align: top;
        }

        .items td {
            border-left: 0.1mm solid #000000;
            border-right: 0.1mm solid #000000;
        }

        table thead td {
            background-color: #EEEEEE;
            text-align: center;
            border: 0.1mm solid #000000;
            font-variant: small-caps;
        }

        .items td.blanktotal {
            background-color: #EEEEEE;
            border: 0.1mm solid #000000;
            background-color: #FFFFFF;
            border: 0mm none #000000;
            border-top: 0.1mm solid #000000;
            border-right: 0.1mm solid #000000;
        }

        .items td.totals {
            text-align: right;
            border: 0.1mm solid #000000;
        }

        .items td.cost {
            text-align: "."center;
        }

        .page-break {
            page-break-after: always;
        }

        div.barcode {
            margin: 30px 490px 0 0;
        }

        div.foto {
            margin: -110px 0 0 0;
        }

        div.tondano {
            margin: -125px 0 0 300px;
        }

        div.blnthn {
            margin: -18px 0 0 550px;
        }

        div.ketua {
            margin: 50px 0 0 500px;
        }

        div.nip {
            margin: 2px 0 0 417px;
        }

        div.kk {
            margin: 0 0 0 284px;
        }

    </style>
</head>

<body>
    <!-- Define header and footer blocks before your content -->


    <footer>
        Hasil cetakan ini telah diproses dan disetujui melalui aplikasi simap.bulukumbab.go.id &copy; <?php echo date('Y'); ?>
    </footer>


    <header name="myheader">
        <table width="100%">
            <tr>
                <td><img src="assets/landing-page/img/logo-bulukumba.jpg" alt="logo" class="img-responsive" width="110">
                </td>
                <td width="100%" style="color:#0000BB; "> <br><br>
                    <center>
                    <span style="font-weight: bold; font-size: 12pt;">
                        PEMERINTAH KABUPATEN BULUKUMBA
                        DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU
                        SATU PINTU
                    </span>
                    <br />Jl. Kenari No. 13, Bulukumba 92511, Sulawesi Selatan, Telp ( 0413 ) 84241
                    <br />Email: dpmptspbulukumba@gmail.com | Website: dpmptsp.bulukumbakab.go.id
                </center>
                </td>

            </tr>
        </table>
        <div style="border-top: 1px solid #000000; font-size: 12pt; text-align: center; padding-top: 3mm; ">

        </div>
    </header>
    <br><br><br><br><br><br>

    <div class="content">
        <center>
            <h3> VERIFIKASI SYARAT DOKUMEN PEMOHON <br> {{ $sk->service->name }} </h3> NO.REG :
            {{ $sk->no_invoice }}
        </center>
        <br>
        <table style="font-size: 9pt; border-collapse: collapse; " cellpadding="3">

            <tr>
                <td>Nama Pemohon</td>
                <td>:</td>
                <td>{{ $sk->applicant_name }}</td>
            </tr>
            <tr>
                <td>Nomor Induk KTP</td>
                <td>:</td>
                <td>{{ $sk->nik }}</td>
            </tr>
            <tr>
                <td>Nomor NPWP</td>
                <td>:</td>
                <td>{{ $sk->npwp }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td>{{ $sk->gender }}</td>
            </tr>
            <tr>
                <td>Tempat/Tanggal Lahir</td>
                <td>:</td>
                <td>{{ $sk->place_of_birth }} / {{ $sk->date_of_birth }}</td>
            </tr>
            <tr>
                <td>Telepon/HP</td>
                <td>:</td>
                <td>{{ $sk->phone_number }}</td>
            </tr>
            <tr>
                <td>Alamat KTP</td>
                <td>:</td>
                <td>{{ $sk->address_ktp }}</td>
            </tr>

        </table>
        <br>
        <table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="4">
            <thead>
                <tr>
                    <td width="1%">No.</td>
                    <td width="10%">Dokumen Kelengkapan</td>
                    <td width="2%">Status</td>
                </tr>
            </thead>
            <tbody>
                <!-- ITEMS HERE -->
                @php
                    $no = 0;
                @endphp
                @foreach ($sk->documents as $doc)
                    @php
                        $no++;
                    @endphp
                    <tr>
                        <td align="center" rowspan="0">{{ $no }}</td>
                        <td align="left">{{ $doc->document_name }}</td>
                        <td align="center">verified</td>

                    </tr>
                @endforeach


            </tbody>
        </table>
        <br>

        Verifikasi Dokumen Pemohon :
        <br>
        <br>
        <table width="100%" style="font-family: serif;" cellpadding="10">
            <tr>
                <td width="100%" style="border: 0.1mm solid #888888; ">
                    <span style="font-size: 7pt; color: #555555; font-family: sans;">VERIFIKATOR DOKUMEN:</span><br />
                    <br />Waktu : {{ $sk->date_verified_doc }}
                    <br />Verifikator : {{ $sk->verifikator }}
                    <hr>
                    <span style="font-size: 7pt; color: #555555; font-family: sans;">CATATAN VERIFIKATOR:</span><br />
                    <br /> {{  $note_doc }}
                </td>

            </tr>
        </table>
    </div>
    <div class="page-break"></div>
    <br><br><br><br><br><br><br>
    <center>
        <h3> VERIFIKASI DAN REKOMENDASI TEKNIS PEMOHON <br> {{ $sk->service->name }}</h3> NO.REG :
        {{ $sk->no_invoice }}
    </center>
    <br>
    Verifikasi dan Rekomendasi Teknis :
    <br>
    <br>
    <table width="100%" style="font-family: serif;" cellpadding="10">
        <tr>
            <td width="100%" style="border: 0.1mm solid #888888; ">
                <span style="font-size: 7pt; color: #555555; font-family: sans;">VERIFIKATOR TEKNIS:</span><br />
                <br />Waktu : {{ $sk->date_verified_teknis }}
                <br />Verifikator : {{ $sk->verifikator_teknis }}
                <hr>
                <span style="font-size: 7pt; color: #555555; font-family: sans;">CATATAN VERIFIKATOR:</span><br />
                <br /> {{  $note_teknis }}
                
            </td>

        </tr>
    </table>

    <br>

    <br>
    Approval Pimpinan :
    <br>
    <br>
    <table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="6">
        <thead>
            <tr>
                <td width="25%">KEPALA SEKSI</td>
                <td width="25%">KEPALA BIDANG</td>
                <td width="25%">SEKERTARIS</td>
                <td width="25%">KEPALA DINAS</td>
            </tr>
        </thead>
        <tbody>
            <!-- ITEMS HERE -->
            <tr>
                <td style=" text-align: center; ">
                    @if ($approval->approval_ka_seksi)
                        <br>APPROVE<br>
                    @else
                        <br> - <br>
                    @endif
                </td>
                <td style=" text-align: center; ">
                    @if ($approval->approval_ka_bidang)
                        <br>APPROVE<br>
                    @else
                        <br> - <br>
                    @endif
                </td>
                <td style=" text-align: center; ">
                    @if ($approval->apporval_sekretaris)
                        <br>APPROVE<br>
                    @else
                        <br> - <br>
                    @endif
                </td>
                <td style=" text-align: center; ">
                    @if ($approval->approval_ka_dinas)
                        <br>APPROVE<br>
                    @else
                        <br> - <br>
                    @endif
                </td>
            </tr>
            <tr>
                <td>Time: {{ $approval->approval_ka_seksi }}</td>
                <td>Time: {{ $approval->approval_ka_bidang }}</td>
                <td>Time: {{ $approval->apporval_sekretaris }}</td>
                <td>Time: {{ $approval->approval_ka_dinas }}</td>
            </tr>

        </tbody>
    </table>
    @if ($approval->approval_ka_dinas)
        <div class="page-break"></div>
        <br><br><br><br><br><br><br>
        <center>
            <h3>SURAT KETERANGAN IZIN TERBIT <br> NOMOR SK : {{ $sk->number_letter }}</h3>
            <br><br>
        </center>
        <center>
            <table>

                <tr>
                    <td>NAMA </td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>:</td>
                    <td><b>{{ $sk->applicant_name }}</b></td>
                </tr>

                <tr>
                    <td>NK </td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>:</td>
                    <td>{{ $sk->nik }}</td>
                </tr>

                <tr>
                    <td>NPWP </td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>:</td>
                    <td>{{ $sk->nik }}</td>
                </tr>

                <tr>
                    <td>TEMPAT, TANGGAL LAHIR </td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>:</td>
                    <td>{{ $sk->place_of_birth }},{{ $sk->date_of_birth }}</td>
                </tr>

                <tr>
                    <td>JENIS IZIN </td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>:</td>
                    <td>{{ $sk->service->name }}</td>
                </tr>


            </table><br><br>
            Sebagai bukti permohonan <b>{{ $sk->service->name }}</b> ini telah memenuhi syarat ketentuan dan berlaku
            sejak tanggal diterbitkan dan apabila dikemudian hari terdapat kekeliruan dalam hal penerbitan dokumen ini
            akan diperbaiki sebagaimana mestinya.
            <br><br>
            Diterbitkan di Bulukumba pada tanggal {{ $sk->getDateEndProgres() }} <br>
            <br> a.n Kepala Dinas DPMPTSP Kabupaten Bulukumba <br><br><br>
            <img
                src="data:image/png;base64, {{ base64_encode(
                    QrCode::format('png')->size(100)->generate(url('view-file/sk_pdf?number=' . $sk->no_invoice)),
                ) }} ">
            @php
               // $pecahkan = explode('/', $approval->name_ka_dinas);
            @endphp
            {{-- <br>{{ $pecahkan[0] }}
            <br>NIP. {{ $pecahkan[1] }} --}}

        </center><br><br>
        <table width="100%" style="font-family: serif;" cellpadding="10">
            <tr>
                <td width="100%" style="border: 0.1mm solid #888888; ">
                    <span style="font-size: 7pt; color: #555555; font-family: sans;">KETERANGAN:</span><br />
                    <br />Silahkan mengambil blanko surat izin anda di Kantor DPMPTSP Kabupaten Bulukumba dengan
                    melampirkan surat keterangan izin terbit ini pada hari senin - jumat pukul 08:00 s.d 16:00 kecuali
                    hari libur dan libur nasional.


                    <br />
                </td>


            </tr>
        </table>
    @endif


</body>

</html>
