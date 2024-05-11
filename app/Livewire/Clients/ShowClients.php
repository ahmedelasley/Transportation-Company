<?php

namespace App\Livewire\Clients;
use App\Models\Area;

use App\Models\Client;
use App\Models\Social;
use App\Models\Status;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use App\Livewire\Forms\ClientForm;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ShowClients extends Component
{
    
    use WithPagination, LivewireAlert;
    protected $paginationTheme = 'bootstrap';
   

    public ClientForm $form;
    public $editMode = false;


    public $titlePage = 'Clients';

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

    public function getFormInside($id)
    {
        $this->form->setDataInside($id);
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

    
    public function savePhone()
    {      

        // $this->editMode = false;

        // Store on Database
        $this->form->storePhone();

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

    public function deletePhone()
    {
        // Delete on Database
        $this->form->deletePhone();

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
        $areas = Area::select('id', 'name')->get();
        $socials = Social::select('id', 'name')->get();
        $categories = Category::select('id', 'name')->where('parent_id', 1)->get();
        $categoriesPhones = Category::select('id', 'name')->where('parent_id', 10)->get();
        $statuses = Status::select('id', 'name')->where('parent_id', 1)->get();
        $clients = Client::with(['createdBy', 'updatedBy', 'category', 'status'])
                                // ->select('id', 'name', 'description', 'parent_id', 'created_id', 'updated_id')
                                ->where(function($query) {
                                    $query->where('name', 'LIKE', '%' . $this->searchTerm .'%');
                                    // ->orWhere('description', 'LIKE', '%' . $this->searchTerm .'%');
                                })
                                ->orderBy($this->sortBy, $this->orderBy)
                                ->paginate($this->paginateCount);

        return view('livewire.clients.show-clients',[
            'areas'=> $areas,
            'socials'=> $socials,
            'categories'=> $categories,
            'categoriesPhones'=> $categoriesPhones,
            'statuses'=> $statuses,
            'clients'=> $clients,
        ]);
    }
}
