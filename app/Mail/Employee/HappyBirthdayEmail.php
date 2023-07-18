<?php

namespace App\Mail\Employee;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HappyBirthdayEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $name;

    public function __construct(
        string $name
    )
    {
        $this->name = $name;
    }

    public function build()
    {
//        $imageUrl = asset('assets/media/misc/birthdayCard.jpg');
        $imageUrl = 'https://i.hizliresim.com/h0d14ds.jpg';
        $this->subject('🎉🎉🎉 İyi ki    doğdun ' . $this->name . '🎉🎉🎉');
        return $this->view('employee.emails.happyBirthday', [
            'imageUrl' => $imageUrl,
        ]);
    }
}
