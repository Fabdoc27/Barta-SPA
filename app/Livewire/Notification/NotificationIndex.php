<?php

namespace App\Livewire\Notification;

use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

#[Title('Notifications')]
class NotificationIndex extends Component
{
    use WithPagination, WithoutUrlPagination;

    public function mount()
    {
        auth()->user()->unreadNotifications->markAsRead();
    }

    public function render()
    {
        return view('livewire.notification.notification-index', [
            'notifications' => auth()->user()->notifications()->latest()->paginate(10),
        ]);
    }
}