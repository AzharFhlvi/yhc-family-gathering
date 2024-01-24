<div class="py-12">
    <div class="col-md-12 mb-2">
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
        @if ($modal=='create')
        @include('livewire.employees.create')
        @elseif ($modal=='createFamily')
        @include('livewire.families.create')
        @elseif ($modal=='edit')
        @include('livewire.employees.edit')
        @elseif ($modal=='editFamily')
        @include('livewire.families.edit')
        @elseif ($modal=='show')
        @include('livewire.employees.show')
        @endif
    </div>

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Data Master
                    </div>
                    <h2 class="page-title">
                        Karyawan
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <form method="get">
                            <input class="border-solid border border-gray-300 p-2 w-full md:w-1/4" type="text"
                                placeholder="Search Employees" wire:model.live="query" />
                        </form>
                        <button wire:click="create" class="btn btn-blue">Tambah Karyawan</button>
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
                                <th>Nama Karyawan</th>
                                <th>Unit</th>
                                <th>Posisi</th>
                                <th>Tinggi</th>
                                <th class="w-1"></th>
                                <th class="w-1"></th>
                                <th class="w-1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($query == "")
                            <tr class="text-gray-500 text-sm">
                                <td colspan="7">
                                    Masukkan nama untuk mencari karyawan.
                                </td>
                            </tr>
                            @else
                            @if($employees->isEmpty())
                            <tr class="text-gray-500 text-sm">
                                <td colspan="7">
                                    Tidak ditemukan hasil yang cocok.
                                </td>
                            </tr>
                            @else
                            @forelse ($employees as $employee)
                            <tr>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->unit_name }}</td>
                                <td>{{ $employee->position }}</td>
                                <td>{{ $employee->height }} cm</td>
                                <td>
                                    <a wire:click="show({{$employee->id}})" href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-eye-search" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path
                                                d="M12 18c-.328 0 -.652 -.017 -.97 -.05c-3.172 -.332 -5.85 -2.315 -8.03 -5.95c2.4 -4 5.4 -6 9 -6c3.465 0 6.374 1.853 8.727 5.558" />
                                            <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                            <path d="M20.2 20.2l1.8 1.8" /></svg>
                                    </a>
                                </td>
                                <td>
                                    <a wire:click="edit({{$employee->id}})" href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-edit" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                            <path
                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                            <path d="M16 5l3 3" />
                                        </svg>
                                    </a>
                                </td>
                                <td>
                                    <a onclick="confirm('Are you sure you want to remove the user from this group?') || event.stopImmediatePropagation()"
                                        wire:click.prevent="destroy({{ $employee->id }})" href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-trash" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4 7l16 0" />
                                            <path d="M10 11l0 6" />
                                            <path d="M14 11l0 6" />
                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" align="center">
                                    No Unit Found.
                                </td>
                            </tr>
                            @endforelse
                            @endif
                            @endif
                        </tbody>
                    </table>


                </div>
                <div class="pt-4">
                    {{ optional($employees)->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
@livewireScripts