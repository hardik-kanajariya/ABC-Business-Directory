<?php

namespace App\Providers;

use App\Models\ScheduleEventLog;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Console\Events\ScheduledTaskFailed;
use Illuminate\Console\Events\ScheduledTaskFinished;
use Illuminate\Console\Events\ScheduledTaskStarting;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        parent::boot();

        Event::listen(ScheduledTaskStarting::class, function (ScheduledTaskStarting $event) {
            ScheduleEventLog::create([
                'command' => $event->task->command,
                'description' => $event->task->description,
                'started_at' => now(),
                'successful' => false, // Initially false, updated later
            ]);
        });

        Event::listen(ScheduledTaskFinished::class, function (ScheduledTaskFinished $event) {
            $log = ScheduleEventLog::where('command', $event->task->command)
                ->where('successful', false)
                ->orderBy('started_at', 'desc')
                ->first();

            $log?->update([
                'finished_at' => now(),
                'output' => $event->task->getDefaultOutput(),
                'successful' => true,
            ]);
        });

        Event::listen(ScheduledTaskFailed::class, function (ScheduledTaskFailed $event) {
            $log = ScheduleEventLog::where('command', $event->task->command)
                ->where('successful', false)
                ->orderBy('started_at', 'desc')
                ->first();

            $log?->update([
                'finished_at' => now(),
                'output' => $event->exception->getMessage(),
            ]);
        });
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
