<?php

namespace App\Livewire;

use Livewire\Component;

class NotificationDropdown extends Component
{
    public $notifications = [];
    public $unreadCount = 0;

    public function mount()
    {
        $this->fetchNotifications();
    }

    public function fetchNotifications()
    {
        $user = auth()->user();

        if ($user) {
            $this->notifications = $user->notifications()->latest()->take(5)->get();
            $this->unreadCount = $user->unreadNotifications()->count();
        }
    }

    public function markAllAsRead()
    {
        $user = auth()->user();

        if ($user) {
            $user->unreadNotifications->markAsRead();
            $this->fetchNotifications();
        }
    }

    public function render()
    {
        return view('livewire.notification-dropdown');
    }
}