<?php

namespace App\Livewire\Peminjaman;

use App\Models\Peminjaman;
use App\Models\Pegawai;
use App\Models\Ruang;
use Livewire\Component;
use Livewire\Attributes\Validate;

class CreatePeminjaman extends Component
{
    #[Validate('required|exists:pegawai,id')]
    public $pegawai_id = '';

    #[Validate('required|exists:ruang,id')]
    public $ruang_id = '';

    #[Validate('required|date')]
    public $tanggal_pinjam = '';

    #[Validate('required|date|after_or_equal:tanggal_pinjam')]
    public $tanggal_kembali = '';

    public function save()
    {
        $this->validate();

        Peminjaman::create([
            'pegawai_id' => $this->pegawai_id,
            'ruang_id' => $this->ruang_id,
            'tanggal' => $this->tanggal_pinjam, // pakai tanggal_pinjam juga untuk kolom tanggal
            'jam_mulai' => '08:00', // sementara hardcoded
            'jam_akhir' => '10:00',
            'keterangan' => 'Peminjaman default',
            'tanggal_pinjam' => $this->tanggal_pinjam,
            'tanggal_kembali' => $this->tanggal_kembali,
        ]);

        session()->flash('message', 'Peminjaman berhasil ditambahkan.');

        return $this->redirectRoute('peminjaman.index');
    }

    public function render()
    {
        return view('livewire.peminjaman.create-peminjaman', [
            'pegawais' => Pegawai::all(),
            'ruangs' => Ruang::all(),
        ]);
    }
}
