<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SearchBar extends Component
{
    #[Validate('required')]
    public $word = '';

    public $results = [];

    public function updatedWord($value)
    {
        $this->reset('results');

        $this->validate();

        $search = "%{$value}%";

        $this->results = User::where('name', 'LIKE', $search)
            ->orWhere('username', 'LIKE', $search)
            ->orWhere('email', 'LIKE', $search)
            ->limit(10)
            ->get();
    }

    // event to get user Id
    public function selectUser($userId)
    {
        $this->dispatch('user-selected', userId: $userId);
    }

    #[On('clear-results')]
    public function clear()
    {
        $this->reset('word', 'results');
    }

    public function render()
    {
        return view('livewire.search-bar');
    }
}