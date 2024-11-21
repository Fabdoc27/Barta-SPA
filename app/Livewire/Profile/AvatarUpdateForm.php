<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class AvatarUpdateForm extends Component
{
    use WithFileUploads;

    public User $user;

    #[Validate('required|max:1024|mimetypes:image/jpeg,image/png,image/jpg')]
    public $avatar;

    public $existingAvatar;

    public function mount()
    {
        $this->existingAvatar = $this->user->get_avatar;
    }

    public function uploadAvatar()
    {
        $this->validate();

        $user = $this->user;

        if ($user->avatar_url) {
            Storage::disk('public')->delete($user->avatar_url);
        }

        $user->update([
            'avatar_url' => $this->avatar->storePublicly('avatars', ['disk' => 'public']),
        ]);

        session()->flash('message', 'Profile avatar updated successfully');

        return $this->redirectRoute('profile.edit', ['user' => $this->user], navigate: true);
    }

    public function deleteAvatar()
    {
        $user = $this->user;

        if ($user->avatar_url) {
            Storage::disk('public')->delete($user->avatar_url);
        }

        $user->update([
            'avatar_url' => null,
        ]);

        session()->flash('message', 'Profile avatar deleted successfully');

        return $this->redirectRoute('profile.edit', ['user' => $this->user], navigate: true);
    }

    public function render()
    {
        return view('livewire.profile.avatar-update-form');
    }
}
