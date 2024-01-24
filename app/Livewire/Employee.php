<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Validator;
use App\Models\Employee as EmployeeModel;
use App\Models\Attendance;
use App\Models\Unit;
use App\Models\Family;

class Employee extends Component
{
    use WithPagination;

    public $unitId, $unitName, $name, $height, $position, $employeeId, $relation, $familyId;
    public $modal = "", $query = "";
    public $families = [];


    protected function rules()
    {
        return [
            'unitId' => 'required',
            'name' => 'required',
            'height' => 'required',
            'position' => 'required',
        ];
    }

    public function handleResetModal()
    {
        $this->modal = "";
        $this->resetValidation();
        $this->reset([
            'unitId',
            'name',
            'height',
            'position',
            'employeeId',
            'relation',
            'families',
        ]);
    }

    public function render()
    {
        if (!empty($this->query)) {
            $this->employees = EmployeeModel::where('name', 'like', '%' . $this->query . '%')->paginate(5);
        } else {
            $this->employees = [];
        }

        if ($this->modal == 'create' || $this->modal == 'edit') {
            $this->units = Unit::all(['id', 'name']);
        } else {
            $this->units = [];
        }

        $employees = $this->employees;
        $units = $this->units;

        return view('livewire.employee', compact(['employees', 'units']));
    }

    public function create()
    {
        $this->modal = "create";
    }

    public function createFamily($id)
    {
        $this->handleResetModal();
        $this->modal = "createFamily";
        $this->employeeId = $id;
    }

    public function store()
    {
        $this->validate();
        try {
            $employee = EmployeeModel::create([
                'unit_id' => $this->unitId,
                'name' => $this->name,
                'height' => $this->height,
                'position' => $this->position,
            ]);

            Attendance::create([
                'attendant_id' => $employee->id,
                'attendant_type' => 'App\Models\Employee',
                'status' => 'off',
            ]);

            $this->handleResetModal();
            session()->flash('success', 'Employee Created Successfully!!');
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong!!');
        }
    }

    public function storeFamily()
    {
        $this->validate([
            'name' => 'required',
            'height' => 'required',
            'relation' => 'required',
        ]);

        try {
            $family = Family::create([
                'employee_id' =>$this->employeeId,
                'name' => $this->name,
                'height' => $this->height,
                'relation' => $this->relation,
            ]);

            Attendance::create([
                'attendant_id' => $family->id,
                'attendant_type' => 'App\Models\Family',
                'status' => 'off',
            ]);


            $this->handleResetModal();
            session()->flash('success', 'Family Created Successfully!!');
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong!!');
        }
    }

    public function show($id)
    {
        try {
            $employee = EmployeeModel::findOrFail($id);
            if (!$employee) {
                session()->flash('error', 'Employee not found');
            } else {
                $this->modal = 'show';
                $this->name = $employee->name;
                $this->unitName = $employee->unit_name;
                $this->position = $employee->position;
                $this->height = $employee->height;
                $this->employeeId = $employee->id;
                $this->families = $employee->families;
            }
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong!!');
        }
    }

    public function edit($id)
    {
        try {
            $employee = EmployeeModel::findOrFail($id);
            if (!$employee) {
                session()->flash('error', 'Employee not found');
            } else {
                $this->name = $employee->name;
                $this->unitId = $employee->unit_id;
                $this->position = $employee->position;
                $this->height = $employee->height;
                $this->employeeId = $employee->id;
                $this->modal = 'edit';
            }
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong!!');
        }
    }

    public function editFamily($id)
    {
        // dd($family);
        try {
            $family = Family::findOrFail($id);
            if (!$family) {
                session()->flash('error', 'Family not found');
            } else {
                $this->name = $family->name;
                $this->relation = $family->relation;
                $this->height = $family->height;
                $this->familyId = $family->id;
                $this->modal = 'editFamily';
            }
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong!!');
        }
    }

    public function update()
    {
        $this->validate();
        try {
            EmployeeModel::whereId($this->employeeId)->update([
                'name' => $this->name,
                'unit_id' => $this->unitId,
                'position' => $this->position,
                'height' => $this->height,
            ]);
            session()->flash('success', 'Employee Updated Successfully!!');
            $this->handleResetModal();
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong!!');
        }
    }
    
    public function updateFamily($id)
    {
        $this->validate([
            'name' => 'required',
            'height' => 'required',
            'relation' => 'required',
        ]);

        try {
            Family::whereId($id)->update([
                'employee_id' =>$this->employeeId,
                'name' => $this->name,
                'height' => $this->height,
                'relation' => $this->relation,
            ]);

            $this->handleResetModal();
            session()->flash('success', 'Family Updated Successfully!!');
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong!!');
        }
    }

    public function close()
    {
        $this->handleResetModal();
    }

    public function destroy($id)
    {
        try {
            $employee = EmployeeModel::find($id);
            foreach ($employee->families as $family) {
                $family->attendances()->delete();
            }
            $employee->attendances()->delete();
            $employee->families()->delete();
            $employee->delete();


            $this->handleResetModal();
            session()->flash('success', "Employee and Family Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }

    public function destroyFamily($id)
    {
        try {
            $family = Family::find($id);
            $family->attendances()->delete();
            $family->delete();
            $this->handleResetModal();
            session()->flash('success', "Family Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
}
