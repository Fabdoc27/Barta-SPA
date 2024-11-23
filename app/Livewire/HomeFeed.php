<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Home')]
class HomeFeed extends Component
{
    public $offset;
    public $limit = 10;
    public $posts;
    public $loadMore;
    public $userId;

    public function mount()
    {
        $this->loadMore = true;
        $this->offset = 0;
        $this->posts = collect();
        $this->loadPosts();
    }

    #[On('user-selected')]
    public function filterPostsByUser($userId)
    {
        $this->userId = $userId;
        $this->loadMore = true;
        $this->offset = 0;
        $this->posts = collect();
        $this->loadPosts();
    }

    public function loadPosts()
    {
        $query = Post::with('user')
            ->withCount(['likes', 'comments'])
            ->latest();

        if ($this->userId) {
            $query->where('user_id', $this->userId);
        }

        $newPosts = $query->offset($this->offset)->limit($this->limit)->get();

        if ($newPosts->count() < $this->limit) {
            $this->loadMore = false;
        }

        $this->posts = $this->posts->merge($newPosts);
        $this->offset += $this->limit;
    }

    public function render()
    {
        return view('livewire.home-feed', [
            'posts' => $this->posts,
        ]);
    }
}