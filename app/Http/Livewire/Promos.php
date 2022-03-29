<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

use App\Models\Promo;
use App\Models\School;

class Promos extends Component
{
    use WithPagination;
    use WithFileUploads;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $school_id, $name, $ubication, $start_date, $duration, $url, $image, $code;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';

        return view('livewire.promos.view', [
            'promos' => Promo::with('school')
                        ->orWhere('school_id', 'LIKE', $keyWord)
                        ->orWhere('name', 'LIKE', $keyWord)
                        ->orWhere('ubication', 'LIKE', $keyWord)
                        ->orWhere('start_date', 'LIKE', $keyWord)
                        ->orWhere('duration', 'LIKE', $keyWord)
                        ->orWhere('image', 'LIKE', $keyWord)
                        ->orWhere('url', 'LIKE', $keyWord)
                        ->orWhere('code', 'LIKE', $keyWord)
						->paginate(10),
            'schools' => School::all()
        ]);


        // $schools = School::all();
        // $promos = Promo::with('school')->get();
        // return view('livewire.promos.view', compact('promos', 'schools'));

        
        // return view('livewire.promos.view', [
        //     'promos' => Promo::oldest()
        //                 ->orWhere('school_id', 'LIKE', $keyWord)
        //                 ->orWhere('name', 'LIKE', $keyWord)
        //                 ->orWhere('ubication', 'LIKE', $keyWord)
        //                 ->orWhere('start_date', 'LIKE', $keyWord)
        //                 ->orWhere('duration', 'LIKE', $keyWord)
        //                 ->orWhere('image', 'LIKE', $keyWord)
        //                 ->orWhere('url', 'LIKE', $keyWord)
        //                 ->orWhere('code', 'LIKE', $keyWord)
		// 				->paginate(10),
        //     'schools' => School::all()
        // ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {	
        $this->school_id = null;
        $this->name = null;	
        $this->ubication = null;
        $this->start_date = null;
        $this->duration = null;
        $this->image = null;
        $this->url = null;
        $this->code = null;
    }

    public function store()
    {
        $this->validate([
            'school_id' => 'required|not_in:0',
            'name' => 'required',
            'ubication' => 'required',
            'start_date' => 'required',
            'duration' => 'required',
            'image' => 'image|max:1024', // 1MB Max
            'url' => 'required',
            'code' => 'required'
        ]);

        Promo::create([ 
            'school_id' => $this->school_id,
            'name' => $this->name,
            'ubication' => $this->ubication,
            'start_date' => $this->start_date,
            'duration' => $this->duration,
            'image' => $this->image->store('uploads', 'public'),
            'url' => $this->url,
            'code' => $this->code
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Promo creada correctamente.');
    }

    public function edit($id)
    {
        $record = Promo::findOrFail($id);

        $this->selected_id = $id; 
        $this->school_id = $record->school_id;
        $this->name = $record->name;
        $this->ubication = $record->ubication;
        $this->start_date = $record->start_date;
        $this->duration = $record->duration;
        $this->image = $record->image;
        $this->url = $record->url;
        $this->code = $record->code;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'school_id' => 'required|not_in:0',
            'name' => 'required',
            'ubication' => 'required',
            'start_date' => 'required',
            'duration' => 'required',
            'image' => 'image|max:1024', // 1MB Max
            'url' => 'required',
            'code' => 'required'
        ]);

        if ($this->selected_id) {
			$record = Promo::find($this->selected_id);
            $record->update([
                'school_id' => $this->school_id,
                'name' => $this->name,
                'ubication' => $this->ubication,
                'start_date' => $this->start_date,
                'duration' => $this->duration,
                'image' => $this->image->store('uploads', 'public'),
                'url' => $this->url,
                'code' => $this->code 
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Promo actualizada correctamente.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Promo::where('id', $id);
            $record->delete();
        }
    }
}