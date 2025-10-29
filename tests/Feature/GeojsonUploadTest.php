<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Illuminate\Http\UploadedFile;
use App\Models\Layer;

class GeojsonUploadTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function upload_geojson_creates_layer()
    {
        // prepare a minimal GeoJSON
        $geojson = '{"type":"FeatureCollection","features":[{"type":"Feature","properties":{},"geometry":{"type":"Polygon","coordinates":[[[0,0],[1,0],[1,1],[0,0]]]}}]}';

        $tmpPath = sys_get_temp_dir().'/test_layer_'.uniqid().'.geojson';
        file_put_contents($tmpPath, $geojson);

        $uploaded = new UploadedFile($tmpPath, 'layer.geojson', 'application/geo+json', null, true);

        Livewire::test(\App\Livewire\Layers::class)
            ->set('name', 'Test Layer')
            ->set('geojsonFile', $uploaded)
            ->call('save');

        $this->assertDatabaseHas('layers', ['name' => 'Test Layer']);
    }
}
