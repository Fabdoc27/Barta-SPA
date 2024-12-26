<?php

namespace App\Livewire\Comment;

use Livewire\Component;

class CommentList extends Component
{
    public $post;
    public $comments;
    public $offset;
    public $limit = 20;
    public $loadMore;

    public function mount($post)
    {
        $this->post = $post;
        $this->comments = collect();
        $this->offset = 0;
        $this->loadMore = true;
        $this->loadComments();
    }

    public function loadComments()
    {
        $newComments = $this->post->comments()
            ->with('user')
            ->latest()
            ->offset($this->offset)
            ->limit($this->limit)
            ->get();

        if ($newComments->count() < $this->limit) {
            $this->loadMore = false;
        }

        $this->comments = $this->comments->merge($newComments);
        $this->offset += $this->limit;
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
