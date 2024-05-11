<?php
 
namespace App\Livewire\Forms;
 
use Carbon\Carbon;
use Livewire\Form;
use App\Models\Phone;
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

public $area_name = "";
public $social_name = "";
public $category_name = "";
public $status_name = "";
public $created_by = "";
public $created_at = "";

public $phones = [];

    #[Validate('required|string')]
    public $name              = '';
    
    #[Validate('required|regex:/^01[0125][0-9]{8}$/|min:10|unique:clients,phone_number,')]
    public $phone_number             = '';
    
    #[Validate('required|email|unique:clients,email,')]
    public $email              = '';

    #[Validate('nullable|string')]
    public $address              = '';

    #[Validate('required|exists:areas,id')]
    public $area_id         = '';

    #[Validate('required|exists:socials,id')]
    public $social_id         = '';

    #[Validate('nullable|string')]
    public $notes              = '';

    #[Validate('required|date')]
    public $date              = '';

    #[Validate('required|exists:categories,id')]
    public $category_id         = '';

    #[Validate('required|exists:statuses,id')]
    public $status_id         = '';


    #[Validate('required|regex:/^01[0125][0-9]{8}$/|min:10|unique:phones,phone,')]
    public $phone             = '';

    public function setData($id)
    {
        $clientItem             = Client::findOrFail($id);
 
        $this->ids            = $clientItem->id;
        $this->name           = $clientItem->name;
        $this->phone_number   = $clientItem->phone_number;
        $this->email          = $clientItem->email;
        $this->address        = $clientItem->address;
        $this->area_id        = $clientItem->area_id;
        $this->social_id      = $clientItem->social_id;
        $this->category_id    = $clientItem->category_id;
        $this->notes          = $clientItem->notes;
        $this->date           = $clientItem->date;
        $this->status_id      = $clientItem->status_id;

        $this->area_name        = $clientItem->area->name;
        $this->social_name      = $clientItem->social->name;
        $this->category_name    = $clientItem->category->name;
        $this->status_name      = $clientItem->status->name;
        $this->created_by      = $clientItem->createdBy->name;
        $this->created_at      = $clientItem->created_at->toDayDateTimeString();

        $this->phones           = Phone::where('client_id', $id)->get();
    }

    public function setDataInside($id)
    {
        $phoneItem             = Phone::findOrFail($id);
        $this->ids            = $phoneItem->id;
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
            'phone_number' => $validatedData['phone_number'] ,
            'email' => $validatedData['email'] ,
            'address' => $validatedData['address'] ,
            'area_id' => $validatedData['area_id'] ,
            'social_id' => $validatedData['social_id'] ,
            'category_id' => $validatedData['category_id'] ,
            'notes' => $validatedData['notes'] ,
            'date' => $validatedData['date'] ,
            'status_id' => $validatedData['status_id'] ,
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
            'phone_number' => 'required|regex:/^01[0125][0-9]{8}$/|min:10|unique:clients,phone_number,'.$this->ids,
            'email' => 'required|email|unique:clients,email,'.$this->ids,
            'address' => 'nullable|string',
            'area_id' => 'required|exists:areas,id',
            'social_id' => 'required|exists:socials,id',
            'category_id' => 'required|exists:categories,id',
            'notes' => 'nullable|string',
            'date' => 'required|date',
            'status_id' => 'required|exists:statuses,id',
        ]);

        // Query Update
        Client::find($this->ids)->update([
            'name' => $validatedData['name'],
            'phone_number' => $validatedData['phone_number'] ,
            'email' => $validatedData['email'] ,
            'address' => $validatedData['address'] ,
            'area_id' => $validatedData['area_id'] ,
            'social_id' => $validatedData['social_id'] ,
            'category_id' => $validatedData['category_id'] ,
            'notes' => $validatedData['notes'] ,
            'date' => $validatedData['date'] ,
            'status_id' => $validatedData['status_id'] ,
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
    
    public function storePhone()
    {
        // Check of Validation
        $validatedData = $this->validate([
            'phone' => 'required|regex:/^01[0125][0-9]{8}$/|min:10|unique:phones,phone,',
            'category_id' => 'required|exists:categories,id',
        ]);
        // Query Update
        Phone::create([
            'client_id' => $this->ids,
            'phone' => $validatedData['phone'] ,
            'category_id' => $validatedData['category_id'] ,
            'created_id' => Auth::user()->id,
        ]);

        //Reset 
        $this->resetValidation();
        $this->reset(); 
    }

    public function deletePhone()
    {
        // dd($this->ids);
        Phone::find($this->ids)->delete();
    }
}