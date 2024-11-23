<?php

namespace App\Livewire\Post;

use Livewire\Component;

class ShareButton extends Component
{
    public $post;
    public $postUrl;

    public function mount($post)
    {
        $this->post = $post;
        $this->postUrl = route('posts.show', $post);
    }

    public function render()
    {
        return view('livewire.post.share-button');
    }
}