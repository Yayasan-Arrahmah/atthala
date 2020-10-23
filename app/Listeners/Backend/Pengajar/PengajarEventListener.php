<?php

namespace App\Listeners\Backend\Pengajar;

/**
 * Class PengajarEventListener.
 */
class PengajarEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        $user    = auth()->user()->name;

        $newitem = $event->pengajar->nama_pengajar;

        \Log::info('User ' . $user . ' has created item ' . $newitem);
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        $user           = auth()->user()->name;

        $updated_item   = $event->pengajar->nama_pengajar;

        \Log::info('User ' . $user . ' has updated item ' . $updated_item);
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        $user           = auth()->user()->name;

        $deleted_item   = $event->pengajar->nama_pengajar;

        \Log::info('User ' . $user . ' has deleted item ' . $deleted_item);    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Pengajar\PengajarCreated::class,
            'App\Listeners\Backend\Pengajar\PengajarEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Pengajar\PengajarUpdated::class,
            'App\Listeners\Backend\Pengajar\PengajarEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Pengajar\PengajarDeleted::class,
            'App\Listeners\Backend\Pengajar\PengajarEventListener@onDeleted'
        );
    }
}
