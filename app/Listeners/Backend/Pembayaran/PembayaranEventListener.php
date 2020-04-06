<?php

namespace App\Listeners\Backend\Pembayaran;

/**
 * Class PembayaranEventListener.
 */
class PembayaranEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        $user    = auth()->user()->name;

        $newitem = $event->pembayaran->uuid_pembayaran;

        \Log::info('User ' . $user . ' has created item ' . $newitem);
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        $user           = auth()->user()->name;

        $updated_item   = $event->pembayaran->uuid_pembayaran;

        \Log::info('User ' . $user . ' has updated item ' . $updated_item);
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        $user           = auth()->user()->name;

        $deleted_item   = $event->pembayaran->uuid_pembayaran;

        \Log::info('User ' . $user . ' has deleted item ' . $deleted_item);    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Pembayaran\PembayaranCreated::class,
            'App\Listeners\Backend\Pembayaran\PembayaranEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Pembayaran\PembayaranUpdated::class,
            'App\Listeners\Backend\Pembayaran\PembayaranEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Pembayaran\PembayaranDeleted::class,
            'App\Listeners\Backend\Pembayaran\PembayaranEventListener@onDeleted'
        );
    }
}
