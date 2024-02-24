<?php

namespace App\Admin\Forms\Steps;

use Encore\Admin\Widgets\StepForm;
use Encore\Admin\Widgets\InfoBox;
use App\Models\ProgresApproval;
use App\Models\ProgresDocument;
use App\Models\ProgresServiceDocument;
use App\Models\ProgresServiceInput;
use Encore\Admin\Widgets\Box;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\MessageBag;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class Info extends StepForm
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Basic info';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
        $this->clear();
        //$filePath = "URL/uploads/$request->file";;
        $filePath = url('/') . '/uploads/' . $request->file;

        $details = [
            'title' => $request->subject,
            'body' => $request->message,
            'url' => $filePath,
        ];

        Mail::to($request->email)->send(new \App\Mail\MyTestMail($details));
        //return back();
        $success = new MessageBag([
            'title'   => 'Sukses!',
            'message' => 'Pengiriman surat izin ke pemohon berhasil !',
        ]);

        ProgresDocument::where("id", $request->id)
            ->update([
                'status_send' => 1
            ]);

        return back()->with(compact('success'));
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        //use Encore\Admin\Widgets\Box;
        if ($_GET) {
            $id = $_GET['id'];
        } else {
            $id = '1';
        }

        $data = ProgresDocument::findOrFail($id);

        $this->hidden('id')->default($data->id);

        $this->email('email')->default($data->user->email)->rules('required');
        $this->text('subject', 'Subject')->default('PENERBITAN SURAT IZIN : ' . $data->applicant_name . '')->rules('required');
        $this->text('file', 'File Surat')->default($data->file_permit)->readonly();
        $this->textarea('message', 'Message')
            ->default('Selamat surat izin kamu sudah terbit dengan nomor ' . $data->number_letter . '  jika ada pertanyaan silahkan kirim email ke bulukumbadpmptsp@gmail.com atau hubungi Call-Center Kami di ( 0413 ) 85060 / 082348675757 ')
            ->rules('required');
    }
}
