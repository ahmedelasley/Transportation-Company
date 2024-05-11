<?php
 
namespace App\Livewire\Forms;
 
use Livewire\Attributes\Validate;
use Illuminate\Validation\Rule;
use App\Models\Company;
use Livewire\Form;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Auth;

class CompanyForm extends Form
{
    // public $editMode = false;

    public ?Company $company;

    public $ids;

    #[Validate('required|string|min:3|unique:companies,name,')]
    public $name              = '';
    
    
    #[Validate('required|decimal:0,4|gte:0|lte:100')]
    public $percent              = '';

    #[Validate('required|exists:categories,id')]
    public $category_id         = '';

    #[Validate('required|exists:statuses,id')]
    public $status_id         = '';

    public function setData($id)
    {
        $companyItem             = Company::findOrFail($id);
 
        $this->ids            = $companyItem->id;
        $this->name           = $companyItem->name;
        $this->percent           = $companyItem->percent;
        $this->category_id      = $companyItem->category_id;
        $this->status_id      = $companyItem->status_id;
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
        Company::create([
            'name' => $validatedData['name'],
            'percent' => $validatedData['percent'],
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
            'name' => 'required|string|unique:companies,name,'.$this->ids,
            'percent' => 'required|decimal:0,4|gte:0|lte:100',
            'category_id' => 'required|exists:categories,id',
            'status_id' => 'required|exists:statuses,id',
        ]);

        // Query Update
        Company::find($this->ids)->update([
            'name' => $validatedData['name'],
            'percent' => $validatedData['percent'],
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
        Company::find($this->ids)->delete();
    }
}