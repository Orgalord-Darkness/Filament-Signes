<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Signalement ; 
use Illuminate\Support\Facades\Auth;

class FormulaireSignalement extends Component
{
    public $form ; 
    public $record;

    public function mount()
    {
      $draft = Signalement::where('user_id', Auth::user()->id)->where('is_draft', true)->first(); 
      if($draft){
        $this->form->fill($draft->toArray()) ; 
      }    
    }

    public function render()
    {
        return view('livewire.formulaire-signalement');
    }
    public function saveDraft()
    {
        $data = $this->form->getState();
        $data['is_draft'] = true;
        if ($this->record) {
            $this->record->update($data);
        } else {
            $this->record = Signalement::create($data);
        }
    }

    // public function saveDraft()
    // {
    //     $data = $this->form->getState();
    //     $data['complet'] = false;
    //     $this->record = Signalement::updateOrCreate(['user_id' => Auth::id()], $data);
    // }

    public function submitForm()
    {
        $this->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'fonction_id' => 'required', 
            'etablissement_id' => 'required', 
            'secteur_id' => 'required', 
            'commune_id' => 'required', 
            // autres règles de validation
        ]);

        $data = $this->form->getState();
        $data['is_draft'] = false;
        $this->record->update($data);
    }
}
