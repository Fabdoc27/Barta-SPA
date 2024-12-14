<?php

namespace App\Livewire\Comment;

use App\Models\Comment;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CommentEdit extends Component
{
    public $commentId;

    #[Validate('required|string|max:255')]
    public $content;

    public $isModalOpen = false;

    #[On('edit-comment')]
    public function openModal($commentId, $content)
    {
        $this->commentId = $commentId;
        $this->content = $content;
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->reset(['content', 'commentId']);
        $this->isModalOpen = false;
    }

    public function updateComment()
    {
        $comment = Comment::findOrFail($this->commentId);

        $this->authorize('update', $comment);

        $this->validate();

        $comment->update([
            'content' => $this->content,
        ]);

        $this->closeModal();

        session()->flash('message', 'Comment updated');

        return $this->redirectRoute('posts.show', ['post' => $this->post], navigate: true);
    }

    public function render()
    {
        return view('livewire.comment.comment-edit');
    }
}