<?php

namespace App\Livewire\Comment;

use Livewire\Component;

class CommentList extends Component
{
    public $post;
    public $comments;

    public function mount($post)
    {
        $this->post = $post;
        $this->loadComments();
    }

    public function loadComments()
    {
        $this->comments = $this->post->comments()->with('user')->latest()->get();
    }

    public function commentEditModal($commentId, $content)
    {
        $this->dispatch('edit-comment', $commentId, $content);
    }

    public function deleteComment($commentId)
    {
        $comment = $this->post->comments()->findOrFail($commentId);

        $this->authorize('delete', $comment);

        $comment->delete();

        $this->loadComments();

        session()->flash('message', 'Comment deleted');

        return $this->redirectRoute('posts.show', ['post' => $this->post], navigate: true);
    }

    public function render()
    {
        return view('livewire.comment.comment-list');
    }
}
