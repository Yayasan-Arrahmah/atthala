<?php

namespace App\Http\Livewire\Tahsin;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Pembayaran extends Component
{
    use WithPagination;
    public $search = '';
    public $statusTanda = '2';
    public $perPage = 5;
    public $sortAsc = true;
    public $sortField = 'created_at';


    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = ! $this->sortAsc;
        } else {
            $this->sortAsc = true;
        }
        $this->sortField = $field;
    }


    public function render()
    {
        return view('livewire.tahsin.pembayaran', [
            'tahsins' => \App\Models\Tahsin::search($this->search)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            // ->search($this->statusTanda)
            ->paginate($this->perPage),
        ]);
    }
}
