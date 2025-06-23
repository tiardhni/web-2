<?php

namespace App\Livewire\UnitKerja;

use App\Models\UnitKerja;
use Livewire\Component;
use Livewire\Attributes\Validate;

class CreateUnitKerja extends Component
{
    #[Validate('required|string|max:10')]
    public string $kode = '';

    #[Validate('required|string|max:100')]
    public string $nama = '';

    public function save()
    {
        $this->validate();

        UnitKerja::create([
            'kode' => $this->kode,
            'nama' => $this->nama,
        ]);

        session()->flash('message', 'Unit Kerja berhasil ditambahkan.');

        // Redirect ke halaman list unit kerja
        return $this->redirectRoute('unit-kerja.index');
    }

    public function render()
    {
        return view('livewire.unit-kerja.create-unit-kerja');
    }
}
