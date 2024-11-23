<?php

namespace App\Livewire\Post;

use Livewire\Component;

class CommentButton extends Component
{
    public $count;
    public $post;

    public function render()
    {
        return view('livewire.post.comment-button');
    }
}
