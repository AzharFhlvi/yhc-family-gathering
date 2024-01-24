<div class="absolute z-50 inset-0 flex items-center justify-center bg-opacity-50 bg-gray-900">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header flex justify-between">
                        <h3 class="card-title">Detail karyawan</h3>
                        <button wire:click="createFamily({{$employeeId}})" class="btn btn-blue">Tambah Keluarga</button>
                    </div>
                    <div class="card-body">
                        <div class="datagrid">
                            <div class="datagrid-item">
                                <div class="datagrid-title">Nama karyawan</div>
                                <div class="datagrid-content">{{$name}}</div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Unit/divisi</div>
                                <div class="datagrid-content">{{$unitName}}</div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Posisi/jabatan</div>
                                <div class="datagrid-content">{{$position}}</div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Tinggi badan</div>
                                <div class="datagrid-content">{{$height}} cm</div>
                            </div>
                        </div>
                        @if ($families->isNotEmpty())

                        <div class="hr-text">keluarga</div>
                        @foreach ($families as $family)
                        <div class="datagrid">
                            <div class="datagrid-item">
                                <div class="datagrid-title">Nama</div>
                                <div class="datagrid-content">{{$family->name}}</div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Hubungan</div>
                                <div class="datagrid-content">{{ ucfirst($family->relation) }}</div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Tinggi badan</div>
                                <div class="datagrid-content">{{ $family->height }} cm</div>
                            </div>
                            <div class="datagrid-item">
                                <div class="btn-list">
                                    <a wire:click="editFamily({{$family->id}})" href="#">
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
                                    <a wire:confirm="Are you sure you want to delete this post?"
                                        wire:click.prevent="destroyFamily({{ $family->id }})" href="#">
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
                                </div>
                            </div>
                        </div>
                        @if (!$loop->last)
                        <div class="hr"></div>
                        @endif
                        @endforeach
                        @endif
                    </div>
                    <div class="card-footer text-end">
                        <button wire:click.prevent="close" class="btn btn-link link-secondary">Close</button>
                        <!-- Add this line -->
                    </div>
                </div>
            </div>
        </div>
    </div>