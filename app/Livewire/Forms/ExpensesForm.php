<?php
 
namespace App\Livewire\Forms;
 
use Livewire\Attributes\Validate;
use Illuminate\Validation\Rule;
use App\Models\Expenses;
use Livewire\Form;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Auth;

class ExpensesForm extends Form
{
    // public $editMode = false;

    public ?Expenses $expenses;

    public $ids;

    #[Validate('required|string')]
    public $name              = '';
    
        #[Validate('required|numeric|decimal:0,4|gt:0')]
    public $amount              = '';

    #[Validate('nullable|string')]
    public $description           = '';

    #[Validate('required|exists:categories,id')]
    public $category_id         = '';

    #[Validate('required|exists:statuses,id')]
    public $status_id         = '';

    public function setData($id)
    {
        $expensesItem             = Expenses::findOrFail($id);
 
        $this->ids            = $expensesItem->id;
        $this->name           = $expensesItem->name;
        $this->amount           = $expensesItem->amount;
        $this->description           = $expensesItem->description;
        $this->category_id      = $expensesItem->category_id;
        $this->status_id      = $expensesItem->status_id;
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
        Expenses::create([
            'name' => $validatedData['name'],
            'amount' => $validatedData['amount'],
            'description' => $validatedData['description'],
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
            'name' => 'required|string',
            'amount' => 'required|numeric|decimal:0,4|gt:0',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'status_id' => 'required|exists:statuses,id',
        ]);

        // Query Update
        Expenses::find($this->ids)->update([
            'name' => $validatedData['name'],
            'amount' => $validatedData['amount'],
            'description' => $validatedData['description'],
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
        Expenses::find($this->ids)->delete();
    }
}