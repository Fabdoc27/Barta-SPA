<?php

namespace App\Livewire\Auth;

use App\Livewire\GuestComponent;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

#[Title('Registration')]
class RegisterUser extends GuestComponent
{
    #[Validate('required|string')]
    public $name;

    #[Validate('required|string|unique:users,username')]
    public $username;

    #[Validate('required|email|unique:users,email')]
    public $email;

    #[Validate('required|confirmed|min:6')]
    public $password;

    public $password_confirmation;

    public function register()
    {
        try {
            $validated = $this->validate();

            $user = User::create($validated);

            Auth::login($user);

            session()->flash('message', 'You have successfully registered');

            return $this->redirectRoute('home', navigate: true);
        } catch (ValidationException) {
            $this->reset('password', 'password_confirmation');
        }
    }

    public function render()
    {
        return view('livewire.auth.register-user');
    }
}
