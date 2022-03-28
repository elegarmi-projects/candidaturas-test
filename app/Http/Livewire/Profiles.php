<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Profile;

class Profiles extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.profiles.view', [
            'profiles' => Profile::oldest()
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
    }

    public function store()
    {
        $this->validate([
        ]);

        Profile::create([ 
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Perfil creado correctamente.');
    }

    public function edit($id)
    {
        $record = Profile::findOrFail($id);

        $this->selected_id = $id; 
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
        ]);

        if ($this->selected_id) {
			$record = Profile::find($this->selected_id);
            $record->update([ 
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Perfil actualizado correctamente.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Profile::where('id', $id);
            $record->delete();
        }
    }
}
