<?php

namespace App\Livewire\Settings;
use App\Models\Setting;

use Livewire\Component;
use Livewire\WithPagination;
use App\Jobs\BackupDatabaseJob;
use App\Livewire\Forms\SettingForm;
use Illuminate\Support\Facades\Artisan;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ShowSettings extends Component
{
    
    use WithPagination, LivewireAlert;
    protected $paginationTheme = 'bootstrap';
   

    public SettingForm $form;


    public $titlePage = 'Settings';

    public $paginateCount = 10;
    public $sortBy = 'id';
    public $orderBy ='ASC';
    public $searchTerm='';

    public $name, $description, $parent_id;

    public function orderByFunction($orderBy)
    {
        $this->orderBy = $orderBy;
    }

    public function resetPage()
    {
        $this->paginateCount = 10;
        $this->sortBy = 'id';
        $this->orderBy ='ASC';
        $this->searchTerm='';
        
        $this->reset(['name', 'description','parent_id']);
        $this->resetValidation();
    }


    public function close()
    {
        $this->form->closeForm();
        $this->dispatch('close-modal');
    }

    public function getForm($id)
    {
        $this->form->setData($id);
    }

    public function update($id, $field)
    {      
        // Update on Database
        $this->form->update($id, $field);


        // Alert
        $this->alert('success', __('Done Updated Data Successfully'), [
            'position' => 'top-start',
            'timer' => 4000,
            'toast' => true,
            'timerProgressBar' => true,
        ]);
    }

    public function backup()
    {      
        // Update on Database
        // $this->form->update($id, $field);
        try {
            // Artisan::call('backup:run --only-db');
            dispatch(new BackupDatabaseJob());
            // Alert
            $this->alert('success', __('Done Backup Data Successfully'), [
                'position' => 'top-start',
                'timer' => 4000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
        } catch (\Throwable $th) {
            // Alert
            $this->alert('success', __('Done Backup Data Faild'), [
                'position' => 'top-start',
                'timer' => 4000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
        }
    }


    public function render()
    {

        $setting = Setting::get();

        return view('livewire.settings.show-settings',[
            'setting'=> $setting,
        ]);
    }
}
