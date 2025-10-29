<?php

namespace App\Models;

// The HasPostgisColumns trait was removed in magellan v2.x — use Casts instead
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'geometry',
    ];

    /**
     * Use Magellan Geometry cast. You can set a specific geometry subclass
     * (e.g. Point::class) if your column only stores one geometry type.
     */
    protected $casts = [
        'geometry' => \Clickbar\Magellan\Data\Geometries\Geometry::class,
    ];
}
