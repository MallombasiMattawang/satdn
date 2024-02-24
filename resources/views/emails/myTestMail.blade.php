<!DOCTYPE html>
<html>

<head>
    <title>siap.bulukumbakab.go.id</title>
</head>

<body>
    @component('mail::message')
        <h3>{{ $details['title'] }}</h3>
        <p>{{ $details['body'] }}</p>
        @if ( isset($details['url']) )
            @component('mail::button', ['url' => $details['url']])
                Download Surat
            @endcomponent
        @endif


        <br><br>
        <p>Dikirim oleh sistem</p>

    </body>

    </html>
