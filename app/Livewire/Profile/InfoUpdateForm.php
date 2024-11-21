<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;

class InfoUpdateForm extends Component
{
    public User $user;
    public $name;
    public $username;
    public $password;
    public $password_confirmation;
    public $bio;

    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'username' => ['required', 'string', 'max:30',
                Rule::unique('users', 'username')->ignore($this->user->id),
            ],
            'password' => ['nullable', 'confirmed', 'min:6'],
            'bio' => ['required', 'string'],
        ];
    }

    public function mount($user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->username = $user->username;
        $this->bio = $user->bio;
    }

    public function updateProfile()
    {
        $validated = $this->validate();

        if (empty($this->password)) {
            unset($validated['password']);
        }

        $this->user->update($validated);

        session()->flash('message', 'Profile details updated successfully');

        return $this->redirectRoute('profile.edit', ['user' => $this->user], navigate: true);
    }

    public function render()
    {
        return view('livewire.profile.info-update-form');
    }
}
