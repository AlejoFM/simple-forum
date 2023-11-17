<?php

namespace App\Http\Livewire;

use App\Models\Reply;
use App\Models\Thread;
use Livewire\Component;

class ShowThread extends Component
{
    Public Thread $thread;
    public $body = '';
    public function postReply(){
        //Se valida el body
        $this->validate(['body' => 'required']);
        // Se crea la respuesta.
        auth()->user()->replies()->create([
            'thread_id' => $this->thread->id,
            'body' => $this->body,
        ]);
    }
    public function render()
    {
        return view('livewire.show-thread', [
            'replies' => $this->thread
                ->replies()
                ->whereNull('reply_id')
                ->get()
        ]);
    }
}
