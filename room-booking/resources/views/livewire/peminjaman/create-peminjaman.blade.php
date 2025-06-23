<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Tambah Peminjaman</h1>

    @if (session('message'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-4">

        <flux:select
            id="pegawai"
            wire:model.defer="pegawai_id"
            label="Pegawai"
            required>
            @foreach ($pegawais as $pegawai)
                <flux:select.option value="{{ $pegawai->id }}">
                    {{ $pegawai->nama }}
                </flux:select.option>
            @endforeach
        </flux:select>

        <flux:select
            id="ruang"
            wire:model.defer="ruang_id"
            label="Ruang"
            required>
            @foreach ($ruangs as $ruang)
                <flux:select.option value="{{ $ruang->id }}">
                    {{ $ruang->nama }}
                </flux:select.option>
            @endforeach
        </flux:select>

        <flux:input
            type="date"
            wire:model.defer="tanggal_pinjam"
            label="Tanggal Pinjam"
            required />

        <flux:input
            type="date"
            wire:model.defer="tanggal_kembali"
            label="Tanggal Kembali"
            required />

        <flux:button type="submit" variant="primary">Simpan</flux:button>
    </form>
</div>
