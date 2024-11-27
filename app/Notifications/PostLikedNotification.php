<?php

namespace App\Notifications;

use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class PostLikedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(protected User $likedBy, protected Post $post)
    {
        //
    }

    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'user_name' => $this->likedBy->name,
            'text' => 'liked your post',
            'url' => route('posts.show', $this->post->id),
        ];
    }

    public function broadcastType(): string
    {
        return 'post.liked';
    }
}
