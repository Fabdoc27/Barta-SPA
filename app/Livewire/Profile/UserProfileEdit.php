<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Edit Profile')]
class UserProfileEdit extends Component
{
    public User $user;

    public function mount($user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.profile.user-profile-edit');
    }
}
