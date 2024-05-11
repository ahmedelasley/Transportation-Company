<?php
 
namespace App\Livewire\Forms;
 
use Carbon\Carbon;
use Livewire\Form;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use LivewireUI\Modal\ModalComponent;

use Spatie\Permission\Models\Role; // Don't forget to import the Role model
use Spatie\Permission\Models\Permission;

class RoleForm extends Form
{
    // public $editMode = false;

    public ?Role $role;

    public $ids;
    public $permissions = array([]);

    #[Validate('required|string|unique:roles,name,')]
    public $name;


    public function setData($id)
    {
        $roleItem             = Role::findOrFail($id);
 
        $this->ids            = $roleItem->id;
        $this->name           = $roleItem->name;
        $this->permissions    = $roleItem->permissions->pluck('id')->toArray();

    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function closeForm()
    {
        $this->resetValidation();
        $this->reset();
    }

    public function store()
    {

        // $this->editMode = false;

        // Check of Validation
         $validatedData       = $this->validate();

        // Query Update
        $role = Role::create([
            'name' => $validatedData['name'],
        ]);

        $permissions = Permission::find($this->permissions);

        $role->syncPermissions($permissions);
        //Reset 
        $this->resetValidation();
        $this->reset(); 
    }

    public function update()
    {

        // $this->editMode = true;

        // Check of Validation
        $validatedData = $this->validate([
            'name' => 'required|string|unique:roles,name,'.$this->ids,
        ]);

        // Query Update
        $role = Role::find($this->ids)->update([
            'name' => $validatedData['name'],
        ]);

        $permissions = Permission::find($this->permissions);
        $role->syncPermissions($permissions);
        //Reset 
        $this->resetValidation();
        $this->reset(); 
    }

    public function delete()
    {
        Role::find($this->ids)->delete();
    }

    public function assignPermissions()
    {
        $role = Role::find($this->ids);
        $permissions = Permission::find($this->permissions);

        $role->syncPermissions($permissions);
        //Reset 
        $this->resetValidation();
        $this->reset(); 
    }


}