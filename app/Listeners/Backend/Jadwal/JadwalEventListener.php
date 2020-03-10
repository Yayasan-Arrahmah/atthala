<?php

namespace App\Listeners\Backend\Jadwal;

/**
 * Class JadwalEventListener.
 */
class JadwalEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        $user    = auth()->user()->name;

        $newitem = $event->jadwal->id;

        \Log::info('User ' . $user . ' has created item ' . $newitem);
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        $user           = auth()->user()->name;

        $updated_item   = $event->jadwal->id;

        \Log::info('User ' . $user . ' has updated item ' . $updated_item);
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        $user           = auth()->user()->name;

        $deleted_item   = $event->jadwal->id;

        \Log::info('User ' . $user . ' has deleted item ' . $deleted_item);    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Jadwal\JadwalCreated::class,
            'App\Listeners\Backend\Jadwal\JadwalEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Jadwal\JadwalUpdated::class,
            'App\Listeners\Backend\Jadwal\JadwalEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Jadwal\JadwalDeleted::class,
            'App\Listeners\Backend\Jadwal\JadwalEventListener@onDeleted'
        );
    }
}
