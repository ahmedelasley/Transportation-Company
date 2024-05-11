<?php
 
namespace App\Livewire\Forms;
 
use Livewire\Attributes\Validate;
use Illuminate\Validation\Rule;
use App\Models\Status;
use Livewire\Form;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Auth;

class StatusForm extends Form
{
    public ?Status $status;

    public $ids;

    #[Validate('required|string|min:3|unique:statuses,name,')]
    public $name              = '';
 
    #[Validate('required|string|min:3')]
    public $description       = '';
    
    #[Validate('required')]
    public $parent_id         = '';

    public function setData($id)
    {
        $statusItem             = Status::findOrFail($id);
 
        $this->ids            = $statusItem->id;
        $this->name           = $statusItem->name;
        $this->description    = $statusItem->description;
        $this->parent_id      = $statusItem->parent_id;
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
        // Check of Validation
         $validatedData       = $this->validate();

        // Query Update
        status::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'parent_id' => $validatedData['parent_id'] == 0 ? NULL : $validatedData['parent_id'],
            'created_id' => Auth::user()->id,
        ]);

        //Reset 
        $this->resetValidation();
        $this->reset(); 
    }

    public function update()
    {
        // Check of Validation
        $validatedData = $this->validate([
            'name' => 'required|string|unique:statuses,name,'.$this->ids,
            'description' => 'nullable|string|max:100',
            'parent_id' => 'required',

        ]);

        // Query Update
        Status::find($this->ids)->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'parent_id' => $validatedData['parent_id'] == 0 ? NULL : $validatedData['parent_id'],
            'updated_id' => Auth::user()->id,
        ]);

        //Reset 
        $this->resetValidation();
        $this->reset(); 
    }

    public function delete()
    {
        Status::find($this->ids)->delete();
    }
}