<?php

namespace App\Livewire\Peminjaman;

use App\Models\Peminjaman;
use App\Models\Pegawai;
use App\Models\Ruang;
use Livewire\Component;
use Livewire\Attributes\Validate;

class EditPeminjaman extends Component
{
    #[Validate('required|exists:pegawai,id')]
    public $pegawai_id = '';

    #[Validate('required|exists:ruang,id')]
    public $ruang_id = '';

    #[Validate('required|date')]
    public $tanggal_pinjam = '';

    #[Validate('required|date|after_or_equal:tanggal_pinjam')]
    public $tanggal_kembali = '';

    public Peminjaman $peminjaman;

    public function mount(Peminjaman $peminjaman)
    {
        $this->peminjaman = $peminjaman;
        $this->pegawai_id = $peminjaman->pegawai_id;
        $this->ruang_id = $peminjaman->ruang_id;
        $this->tanggal_pinjam = $peminjaman->tanggal_pinjam;
        $this->tanggal_kembali = $peminjaman->tanggal_kembali;
    }

    public function save()
    {
        $this->validate();

        $this->peminjaman->update([
            'pegawai_id' => $this->pegawai_id,
            'ruang_id' => $this->ruang_id,
            'tanggal_pinjam' => $this->tanggal_pinjam,
            'tanggal_kembali' => $this->tanggal_kembali,
        ]);

        session()->flash('message', 'Peminjaman berhasil diperbarui.');

        return redirect()->route('peminjaman.index');
    }

    public function render()
    {
        return view('livewire.peminjaman.edit-peminjaman', [
            'pegawais' => Pegawai::all(),
            'ruangs' => Ruang::all(),
        ]);
    }
}
