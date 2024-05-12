<?php
 
namespace App\Livewire\Forms;
 
use Carbon\Carbon;
use Livewire\Form;
use App\Models\Client;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class ClientForm extends Form
{
    // public $editMode = false;

    public ?Client $client;

    public $clientItem = [];
    public $ids;

    public $created_by = "";
    public $created_at = "";

public $phones = [];

    #[Validate('required|string')]
    public $name              = '';
    
    #[Validate('required|regex:/^01[0125][0-9]{8}$/|min:10|unique:clients,phone,')]
    public $phone             = '';
    
    #[Validate('required|email|unique:clients,email,')]
    public $email              = '';

    #[Validate('nullable|string')]
    public $address              = '';

    #[Validate('nullable|string')]
    public $notes              = '';

    #[Validate('required|date')]
    public $date              = '';


    public function setData($id)
    {
        $clientItem             = Client::findOrFail($id);
 
        $this->ids            = $clientItem->id;
        $this->name           = $clientItem->name;
        $this->phone          = $clientItem->phone;
        $this->email          = $clientItem->email;
        $this->address        = $clientItem->address;
        $this->notes          = $clientItem->notes;
        $this->date           = $clientItem->date;

        $this->created_by      = $clientItem->createdBy->name;
        $this->created_at      = $clientItem->created_at->toDayDateTimeString();

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
        Client::create([
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'] ,
            'email' => $validatedData['email'] ,
            'address' => $validatedData['address'] ,
            'notes' => $validatedData['notes'] ,
            'date' => $validatedData['date'] ,
            'created_id' => Auth::user()->id,
        ]);

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
            'phone' => 'required|regex:/^01[0125][0-9]{8}$/|min:10|unique:clients,phone,'.$this->ids,
            'email' => 'required|email|unique:clients,email,'.$this->ids,
            'address' => 'nullable|string',
            'notes' => 'nullable|string',
            'date' => 'required|date',
        ]);

        // Query Update
        Client::find($this->ids)->update([
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'] ,
            'email' => $validatedData['email'] ,
            'address' => $validatedData['address'] ,
            'notes' => $validatedData['notes'] ,
            'date' => $validatedData['date'] ,
            'updated_id' => Auth::user()->id,
        ]);

        //Reset 
        $this->resetValidation();
        $this->reset(); 
    }

    public function delete()
    {
        Client::find($this->ids)->delete();
    }
    
}