<?php
 
namespace App\Livewire\Forms;
 
use Livewire\Attributes\Validate;
use Illuminate\Validation\Rule;
use App\Models\Setting;
use Livewire\Form;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Auth;

class SettingForm extends Form
{
    // public $editMode = false;

    public ?Setting $setting;

    public $ids;

    #[Validate('nullable|string|min:3')]
    public $name;
    #[Validate('nullable|url:http,https')]
    public $link;
    
    #[Validate('nullable|integer|in:0,1,2,3,4')]
    public $price;
    
    #[Validate('nullable|regex:/^01[0125][0-9]{8}$/|min:10')]
    public $phone;
    
    #[Validate('nullable|email')]
    public $email;

    #[Validate('nullable|string')]
    public $address;




    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function closeForm()
    {
        $this->resetValidation();
        $this->reset();
    }


    public function update($id, $field)
    {

        // Check of Validation
        $validatedData       = $this->validate();

        // Query Update
        Setting::where('id', $id)->update([
            'value' => $validatedData[$field],
            'updated_id' => Auth::user()->id,
        ]);

        //Reset 
        $this->resetValidation();
        $this->reset(); 
    }

}