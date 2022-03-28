<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Token;

class Tokens extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.tokens.view', [
            'tokens' => Token::oldest()
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

        Token::create([ 
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Token creado correctamente.');
    }

    public function edit($id)
    {
        $record = Token::findOrFail($id);

        $this->selected_id = $id; 
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
        ]);

        if ($this->selected_id) {
			$record = Token::find($this->selected_id);
            $record->update([ 
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Token actualizado correctamente.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Token::where('id', $id);
            $record->delete();
        }
    }
}