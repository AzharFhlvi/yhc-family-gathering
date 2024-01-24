<div class="absolute z-50 inset-0 flex items-center justify-center bg-opacity-50 bg-gray-900">
    <div class="card bg-white w-1/2">
        <form>
            <div class="card-header">
                <h3 class="card-title">Update unit</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label required">Nama karyawan</label>
                    <div>
                        <input type="text" class="form-control" placeholder="Masukkan nama unit" wire:model='name'>
                    </div>
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label required">Unit</label>
                    <div>
                        <select class="form-control" wire:model='unitId'>
                            <option value="" disabled>Pilih unit</option>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}" {{ $unit->id == $unitId ? 'selected' : '' }}>{{ $unit->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('unit')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label required">Posisi/jabatan</label>
                    <div>
                        <input type="text" class="form-control" placeholder="Masukkan nama jabatan" wire:model='position'>
                    </div>
                    @error('position')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label required">Tinggi badan</label>
                    <div>
                        <input type="number" class="form-control" placeholder="Masukkan tinggi badan" wire:model='height'>
                    </div>
                    @error('position')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="card-footer text-end">
                <button wire:click.prevent='update' class="btn btn-blue">Simpan</button>
                <button wire:click.prevent="close" class="btn btn-link link-secondary">Close</button> <!-- Add this line -->

            </div>
        </form>
        </div>
</div>