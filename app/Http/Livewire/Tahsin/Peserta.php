<?php

namespace App\Http\Livewire\Tahsin;

use Livewire\Component;
use Livewire\WithPagination;

class Peserta extends Component
{
    use WithPagination;
    public $search = '';
    public $perPage = 10;
    public $sortAsc = true;
    public $sortField = 'created_at';

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }
        $this->sortField = $field;
    }

    public function render()
    {
        return view('livewire.tahsin.peserta', [
            'tahsins' => \App\Models\Tahsin::search($this->search)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage),
        ]);
    }
}
