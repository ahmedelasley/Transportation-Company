<?php

namespace App\Livewire\Statuses;
use App\Livewire\Forms\AreaForm;

use Livewire\Component;
use App\Models\Status;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ShowStatuses extends Component
{
    
    use WithPagination, LivewireAlert;
    protected $paginationTheme = 'bootstrap';
   

    public AreaForm $form;


    public $titlePage = 'Statuses';

    public $paginateCount = 10;
    public $sortBy = 'id';
    public $orderBy ='ASC';
    public $searchTerm='';

    public $name, $description, $parent_id;

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
        
        $this->reset(['name', 'description','parent_id']);
        $this->resetValidation();
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
        // Store on Database
        $this->form->store();

        // Close Modal
        $this->dispatch('close-modal');

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
        // Update on Database
        $this->form->update();

        // Close Modal
        $this->dispatch('close-modal');

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

        // Alert
        $this->alert('success', __('Done Deleted Data Successfully'), [
            'position' => 'top-start',
            'timer' => 4000,
            'toast' => true,
            'timerProgressBar' => true,
        ]);
    }

    public function render()
    {
        $statuses = Status::with(['createdBy', 'updatedBy', 'children', 'parent'])
                                // ->select('id', 'name', 'description', 'parent_id', 'created_id', 'updated_id')
                                ->where(function($query) {
                                    $query->where('name', 'LIKE', '%' . $this->searchTerm .'%')
                                    ->orWhere('description', 'LIKE', '%' . $this->searchTerm .'%');
                                })
                                ->orderBy($this->sortBy, $this->orderBy)
                                ->paginate($this->paginateCount);

        return view('livewire.statuses.show-statuses',[
            'statuses'=> $statuses,
        ]);
    }
}
