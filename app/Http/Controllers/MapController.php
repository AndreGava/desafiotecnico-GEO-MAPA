<?php

namespace App\Http\Controllers;

use App\Models\Layer;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {
        // Ensure geometry is serialized to a plain PHP array/object that @json can encode
        $layers = Layer::all()->map(function ($layer) {
            $geometry = null;
            if ($layer->geometry) {
                // Magellan geometry implements JSON serialization; convert to PHP value
                $geometry = json_decode(json_encode($layer->geometry));
            }

            return [
                'id' => $layer->id,
                'name' => $layer->name,
                'geometry' => $geometry,
            ];
        });

        return view('welcome', ['layers' => $layers]);
    }
}
