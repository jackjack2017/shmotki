<?php

namespace Webmagic\Mailer\Listeners;

use Webmagic\Mailer\MailerRepo;
use Illuminate\Support\Facades\Mail;

/**
 * Class NewRequestListener
 * @package Webmagic\Mailer\Listeners
 */
class MailerBaseListener
{
    /**
     * Mailer service
     *
     * @var \Webmagic\Mailer\MailerRepo
     */
    protected $mailerService;

    /**
     * Create the event listener.
     *
     * @param MailerRepo $mailerService
     */
    public function __construct(MailerRepo $mailerService)
    {
        $this->mailerService = $mailerService;
    }

    /**
     * Handle the event.
     *
     * @param $event
     */
    public function handle($event)
    {
        $data = collect($event->data);

        $emails_list_tag = get_class($event);
        $elements = $this->mailerService->getEmails($emails_list_tag);

        foreach($elements as $element){

            $email_subject = $element['subject'];
            $email_template =  "mailer::" . config('webmagic.mailer.views') . "." . $element['email_templates'];

            $emails_list = explode(',' , $element['emails']);

            Mail::queue($email_template, compact('data'), function($mail) use ($emails_list, $email_subject) {
                $mail->to($emails_list);
                $mail->subject($email_subject);
            });
        }

    }
}
