<?php
 
namespace App\Livewire\Forms;
 
use Livewire\Attributes\Validate;
use Illuminate\Validation\Rule;
use App\Models\Area;
use Livewire\Form;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Auth;

class AreaForm extends Form
{
    public ?Area $area;

    public $ids;

    #[Validate('required|string|min:3|unique:areas,name,')]
    public $name              = '';
 
    #[Validate('required|string|min:3')]
    public $description       = '';
    
    #[Validate('required')]
    public $parent_id         = '';

    public function setData($id)
    {
        $areaItem             = Area::findOrFail($id);
 
        $this->ids            = $areaItem->id;
        $this->name           = $areaItem->name;
        $this->description    = $areaItem->description;
        $this->parent_id      = $areaItem->parent_id;
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
        Area::create([
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
            'name' => 'required|string|unique:areas,name,'.$this->ids,
            'description' => 'nullable|string|max:100',
            'parent_id' => 'required',

        ]);

        // Query Update
        Area::find($this->ids)->update([
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
        Area::find($this->ids)->delete();
    }
}