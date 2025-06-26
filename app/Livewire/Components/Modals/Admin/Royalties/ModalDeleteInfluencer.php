<?php

namespace App\Livewire\Components\Modals\Admin\Royalties;

use Livewire\Component;
use App\Models\Influencer;
use Livewire\Attributes\Reactive;
use Illuminate\Support\Facades\Log;

class ModalDeleteInfluencer extends Component
{
    //String
    public $modalId;
    //Object
    public $queryInfluencerDelete;
    //Integer
    #[Reactive]
    public $selectedIdInfluencer;

    public function boot() {
        $this->queryInfluencerDelete = Influencer::find($this->selectedIdInfluencer);
    }

    //ACTION - Delete data influencer
    public function deleteInfluencer() {
        try {
            Influencer::find($this->selectedIdInfluencer)->delete();
            $this->dispatch('delete-influencer-success');
            $this->redirect(route('admin::influencer'), navigate:true);
        } catch (\Throwable $th) {
            Log::error('Gagal menghapus data influencer:'. $th->getMessage());
            session()->flash('error-delete-influencer', 'Terjadi kesalahan saat menghapus, silahkan coba kembali!');
        }
    }

    public function render()
    {
        return view('livewire.components.modals.admin.royalties.modal-delete-influencer');
    }
}
