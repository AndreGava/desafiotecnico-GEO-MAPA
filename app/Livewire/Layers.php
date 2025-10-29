<?php

namespace App\Livewire;

use App\Models\Layer;
use Clickbar\Magellan\Data\Geometries\GeometryFactory;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Rule;

class Layers extends Component
{
    use WithFileUploads;

    #[Rule('required|string|max:100')]
    public $name = '';

    // optional file upload for create or update
    #[Rule('nullable|file|mimes:json,geojson')]
    public $geojsonFile;

    // when set, we're editing an existing layer
    public $editingId = null;

    public function save()
    {
        $this->validate();

        // create new layer
        $geometry = null;
        if ($this->geojsonFile) {
            $geojsonContent = file_get_contents($this->geojsonFile->getRealPath());
            $geometry = GeometryFactory::fromGeoJson($geojsonContent);
        }

        Layer::create([
            'name' => $this->name,
            'geometry' => $geometry,
        ]);

        session()->flash('success', 'Camada salva com sucesso.');

        $this->reset(['name', 'geojsonFile']);
    }

    public function edit($id)
    {
        $layer = Layer::findOrFail($id);
        $this->editingId = $layer->id;
        $this->name = $layer->name;
        // leave geojsonFile empty unless user uploads a new file
    }

    public function update()
    {
        // validate name is required; geojson optional
        $this->validate([
            'name' => 'required|string|max:100',
            'geojsonFile' => 'nullable|file|mimes:json,geojson',
        ]);

        $layer = Layer::findOrFail($this->editingId);

        $layer->name = $this->name;

        if ($this->geojsonFile) {
            $geojsonContent = file_get_contents($this->geojsonFile->getRealPath());
            $layer->geometry = GeometryFactory::fromGeoJson($geojsonContent);
        }

        $layer->save();

        session()->flash('success', 'Camada atualizada com sucesso.');

        $this->reset(['name', 'geojsonFile', 'editingId']);
    }

    public function cancelEdit()
    {
        $this->reset(['name', 'geojsonFile', 'editingId']);
    }

    public function delete($id)
    {
        $layer = Layer::findOrFail($id);
        $layer->delete();
        session()->flash('success', 'Camada excluída com sucesso.');
    }

    public function render()
    {
        $layers = Layer::latest()->get();
        return view('livewire.layers', [
            'layers' => $layers,
        ]);
    }
}
