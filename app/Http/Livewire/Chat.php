<?php

namespace App\Http\Livewire;

use App\Models\Message;
use Livewire\Component;

class Chat extends Component
{
    public $messageText;

    public function render()
    {
        $messages = Message::latest()->take(5)->get();

        return view('livewire.chat', compact('messages'));
    }

    public function sendMessage()
    {
        Message::create([
            'email' => auth()->user()->email,
            'message_text' => $this->messageText,
        ]);

        $this->reset('messageText');
    }
}
