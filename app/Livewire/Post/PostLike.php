<?php

namespace App\Livewire\Post;

use App\Models\Post;
use App\Notifications\PostLikedNotification;
use Livewire\Component;

class PostLike extends Component
{
    public $post;
    public $isLiked;
    public $likesCount;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->isLiked = $post->likes()->where('user_id', auth()->id())->exists();
        $this->likesCount = $post->likes()->count();
    }

    public function toggleLike()
    {
        if ( ! auth()->check()) {
            return redirect()->route('login');
        }

        if ($this->isLiked) {
            // Unlike the post
            $this->post->likes()->where('user_id', auth()->id())->delete();
            $this->isLiked = false;
            $this->likesCount--;
        } else {
            // Like the post
            $this->post->likes()->create(['user_id' => auth()->id()]);
            $this->isLiked = true;
            $this->likesCount++;

            // Notify the post owner
            if ($this->post->user_id !== auth()->id()) {
                $this->post->user->notify(new PostLikedNotification(auth()->user(), $this->post));
            }
        }
    }

    public function render()
    {
        return view('livewire.post.post-like');
    }
}