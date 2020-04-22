<?php

namespace App\Listeners\Frontend\Amalan;

/**
 * Class AmalanEventListener.
 */
class AmalanEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        $user    = auth()->user()->name;

        $newitem = $event->amalan->title;

        \Log::info('User ' . $user . ' has created item ' . $newitem);
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        $user           = auth()->user()->name;

        $updated_item   = $event->amalan->title;

        \Log::info('User ' . $user . ' has updated item ' . $updated_item);
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        $user           = auth()->user()->name;

        $deleted_item   = $event->amalan->title;

        \Log::info('User ' . $user . ' has deleted item ' . $deleted_item);    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Amalan\AmalanCreated::class,
            'App\Listeners\Backend\Amalan\AmalanEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Amalan\AmalanUpdated::class,
            'App\Listeners\Backend\Amalan\AmalanEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Amalan\AmalanDeleted::class,
            'App\Listeners\Backend\Amalan\AmalanEventListener@onDeleted'
        );
    }
}
