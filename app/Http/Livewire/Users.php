<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Users extends Component
{
    public function addUsers()
    {
        //validate input

        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'user_type' => 'required',
            'password' => 'required|min:6',
        ]);

        //create user

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'user_type' => $this->user_type,
            'password' => Hash::make($this->password),
        ]);


    }


    // public function render()
    // {
    //     return view('livewire.users');
    // }
}
