<div class="absolute z-50 inset-0 flex items-center justify-center bg-opacity-50 bg-gray-900">
    <div class="card bg-white w-1/2">
        <form>
            <div class="card-header">
                <h3 class="card-title">Tambah unit</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label required">Nama unit</label>
                    <div>
                        <input type="tex" class="form-control" placeholder="Masukkan nama unit" wire:model='name'>
                    </div>
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="card-footer text-end">
                <button wire:click.prevent='store' class="btn btn-blue">Simpan</button>
                <button wire:click.prevent="close" class="btn btn-link link-secondary">Close</button> <!-- Add this line -->
            </div>
        </form>
        </div>
</div>