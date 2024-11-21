<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class SinglePost extends Component
{
    public $post;

    public function delete(Post $post)
    {
        $this->authorize('delete', $post);

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        session()->flash('message', 'Post deleted');

        $this->redirectRoute('home', navigate: true);
    }

    public function render()
    {
        return view('livewire.post.single-post', [
            'post' => $this->post,
        ]);
    }
}
