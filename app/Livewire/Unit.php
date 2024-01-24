<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Unit as UnitModel;

class Unit extends Component
{
    use WithPagination;

    public $name, $unitId, $modal = "";

    protected $rules = [
        'name' => 'required',
    ];

    public function handleResetModal()
    {
        $this->modal = "";
        $this->resetValidation();
        $this->reset(['name', 'unitId']);
    }

    public function render()
    {
        $units = UnitModel::latest()->paginate(5);
        return view('livewire.unit', compact('units'));
    }

    public function create()
    {
        $this->modal = "create";
        
    }


    public function store()
    {
        $this->validate();
        try {
            UnitModel::create([
                'name' => $this->name,
            ]);

            $this->handleResetModal();
            session()->flash('success', 'Unit Created Successfully!!');
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong!!');
        }
    }

    public function edit($id)
    {
        try {
            $unit = UnitModel::findOrFail($id);
            if (!$unit) {
                session()->flash('error', 'Unit not found');
            } else {
                $this->name = $unit->name;
                $this->unitId = $unit->id;
                $this->modal = 'edit';
            }
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong!!');
        }

    }

    public function update()
    {
        $this->validate();
        try {
            UnitModel::whereId($this->unitId)->update([
                'name' => $this->name,
            ]);
            session()->flash('success', 'Unit Updated Successfully!!');
            $this->handleResetModal();
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong!!');
        }
    }

    public function close()
    {
        $this->modal = "";
    }

    public function destroy($id)
    {
        try {
            UnitModel::find($id)->delete();
            session()->flash('success', "Unit Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
}
