<div class="absolute z-50 inset-0 flex items-center justify-center bg-opacity-50 bg-gray-900">
    <div class="card bg-white w-1/2">
        <form>
            <div class="card-header">
                <h3 class="card-title">Tambah Keluarga</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label required">Nama </label>
                    <div>
                        <input type="text" class="form-control" placeholder="Masukkan nama keluarga" wire:model='name'>
                    </div>
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label required">Hubungan</label>
                    <div>
                        <select class="form-control" wire:model='relation'>
                            <option value="">Pilih Hubungan</option>
                                <option value="pasangan" selected>Pasangan</option>
                                <option value="anak">Anak</option>
                        </select>
                    </div>
                    @error('relation')
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
                <button wire:click='storeFamily' class="btn btn-blue">Simpan</button>
                <button wire:click.prevent="close" class="btn btn-link link-secondary">Close</button> <!-- Add this line -->
            </div>
        </form>
        </div>
</div>