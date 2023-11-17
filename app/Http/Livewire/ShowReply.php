<?php

namespace App\Http\Livewire;

use App\Models\Reply;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;


class ShowReply extends Component
{
    use AuthorizesRequests;

    public Reply $reply;
    public $body = '';
    protected $listeners = ['refresh' => '$refresh'];
    public $is_creating = false ;
    public $is_editing = false;
    public function postChild(){
        //Se valida el body
        $this->validate(['body' => 'required']);
        // Se crea la respuesta.
        auth()->user()->replies()->create([
            'reply_id' => $this->reply->id,
            'thread_id' => $this->reply->thread->id,
            'body' => $this->body,
        ]);
        // Se refresca
        $this->is_creating = false;
        $this->body = '';
        $this->emit('refresh');
    }

    public function updatedIsCreating(){
        $this->authorize('edit', $this->reply);
        $this->is_editing = false;

        $this->body = '';
    }
    public function updatedIsEditing(){
        $this->authorize('edit', $this->reply);

        $this->is_creating = false;

        $this->body = $this->reply->body;
    }
    public function editReply(){
        //validates
        $this->validate(['body' => 'required']);
        //refresh
        $this->reply->update([
            'body' => $this->body,
        ]);
        //send event refresh.
        $this->is_editing = false;
        $this->emit('refresh');
    }

    public function render()
    {
        return view('livewire.show-reply');
    }
}
