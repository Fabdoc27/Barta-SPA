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

    public function getListeners()
    {
        $authId = auth()->id();

        return [
            "echo-private:users.{$authId},post.liked" => 'newNotification',
            "echo-private:users.{$authId},post.commented" => 'newNotification',
        ];
    }

    public function fetchNotifications()
    {
        $user = auth()->user();

        if ($user) {
            $this->notifications = $user->notifications()->latest()->take(5)->get();
            $this->unreadCount = $user->unreadNotifications()->count();
        }
    }

    public function newNotification($notification)
    {
        $this->notifications->prepend($notification);
        $this->unreadCount++;
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
