<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Candidate;

class Candidates extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $name, $surnames, $birth_date, $nationality, $email, $phone, $register_date, $user_account, $points, $description, $selected;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.candidates.view', [
            'candidates' => Candidate::oldest()
                        ->orWhere('name', 'LIKE', $keyWord)
                        ->orWhere('surnames', 'LIKE', $keyWord)
                        ->orWhere('birth_date', 'LIKE', $keyWord)
                        ->orWhere('nationality', 'LIKE', $keyWord)
                        ->orWhere('email', 'LIKE', $keyWord)
                        ->orWhere('phone', 'LIKE', $keyWord)
                        ->orWhere('register_date', 'LIKE', $keyWord)
                        ->orWhere('user_account', 'LIKE', $keyWord)
                        ->orWhere('points', 'LIKE', $keyWord)
                        ->orWhere('description', 'LIKE', $keyWord)
                        ->orWhere('selected', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
        $this->name = null;
        $this->surnames = null;
        $this->birth_date = null;
        $this->nationality = null;
        $this->email = null;
        $this->phone = null;
        $this->register_date = null;
        $this->user_account = null;
        $this->points = null;
        $this->description = null;
        $this->selected = null;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'surnames' => 'required',
            'birth_date' => 'required',
            'nationality' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'register_date' => 'required',
            'user_account' => 'required',
            'points' => 'required',
            'description' => 'required',
            'selected' => 'required'
        ]);

        Candidate::create([ 
            'name' => $this->name,
            'surnames' => $this->surnames,
            'birth_date' => $this->birth_date,
            'nationality' => $this->natiomality,
            'email' => $this->email,
            'phone' => $this->phone,
            'register_date' => $this->register_date,
            'user_account' => $this->user_account,
            'points' => $this->points,
            'description' => $this->description,
            'selected' => $this->selected
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Candidatura creada correctamente.');
    }

    public function edit($id)
    {
        $record = Candidate::findOrFail($id);

        $this->selected_id = $id;
        $this->name = $record->name;
        $this->surnames = $record->surnames;
        $this->birth_date = $record->birth_date;
        $this->natiomality = $record->natiomality;
        $this->email = $record->email;
        $this->phone = $record->phone;
        $this->register_date = $record->register_date;
        $this->user_account = $record->user_account;
        $this->points = $record->points;
        $this->description = $record->description;
        $this->selected = $record->selected;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'surnames' => 'required',
            'birth_date' => 'required',
            'nationality' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'register_date' => 'required',
            'user_account' => 'required',
            'points' => 'required',
            'description' => 'required',
            'selected' => 'required'
        ]);

        if ($this->selected_id) {
			$record = Candidate::find($this->selected_id);
            $record->update([ 
                'name' => $this->name,
                'surnames' => $this->surnames,
                'birth_date' => $this->birth_date,
                'nationality' => $this->natiomality,
                'email' => $this->email,
                'phone' => $this->phone,
                'register_date' => $this->register_date,
                'user_account' => $this->user_account,
                'points' => $this->points,
                'description' => $this->description,
                'selected' => $this->selected
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Candidatura actualizada correctamente.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Candidate::where('id', $id);
            $record->delete();
        }
    }
}
