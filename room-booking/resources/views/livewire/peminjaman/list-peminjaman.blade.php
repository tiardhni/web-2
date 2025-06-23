<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">List Peminjaman</h1>

    @if (session('message'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="flex justify-between mb-4">
        <flux:button :href="route('peminjaman.create')" variant="primary">
            Tambah Peminjaman
        </flux:button>
    </div>

    <table class="min-w-full border-collapse border border-gray-400 mt-4">
        <thead class="bg-gray-100">
            <tr>
                <th class="py-2 px-4 border">ID</th>
                <th class="py-2 px-4 border">Pegawai</th>
                <th class="py-2 px-4 border">Ruang</th>
                <th class="py-2 px-4 border">Tanggal Pinjam</th>
                <th class="py-2 px-4 border">Tanggal Kembali</th>
                <th class="py-2 px-4 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjamans as $peminjaman)
                <tr>
                    <td class="py-2 px-4 border">{{ $peminjaman->id }}</td>
                    <td class="py-2 px-4 border">{{ $peminjaman->pegawai->nama ?? '-' }}</td>
                    <td class="py-2 px-4 border">{{ $peminjaman->ruang->nama ?? '-' }}</td>
                    <td class="py-2 px-4 border">{{ $peminjaman->tanggal_pinjam }}</td>
                    <td class="py-2 px-4 border">{{ $peminjaman->tanggal_kembali }}</td>
                    <td class="py-2 px-4 border">
                        <flux:button :href="route('peminjaman.edit', $peminjaman)" variant="primary">
                            Edit
                        </flux:button>
                        <flux:button wire:click="delete({{ $peminjaman->id }})" variant="danger">
                            Delete
                        </flux:button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
