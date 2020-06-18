<?php

namespace App\Listeners\Backend\Absen;

/**
 * Class AbsenEventListener.
 */
class AbsenEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        $user    = auth()->user()->name;

        $newitem = $event->absen->id_peserta;

        \Log::info('User ' . $user . ' has created item ' . $newitem);
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        $user           = auth()->user()->name;

        $updated_item   = $event->absen->id_peserta;

        \Log::info('User ' . $user . ' has updated item ' . $updated_item);
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        $user           = auth()->user()->name;

        $deleted_item   = $event->absen->id_peserta;

        \Log::info('User ' . $user . ' has deleted item ' . $deleted_item);    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Absen\AbsenCreated::class,
            'App\Listeners\Backend\Absen\AbsenEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Absen\AbsenUpdated::class,
            'App\Listeners\Backend\Absen\AbsenEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Absen\AbsenDeleted::class,
            'App\Listeners\Backend\Absen\AbsenEventListener@onDeleted'
        );
    }
}
