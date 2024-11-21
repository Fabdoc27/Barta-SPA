<?php

namespace App\Livewire\Post;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Create Post')]
class PostCreate extends Component
{
    public function render()
    {
        return view('livewire.post.post-create', [
            'user' => auth()->user(),
        ]);
    }
}
