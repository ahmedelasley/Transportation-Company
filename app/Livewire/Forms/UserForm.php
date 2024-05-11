<?php
 
namespace App\Livewire\Forms;
 
use Carbon\Carbon;
use Livewire\Form;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Hash;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role; // Don't forget to import the Role model

class UserForm extends Form
{
    // public $editMode = false;

    public ?User $user;

    public $ids;

    public $password;
    public $password_confirmation;

    
    #[Validate('required|string|unique:users,name,')]
    public $name;

    #[Validate('required|email|unique:users,email,')]
    public $email;

    #[Validate('required')]
    public $roles;

    public function rules()
    {
        return [
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->letters()->mixedCase()->numbers()->symbols(),
            ],
            // 'roles' => 'required',

        ];
    }
    // Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised(),

    public function setData($id)
    {
        $userItem             = User::findOrFail($id);
 
        $this->ids            = $userItem->id;
        $this->name           = $userItem->name;
        $this->email          = $userItem->email;

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
        $userR = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'] ,
            'password' => Hash::make($validatedData['password']) ,
        ]);
        // $userC->syncRole($this->roles);


        //Reset 
        $this->resetValidation();
        $this->reset(); 
    }

    public function update()
    {

        // $this->editMode = true;

        // Check of Validation
        $validatedData = $this->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$this->ids,
            // 'password' => [
            //     'required',
            //     'confirmed',
            //     Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised(),
            // ],
        ]);

        // Query Update
        User::find($this->ids)->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'] ,
            // 'password' => Hash::make($validatedData['password']) ,
        ]);

        //Reset 
        $this->resetValidation();
        $this->reset(); 
    }

    public function delete()
    {
        User::find($this->ids)->delete();
    }
    
    public function assignRole()
    {
        $user = User::find($this->ids);
        $role = Role::find($this->roles);

        $user->syncRoles($role);
        //Reset 
        $this->resetValidation();
        $this->reset(); 
    }
    
    public function passwordChange()
    {

        // $this->editMode = true;

        // Check of Validation
        $validatedData = $this->validate([
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->letters()->mixedCase()->numbers()->symbols(),
            ],
        ]);

        // Query Update
        User::find($this->ids)->update([
            'password' => Hash::make($validatedData['password']) ,
        ]);

        //Reset 
        $this->resetValidation();
        $this->reset(); 
    }
}