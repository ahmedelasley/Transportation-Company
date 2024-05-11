<?php

namespace App\Livewire\Vehicles;
use App\Models\Status;

use Livewire\Component;
use App\Models\Category;
use App\Models\Vehicle;
use Livewire\WithPagination;
use App\Livewire\Forms\VehicleForm;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ShowVehicles extends Component
{
    
    use WithPagination, LivewireAlert;
    protected $paginationTheme = 'bootstrap';
   

    public VehicleForm $form;
    public $editMode = false;


    public $titlePage = 'Vehicles';

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


    public function close()
    {
        $this->form->closeForm();
        $this->dispatch('close-modal');
    }

    public function getForm($id)
    {
        $this->form->setData($id);
    }

    public function save()
    {      

        $this->editMode = false;

        // Store on Database
        $this->form->store();

        // Close Modal
        $this->dispatch('close-modal');
        $this->dispatch('refresh-list');

        // Alert 
        $this->alert('success', __('Done Added Data Successfully'), [
            'position' => 'top-start',
            'timer' => 4000,
            'toast' => true,
            'timerProgressBar' => true,
        ]);
    }

    public function update()
    {      

        $this->editMode = true;

        // Update on Database
        $this->form->update();

        // Close Modal
        $this->dispatch('close-modal');
        $this->dispatch('refresh-list');

        // Alert
        $this->alert('success', __('Done Updated Data Successfully'), [
            'position' => 'top-start',
            'timer' => 4000,
            'toast' => true,
            'timerProgressBar' => true,
        ]);
    }

    public function delete()
    {
        // Delete on Database
        $this->form->delete();

        // Close Modal
        $this->dispatch('close-modal');
        $this->dispatch('refresh-list');

        // Alert
        $this->alert('success', __('Done Deleted Data Successfully'), [
            'position' => 'top-start',
            'timer' => 4000,
            'toast' => true,
            'timerProgressBar' => true,
        ]);
    }

    #[On('refresh-list')]
    public function refresh() {}

    public function render()
    {
        $categories = Category::select('id', 'name')->get();
        $statuses = Status::select('id', 'name')->get();
        $vehicles = Vehicle::with(['createdBy', 'updatedBy', 'category', 'status'])
                                // ->select('id', 'name', 'description', 'parent_id', 'created_id', 'updated_id')
                                ->where(function($query) {
                                    $query->where('name', 'LIKE', '%' . $this->searchTerm .'%');
                                    // ->orWhere('description', 'LIKE', '%' . $this->searchTerm .'%');
                                })
                                ->orderBy($this->sortBy, $this->orderBy)
                                ->paginate($this->paginateCount);

        return view('livewire.vehicles.show-vehicles',[
            'categories'=> $categories,
            'statuses'=> $statuses,
            'vehicles'=> $vehicles,
        ]);
    }
}
