<?php

namespace App\Http\Livewire;

use App\Models\Thread;
use Livewire\Component;
use App\Models\Category;

class ShowThreads extends Component
{
    public $search = '';
    public $categories = '';


    public function filter($categories)
    {
        $this->categories = $categories;
    }

    public function render()
    {
        $category = Category::get();

        $threads = Thread::query();
        if ($this->categories) {
            $threads->where('category_id', $this->categories);
        }
        $threads->where('title', 'like', "%$this->search%");
        $threads->withCount('replies');
        $threads->latest();
        return view('livewire.show-threads', [
            'category' => $category,
            'threads' => $threads->paginate(),
        ]);
    }
}
