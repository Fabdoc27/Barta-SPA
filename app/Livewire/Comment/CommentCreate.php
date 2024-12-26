<?php

namespace App\Livewire\Comment;

use App\Models\Post;
use App\Notifications\PostCommentNotification;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CommentCreate extends Component
{
    public Post $post;
    #[Validate('required|string|max:255')]
    public $comment;

    public function save()
    {
        $this->validate();

        $comment = $this->post->comments()->create([
            'content' => $this->comment,
            'user_id' => auth()->id(),
        ]);

        // Notify post owner
        if ($this->post->user_id !== auth()->id()) {
            $this->post->user->notify(new PostCommentNotification(request()->user(), $this->post, $comment));
        }

        $this->reset('comment');

        session()->flash('message', 'Comment added');

        return $this->redirectRoute('posts.show', ['post' => $this->post], navigate: true);
    }

    public function render()
    {
        return view('livewire.comment.comment-create');
    }
}