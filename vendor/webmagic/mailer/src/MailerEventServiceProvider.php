<?php

namespace Webmagic\Mailer;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class MailerEventServiceProvider extends ServiceProvider
{
    /**
     * MilerEventServiceProvider constructor.
     *
     * @internal param array $listen
     */
    public function __construct($app)
    {
        parent::__construct($app);

        $events = config('webmagic.mailer.events');
        $listeners = [];

        foreach ($events as $event => $listener) {
            $listeners[$event] = $listener;
        }

        $this->listen = $listeners;
    }

    /**
     * Register any other events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
