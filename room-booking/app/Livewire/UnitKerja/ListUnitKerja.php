<?php

namespace App\Livewire\UnitKerja;

use App\Models\UnitKerja;
use Livewire\Component;

class ListUnitKerja extends Component
{
    public function render()
    {
        return view('livewire.unit-kerja.list-unit-kerja', [
            'unitKerjas' => UnitKerja::all(),
        ]);
    }

    public function delete($id)
    {
        $unitKerja = UnitKerja::find($id);
        if ($unitKerja) {
            $unitKerja->delete();
            session()->flash('message', 'Unit Kerja berhasil dihapus.');
        }
    }
}
