<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use App\Invite;


class InvitationForm extends Component
{
    public $property_ids;
    public $invitation_type;
    public $cleaner_name;
    public $details;
    public $invitation_message;
    public $properties;
    public $prop_ids;
    public $invitation_code;


    protected $listeners = ['add_array'];

    public function add_array($array)
    {
        $this->prop_ids = $array;
    }

    public function render()
    {
        return view('livewire.invitation-form');
    }
    public function mount($properties)
    {
        $this->properties = $properties;
        $this->cleaner_name = '';
    }


    public function submit()
    {
        $validator = $this->validate([
            'prop_ids' => 'required|array|min:1',
            'invitation_type' => 'required',
            'cleaner_name' => 'required',
            'details' => 'required',
        ]);
            $invitation_code = mt_rand(100000, 999999);
            $data = new  Invite;
            $data->property_ids = json_encode($this->prop_ids);
            $data->invitation_type = $this->invitation_type;
            $data->cleaner_name = $this->cleaner_name;
            $data->details = $this->details;
            $data->invitation_code = $invitation_code;
            $data->invitation_message = $this->invitation_message;
            $data->save();
            if($data->invitation_type)
            {
                $this->emit('success', "Invitation send successfully!");
                $this->reset('property_ids', 'invitation_type', 'cleaner_name', 'details','invitation_message');
            }
            else{
                $this->emit('error', "Invitation send successfully!");
            }
            // Invite::create([ 'invitation_type' => $this->invitation_type , 'cleaner_name' => $this->cleaner_name , 'details' => $this->details , 'invitation_message' => $this->invitation_message]);
      
    }
}
