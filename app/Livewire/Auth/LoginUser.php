<?php

namespace App\Livewire\Auth;

use App\Livewire\GuestComponent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

#[Title('Sine-In')]
class LoginUser extends GuestComponent
{
    #[Validate('required|email|exists:users,email')]
    public $email;

    #[Validate('required')]
    public $password;

    public $remember = false;

    public function login()
    {
        $credentials = $this->validate();

        if (! Auth::attempt($credentials, $this->remember)) {
            throw ValidationException::withMessages([
                'email' => 'Sorry, those credentials do not match',
            ]);
        }

        session()->regenerate();
        session()->flash('message', 'Login successfully');

        $this->redirectIntended(navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.login-user');
    }
}
