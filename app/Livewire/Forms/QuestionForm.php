<?php
 
namespace App\Livewire\Forms;
 
use Livewire\Attributes\Validate;
use Illuminate\Validation\Rule;
use App\Models\Question;
use Livewire\Form;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Auth;

class QuestionForm extends Form
{
    // public $editMode = false;

    public ?Question $question;

    public $ids;

    #[Validate('required|string|min:3|unique:questions,name,')]
    public $name              = '';
    
    #[Validate('required|exists:categories,id')]
    public $category_id         = '';

    #[Validate('required|exists:statuses,id')]
    public $status_id         = '';

    public function setData($id)
    {
        $questionItem             = Question::findOrFail($id);
 
        $this->ids            = $questionItem->id;
        $this->name           = $questionItem->name;
        $this->category_id      = $questionItem->category_id;
        $this->status_id      = $questionItem->status_id;
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
        Question::create([
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
            'name' => 'required|string|unique:questions,name,'.$this->ids,
            'category_id' => 'required|exists:categories,id',
            'status_id' => 'required|exists:statuses,id',
        ]);

        // Query Update
        Question::find($this->ids)->update([
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
        Question::find($this->ids)->delete();
    }
}