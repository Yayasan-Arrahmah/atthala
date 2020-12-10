<?php

namespace App\Listeners\Backend\Rtq;

/**
 * Class RtqEventListener.
 */
class RtqEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        $user    = auth()->user()->name;

        $newitem = $event->rtq->nama_santri;

        \Log::info('User ' . $user . ' has created item ' . $newitem);
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        $user           = auth()->user()->name;

        $updated_item   = $event->rtq->nama_santri;

        \Log::info('User ' . $user . ' has updated item ' . $updated_item);
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        $user           = auth()->user()->name;

        $deleted_item   = $event->rtq->nama_santri;

        \Log::info('User ' . $user . ' has deleted item ' . $deleted_item);    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Rtq\RtqCreated::class,
            'App\Listeners\Backend\Rtq\RtqEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Rtq\RtqUpdated::class,
            'App\Listeners\Backend\Rtq\RtqEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Rtq\RtqDeleted::class,
            'App\Listeners\Backend\Rtq\RtqEventListener@onDeleted'
        );
    }
}
