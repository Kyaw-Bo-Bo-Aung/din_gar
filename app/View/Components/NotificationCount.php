<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NotificationCount extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $unread_noti_count = 0;
        $user = auth()->guard('web')->user();
        if (auth()->guard('web')->check()) {
            $unread_noti_count = $user->unreadNotifications()->count();
        }
        return view('components.notification-count', compact('unread_noti_count'));
    }
}
