<?php

namespace App\Listeners\Backend\Tahsin;

/**
 * Class TahsinEventListener.
 */
class TahsinEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        $user    = auth()->user()->name;

        $newitem = $event->tahsin->uuid_tahsin;

        \Log::info('User ' . $user . ' has created item ' . $newitem);
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        $user           = auth()->user()->name;

        $updated_item   = $event->tahsin->uuid_tahsin;

        \Log::info('User ' . $user . ' has updated item ' . $updated_item);
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        $user           = auth()->user()->name;

        $deleted_item   = $event->tahsin->uuid_tahsin;

        \Log::info('User ' . $user . ' has deleted item ' . $deleted_item);    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Tahsin\TahsinCreated::class,
            'App\Listeners\Backend\Tahsin\TahsinEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Tahsin\TahsinUpdated::class,
            'App\Listeners\Backend\Tahsin\TahsinEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Tahsin\TahsinDeleted::class,
            'App\Listeners\Backend\Tahsin\TahsinEventListener@onDeleted'
        );
    }
}
