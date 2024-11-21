<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Post Details')]
class PostShow extends Component
{
    public $post;

    public function mount($post)
    {
        $this->post = Post::find($post);
    }

    public function render()
    {
        return view('livewire.post.post-show');
    }
}
