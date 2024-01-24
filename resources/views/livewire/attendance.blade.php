<div class="py-12">
    <div class="col-md-12 mb-2 mx-4">
        @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
        @endif

        @if(session()->has('error'))
        <div class="alert alert-danger" role="alert">
            {{ session()->get('error') }}
        </div>
        @endif
    </div>

    <div class="page-header d-print-none mx-4">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Dashboard
                    </div>
                    <h2 class="page-title">
                        Absensi Family Gathering | Total tiket : {{$total_ticket}}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <form method="get">
                            <input class="border-solid border border-gray-300 p-2 w-full md:w-1/4" type="text"
                                placeholder="Search Attendances" wire:model.live="query" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-xl mt-4">
        <div class="card">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-vcenter">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Unit</th>
                                <th class="w-1"></th>
                                <th>Nama</th>
                                <th class="w-1"></th>
                                <th>Anggota Keluarga</th>
                                <th>Jumlah Tiket</th>
                                <th>Tinggi</th>
                                <th>Hadir Semua</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($query == "")
                            <tr class="text-gray-500 text-sm">
                                <td colspan="9">
                                    Masukkan nama untuk mencari karyawan.
                                </td>
                            </tr>
                            @else
                            @if($attendances->isEmpty())
                            <tr class="text-gray-500 text-sm">
                                <td colspan="9">
                                    Tidak ditemukan hasil yang cocok.
                                </td>
                            </tr>
                            @else
                            @forelse ($attendances as $attendance)
                            @php
                                $ticket = 0;
                                if ($attendance->status == 'unchecked') {
                                    $checked = '';
                                } else {
                                    $checked = 'checked';
                                }
                                $attendance->status == 'checked' ? $ticket++ :$ticket;
                                if ($attendance->attendant->families->isNotEmpty()) {
                                    foreach ($attendance->attendant->families as $family) {
                                        if ($family->attendance->status == 'checked') {
                                            $ticket++;
                                        }
                                    }
                                }
                                if ($attendance->attendant->families->isNotEmpty()) {
                                    $checkedAll = 'checked';
                                    foreach ($attendance->attendant->families as $family) {
                                        if ($family->attendance->status == 'unchecked') {
                                            $checkedAll = '';
                                        }
                                    }
                                } else {
                                    if ($attendance->status == 'unchecked') {
                                        $checkedAll = '';
                                    } else {
                                        $checkedAll = 'checked';
                                    }
                                }
                            @endphp
                            <tr>
                                <td>{{ ($attendances->currentPage() - 1) * $attendances->perPage() + $loop->iteration }}
                                </td>
                                <td>{{ $attendance->attendant->unit->name }}</td>
                                <td>
                                    <input type="checkbox" {{$checked}} wire:click="checkEmployee({{ $attendance->attendant->id }})">
                                </td>
                                <td>{{ $attendance->attendant->name }}</td>
                                <td></td>
                                <td>-</td>
                                <td>{{ $ticket }}</td>
                                <td>{{ $attendance->attendant->height }} cm</td>
                                <td>
                                    <input type="checkbox" {{$checkedAll}} wire:click="checkAll({{ $attendance->attendant->id }})">
                                </td>
                            </tr>

                            @if($attendance->attendant->families->isNotEmpty())
                            @foreach($attendance->attendant->families as $family)
                            @php
                                if ($family->attendance->status == 'unchecked') {
                                    $checked = '';
                                } else {
                                    $checked = 'checked';
                                }
                                $family->attendance->status == 'checked' ? $ticket++ :$ticket;
                            @endphp
                            <tr>
                                <td>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-arrow-forward" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M15 11l4 4l-4 4m4 -4h-11a4 4 0 0 1 0 -8h1" />
                                    </svg>
                                </td>
                                <td>-</td>
                                <td></td>
                                <td>-</td>
                                <td><input type="checkbox" {{$checked}} wire:click="checkFamily({{ $family->attendance->attendant->id }})"></td>
                                <td>{{ $family->name }}</td>
                                <td>-</td>
                                <td>{{ $family->height }} cm</td>
                                <td></td>
                            </tr>
                            @endforeach
                            @endif
                            @empty
                            <tr>
                                <td colspan="9" align="center">
                                    No Attendance Found.
                                </td>
                            </tr>
                            @endforelse
                            @endif
                            @endif
                        </tbody>
                    </table>


                </div>
                <div class="pt-4">
                    {{ optional($attendances)->links() }}
                </div>

            </div>
        </div>
    </div>

</div>