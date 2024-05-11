<?php
 
namespace App\Livewire\Forms;
 
use Livewire\Attributes\Validate;
use Illuminate\Validation\Rule;
use App\Models\Category;
use Livewire\Form;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Auth;

class CategoryForm extends Form
{
    public ?Category $category;

    public $ids;

    #[Validate('required|string|min:3|unique:categories,name,')]
    public $name              = '';
 
    #[Validate('required|string|min:3')]
    public $description       = '';
    
    #[Validate('required')]
    public $parent_id         = '';

    public function setData($id)
    {
        $categoryItem         = Category::findOrFail($id);
 
        $this->ids            = $categoryItem->id;
        $this->name           = $categoryItem->name;
        $this->description    = $categoryItem->description;
        $this->parent_id      = $categoryItem->parent_id;
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

        // Query Create
         Category::create([
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
            'name' => 'required|string|unique:categories,name,'.$this->ids,
            'description' => 'nullable|string|max:100',
            'parent_id' => 'required',
        ]);

        // Query Update
        Category::find($this->ids)->update([
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
        Category::find($this->ids)->delete();
    }
}