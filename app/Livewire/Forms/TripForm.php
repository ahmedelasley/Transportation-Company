<?php
 
namespace App\Livewire\Forms;
 
use Livewire\Form;
use App\Models\Trip;
use App\Models\Client;
use App\Models\Company;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class TripForm extends Form
{
    // public $editMode = false;

    public ?Trip $trip;

    public $ids;



    public $clientOrCompany;
    public $clientOrCompanyPhone= "";
    public $clientOrCompanyEmail= "";
    public $clientOrCompanyAddress= "";
    // public $company_name     = "";
    public $fromAea     = "";
    public $toAea     = "";
    public $vehicle_name     = "";
    public $category_name   = "";
    public $status_name     = "";
    public $created_by      = "";
    public $created_at      = "";
    public $updated_by      = "";
    public $updated_at      = "";

    // #[Validate('required|numeric|unique:trips,code,')]
    public $code;


    #[Validate('required|decimal:0,4')]
    public $service_cost    = 0;

    #[Validate('required|decimal:0,4')]
    public $wait_cost       = 0;

    #[Validate('required|decimal:0,4')]
    public $paid            = 0;

    #[Validate('required|date')]
    public $desrved_date    = '';


    #[Validate('required|in:One Way,Round Trip,Wait|min:1')]
    public $direction       = '';
    
    #[Validate('required|exists:areas,id', as: 'Area From')]
    public $from_area;

    #[Validate('required|exists:areas,id', as: 'Area to')]
    public $to_area;

    #[Validate('nullable|exists:clients,id')]
    public $client_id       =  NULL;


    #[Validate('nullable|exists:companies,id')]
    public $company_id      = NULL;

    #[Validate('required|exists:vehicles,id')]
    public $vehicle_id;

    #[Validate('required|exists:categories,id')]
    public $category_id;

    #[Validate('nullable|string')]
    public $reason_cancel   = '';


    #[Validate('nullable|string')]
    public $notes           = '';

    #[Validate('required|date')]
    public $date            = '';

    #[Validate('required|exists:statuses,id')]
    public $status_id;


    public function setData($id)
    {
        $tripItem             = Trip::find($id);
 
        $this->ids            = $tripItem->id;
        $this->code           = $tripItem->code;
        $this->service_cost   = $tripItem->service_cost;
        $this->wait_cost      = $tripItem->wait_cost;
        $this->paid           = $tripItem->paid;
        $this->desrved_date   = $tripItem->desrved_date;
        $this->direction      = $tripItem->direction;
        $this->from_area      = $tripItem->from_area;
        $this->to_area        = $tripItem->to_area;

        $this->client_id      = $tripItem->client_id;
        $this->company_id     = $tripItem->company_id;
        $this->vehicle_id     = $tripItem->vehicle_id;
        $this->category_id    = $tripItem->category_id;
        $this->reason_cancel  = $tripItem->reason_cancel;
        $this->notes          = $tripItem->notes;
        $this->date           = $tripItem->date;
        $this->status_id      = $tripItem->status_id;
        
        $this->clientOrCompany    = $tripItem->client != NULL? $tripItem->client->name : $tripItem->company->name ;
        $this->clientOrCompanyPhone    = $tripItem->client != NULL? $tripItem->client->phone_number  : '' ;
        $this->clientOrCompanyEmail    = $tripItem->client != NULL? $tripItem->client->email  : '' ;
        $this->clientOrCompanyAddress    = $tripItem->client != NULL? $tripItem->client->address  : '' ;
        // $this->company_name   = $tripItem->company !=NULL ?? $tripItem->company->name;

        $this->fromAea     = $tripItem->fromArea->name;
        $this->toAea     = $tripItem->toArea->name;
        $this->vehicle_name   = $tripItem->vehicle->name;

        $this->category_name  = $tripItem->category->name;
        $this->status_name    = $tripItem->status->name;
        $this->created_by     = $tripItem->createdBy->name;
        $this->created_at     = $tripItem->created_at->toDayDateTimeString();
        $this->updated_by     = $tripItem->updatedBy != NULL ? $tripItem->updatedBy->name : '';
        $this->updated_at     = $tripItem->updatedBy != NULL ? $tripItem->updated_at->toDayDateTimeString() : '';

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
        Trip::create([
            'code' => Trip::count() == 0 ? 100001 : Trip::latest()->first()->code + 1,
            'service_cost' => $validatedData['service_cost'],
            'wait_cost' => $validatedData['wait_cost'],
            'paid' => $validatedData['paid'],
            'desrved_date' => $validatedData['desrved_date'],
            'direction' => $validatedData['direction'],
            'from_area' => $validatedData['from_area'],
            'to_area' => $validatedData['to_area'],
            'client_id' => $validatedData['client_id'] == NULL ? NULL : $validatedData['client_id'],
            'company_id' => $validatedData['company_id'] == NULL ? NULL : $validatedData['company_id'],
            'vehicle_id' => $validatedData['vehicle_id'],
            'reason_cancel' => $validatedData['reason_cancel'],

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
            'code' => 'required|string|unique:trips,code,'.$this->ids,
            'service_cost'=> 'required|decimal:0,4',
            'wait_cost'=> 'required|decimal:0,4',
            'paid'=> 'required|decimal:0,4',
            'desrved_date'=> 'required|date',
            'direction'=> 'required|in:One Way,Round Trip,Wait|min:1',
            'from_area'=> 'required|exists:areas,id',
            'to_area'=> 'required|exists:areas,id',
            'client_id'=> 'nullable|exists:clients,id',
            'company_id'=> 'nullable|exists:companies,id',
            'vehicle_id'=> 'required|exists:vehicles,id',
            'reason_cancel'=> 'nullable|string',

            'category_id' => 'required|exists:categories,id',
            'notes'=> 'nullable|string',
            'date'=> 'required|date',
            'status_id' => 'required|exists:statuses,id',
        ]);

        // Query Update
        Trip::find($this->ids)->update([
            'code' => $validatedData['code'],
            'service_cost' => $validatedData['service_cost'],
            'wait_cost' => $validatedData['wait_cost'],
            'paid' => $validatedData['paid'],
            'desrved_date' => $validatedData['desrved_date'],
            'direction' => $validatedData['direction'],
            'from_area' => $validatedData['from_area'],
            'to_area' => $validatedData['to_area'],
            'client_id' => $validatedData['client_id'] == NULL ? NULL : $validatedData['client_id'],
            'company_id' => $validatedData['company_id'] == NULL ? NULL : $validatedData['company_id'],
            'vehicle_id' => $validatedData['vehicle_id'],
            'reason_cancel' => $validatedData['reason_cancel'],

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
        Trip::find($this->ids)->delete();
    }
}