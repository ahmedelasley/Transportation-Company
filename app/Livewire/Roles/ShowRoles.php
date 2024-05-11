<?php

namespace App\Livewire\Roles;


use Livewire\Component;
use Livewire\WithPagination;
use App\Livewire\Forms\RoleForm;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ShowRoles extends Component
{
    
    use WithPagination, LivewireAlert;
    protected $paginationTheme = 'bootstrap';
   

    public RoleForm $form;
    public $editMode = false;


    public $titlePage = 'Roles';

    public $paginateCount = 20;
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

    
    public function assignPermissions()
    {      

        // $this->editMode = false;

        // Store on Database
        $this->form->assignPermissions();

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


    #[On('refresh-list')]
    public function refresh() {}

    public function render()
    {
        // $roles = Role::pluck('name','id')->all();
        $permissions = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$this->form->ids)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        $roles = Role::withCount('permissions')
                                ->where(function($query) {
                                    $query->where('name', 'LIKE', '%' . $this->searchTerm .'%');
                                    // ->orWhere('email', 'LIKE', '%' . $this->searchTerm .'%');
                                })
                                ->orderBy($this->sortBy, $this->orderBy)
                                ->paginate($this->paginateCount);

        return view('livewire.roles.show-roles',[
            'permissions'=> $permissions,
            'rolePermissions'=> $rolePermissions,
            'roles'=> $roles,
        ]);
    }
}
