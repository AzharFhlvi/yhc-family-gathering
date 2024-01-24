<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Attendance as AttendanceModel;
use App\Models\Employee;



class Attendance extends Component
{
    use WithPagination;
    
    public $query = "";

    public function render()
    {
        if (!empty($this->query)) {
            $this->attendances = AttendanceModel::whereHasMorph('attendant', [Employee::class], function ($query) {
                $query->where('name', 'like', '%' . $this->query . '%');
            })->with(['attendant', 'attendant.families'])->paginate(5);
        } else {
            $this->attendances = [];
        }

        $attendances = $this->attendances;
        $total_ticket = AttendanceModel::where('status', 'checked')->count();
        return view('livewire.attendance', compact(['attendances', 'total_ticket']));
    }

    public function checkEmployee($id)
    {
        $attendance = AttendanceModel::where('attendant_id', $id)->where('attendant_type', 'App\Models\Employee')->first();
        if ($attendance->status == 'unchecked') {
            if ($attendance->attendant->height >= 100) {
                $attendance->update([
                    'status' => 'checked'
                ]);
            } else {
                $attendance->update([
                    'status' => 'checked-kid'
                ]);
            }
        } else {
            $attendance->update([
                'status' => 'unchecked'
            ]);
        }
    }

    public function checkFamily($id)
    {
        $attendance = AttendanceModel::where('attendant_id', $id)->where('attendant_type', 'App\Models\Family')->first();
        if ($attendance->status == 'unchecked') {
            if ($attendance->attendant->height >= 100) {
                $attendance->update([
                    'status' => 'checked'
                ]);
            } else {
                $attendance->update([
                    'status' => 'checked-kid'
                ]);
            }
        } else {
            $attendance->update([
                'status' => 'unchecked'
            ]);
        }
    }

    public function checkAll($id)
    {
        $attendance = AttendanceModel::where('attendant_id', $id)->where('attendant_type', 'App\Models\Employee')
            ->with(['attendant', 'attendant.families'])->first();
        if ($attendance->status == 'unchecked') {
            if ($attendance->attendant->height >= 100) {
                $attendance->update([
                    'status' => 'checked'
                ]);
            } else {
                $attendance->update([
                    'status' => 'checked-kid'
                ]);
            }
            foreach ($attendance->attendant->families as $family) {
                if ($family->height >= 100) {
                    $family->attendance->update([
                        'status' => 'checked'
                    ]);
                } else {
                    $family->attendance->update([
                        'status' => 'checked-kid'
                    ]);
                }
            }
        } else {
            $attendance->update([
                'status' => 'unchecked'
            ]);
            foreach ($attendance->attendant->families as $family) {
                $family->attendance->update([
                    'status' => 'unchecked'
                ]);
            }
        }
        
    }
}
