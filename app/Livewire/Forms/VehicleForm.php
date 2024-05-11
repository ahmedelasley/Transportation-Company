<?php
 
namespace App\Livewire\Forms;
 
use Livewire\Attributes\Validate;
use Illuminate\Validation\Rule;
use App\Models\Vehicle;
use Livewire\Form;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Auth;

class VehicleForm extends Form
{
    // public $editMode = false;

    public ?Vehicle $vehicle;

    public $ids;

    #[Validate('required|string|min:3|unique:vehicles,name,')]
    public $name              = '';
    
    #[Validate('required|exists:categories,id')]
    public $category_id         = '';

    #[Validate('required|exists:statuses,id')]
    public $status_id         = '';

    public function setData($id)
    {
        $vehicleItem             = Vehicle::findOrFail($id);
 
        $this->ids            = $vehicleItem->id;
        $this->name           = $vehicleItem->name;
        $this->category_id      = $vehicleItem->category_id;
        $this->status_id      = $vehicleItem->status_id;
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
        Vehicle::create([
            'name' => $validatedData['name'],
            'category_id' => $validatedData['category_id'] ,
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
            'name' => 'required|string|unique:vehicles,name,'.$this->ids,
            'category_id' => 'required|exists:categories,id',
            'status_id' => 'required|exists:statuses,id',
        ]);

        // Query Update
        Vehicle::find($this->ids)->update([
            'name' => $validatedData['name'],
            'category_id' => $validatedData['category_id'] ,
            'status_id' => $validatedData['status_id'] ,
            'updated_id' => Auth::user()->id,
        ]);

        //Reset 
        $this->resetValidation();
        $this->reset(); 
    }

    public function delete()
    {
        Vehicle::find($this->ids)->delete();
    }
}