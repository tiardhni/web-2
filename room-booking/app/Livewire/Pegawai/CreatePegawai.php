<?php

namespace App\Livewire\Pegawai;

use App\Models\Pegawai;
use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\UnitKerja;

class CreatePegawai extends Component
{
    #[Validate('required|string|max:10')]
    public string $nip = '';

    #[Validate('required|string|max:50')]
    public string $nama = '';

    #[Validate('required|string|max:50')]
    public string $unit_kerja_id = '';

    public function save()
    {
        $this->validate();

        Pegawai::create([
            'nip' => $this->nip,
            'nama' => $this->nama,
            'unit_kerja_id' => $this->unit_kerja_id,
        ]);

        session()->flash('message', 'Pegawai berhasil ditambahkan.');

        return $this->redirectRoute('pegawai.index');
    }

    public function render()
    {
        return view('livewire.pegawai.create-pegawai', [
            'unit_kerja' => UnitKerja::all(),
        ]);
    }

}
