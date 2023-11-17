<div>
    <div class="rounded-md bg-gradient-to-r from-slate-800 to-slate-900 hover:to-slate-800 mb-4">
        <div class="p-4 flex gap-4">
            <div>
                <img src="{{ $reply->user->avatar() }}" alt="{{ $reply->user->name }}" class="rounded-md">
            </div>
            <div class="w-full">

                <p class="mb-2 text-blue-600 font-semibold text-xs">
                    {{ $reply->user->name }}
                </p>
                @if($is_editing == true)
                    <form wire:submit.prevent="editReply" class="mt-4">
                        <input type="text" placeholder="Escribe una respuesta"
                               class="mb-4 bg-slate-800 border-1 border-y-slate-900 rounded-md w-full p-3 text-white/60 text-xs"
                               wire:model="body">
                    </form>
                @else
                <p class="text-white/60 text-xs">
                    {{ $reply->body }}
                </p>
                @endif
                @if($is_creating == true)
                    <form wire:submit.prevent="postChild" class="mt-4">
                        <input type="text" placeholder="Escribe una respuesta"
                               class="mb-4 bg-slate-800 border-1 border-y-slate-900 rounded-md w-full p-3 text-white/60 text-xs"
                               wire:model="body">
                    </form>
                @endif
                <p class="mt-4 text-white/60 text-xs flex gap-2 justify-end">
                    <a href="#" wire:click.prevents="$toggle('is_creating')" class="hover:text-white">Responder</a>
                    @can('edit', $reply)
                    <a href="#" wire:click.prevents="$toggle('is_editing')" class="hover:text-white">Editar</a>
                    @endcan
                </p>
            </div>
        </div>
    </div>
    @foreach($reply->replies as $item)
        <div class="ml-8">
            @livewire('show-reply', ['reply' => $item], key('reply-'.$item->id))
        </div>
    @endforeach
</div>
