<?php

namespace App\Admin\Forms\Steps;

use Encore\Admin\Widgets\StepForm;
use Illuminate\Http\Request;

class Profile extends StepForm
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Input profile';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
        $details = [
            'title' => $request->subject,
            'body' => strip_tags($request->message),
        ];

        Mail::to($request->email)->send(new \App\Mail\MyTestMail($details));
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->email('email');
        $this->text('subject','Subject')->default('FILE SURAT IZIN');
        $this->textarea('message','Message')->default('Selamat surat izin kamu sudah terbit');
    }
}
