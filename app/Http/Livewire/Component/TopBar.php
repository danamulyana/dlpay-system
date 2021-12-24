<?php

namespace App\Http\Livewire\Component;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TopBar extends Component
{
    // protected $listeners = ['markNotificationAsRead'];

    public function markNotificationAsRead($id){
        auth()->user()->unreadNotifications->where('id', $id)->markAsRead();
    }


    public function render()
    {
        $notifications = [];
        if (Auth::check()) {
            $notifications = auth()->user()->unreadNotifications;
        }

        return view('livewire.component.top-bar',[
            'notifications' => $notifications,
        ]);
    }
}
