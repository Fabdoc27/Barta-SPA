<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Post Details')]
class PostShow extends Component
{
    public $post;

    public function mount($post)
    {
        $this->loadPost($post);
    }

    public function loadPost($post)
    {
        $this->post = Post::find($post)
            ->load(['user', 'comments.user'])
            ->loadCount('comments');
    }

    #[On('comment-added')]
    #[On('comment-deleted')]
    public function refreshPostDetails($postId)
    {
        if ($this->post->id === $postId) {
            $this->loadPost($this->post->id);
        }
    }

    public function render()
    {
        return view('livewire.post.post-show');
    }
}