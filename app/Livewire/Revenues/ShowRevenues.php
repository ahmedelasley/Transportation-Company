<?php

namespace App\Livewire\Revenues;
use App\Models\Status;

use Livewire\Component;
use App\Models\Category;
use App\Models\Trip;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ShowRevenues extends Component
{
    
    use WithPagination, LivewireAlert;
    protected $paginationTheme = 'bootstrap';
   
    public $titlePage = 'Revenues';

    public $paginateCount = 10;
    public $sortBy = 'id';
    public $orderBy ='ASC';
    public $searchTerm='';

    public $name, $category_id, $status_id;

    public function orderByFunction($orderBy)
    {
        $this->orderBy = $orderBy;
    }

    public function resetPage()
    {
        $this->paginateCount = 10;
        $this->sortBy = 'id';
        $this->orderBy ='ASC';
        $this->searchTerm='';
        
        $this->reset(['name', 'category_id','status_id']);
        $this->resetValidation();
    }
    public function mount()
    {
        $this->dispatch('refresh-list');
    }
    public function updated()
    {
        $this->dispatch('refresh-list');
    }


    #[On('refresh-list')]
    public function refresh() {}

    public function render()
    {
        $categories = Category::select('id', 'name')->get();
        $statuses = Status::select('id', 'name')->get();
        $revenues = Trip::with(['createdBy', 'updatedBy', 'category', 'status'])
                        // ->select('id', 'name', 'description', 'parent_id', 'created_id', 'updated_id')
                        ->where(function($query) {
                            $query->where('code', 'LIKE', '%' . $this->searchTerm .'%');
                            // ->orWhere('description', 'LIKE', '%' . $this->searchTerm .'%');
                        })
                        ->orderBy($this->sortBy, $this->orderBy)
                        ->paginate($this->paginateCount);

        return view('livewire.revenues.show-revenues',[
            'categories'=> $categories,
            'statuses'=> $statuses,
            'revenues'=> $revenues,
        ]);
    }
}
