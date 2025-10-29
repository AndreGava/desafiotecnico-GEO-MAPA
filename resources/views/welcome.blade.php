<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title>Desafio Geo - Mapa</title>

    <style>
        html,
        body,
        #viewDiv {
            padding: 0;
            margin: 0;
            height: 100%;
            width: 100%;
        }
    </style>

    <link rel="stylesheet" href="https://js.arcgis.com/4.30/esri/themes/light/main.css" />
    <script src="https://js.arcgis.com/4.30/"></script>

</head>
<body>
    <div id="viewDiv"></div>
    <script>
        require([
            "esri/Map",
            "esri/views/MapView",
            "esri/layers/GraphicsLayer",
            "esri/Graphic"
        ], (Map, MapView, GraphicsLayer, Graphic) => {

            const map = new Map({
                basemap: "streets-navigation-vector"
            });

            const view = new MapView({
                container: "viewDiv",
                map: map,
                center: [-46.6333, -23.5505], // São Paulo
                zoom: 8
            });

            const graphicsLayer = new GraphicsLayer();
            map.add(graphicsLayer);

            const layers = @json($layers);

            const simpleFillSymbol = {
                type: "simple-fill",
                color: [227, 139, 79, 0.8],
                outline: {
                    color: [255, 255, 255],
                    width: 1
                }
            };

            const simpleLineSymbol = {
                type: "simple-line",
                color: [255, 0, 0, 0.8], // Red
                width: 2
            };

            const simpleMarkerSymbol = {
                type: "simple-marker",
                color: [0, 0, 0, 0.8], // Black
                outline: {
                    color: [255, 255, 255],
                    width: 1
                }
            };

            layers.forEach(layer => {
                if (layer.geometry) {
                    const geometryJson = layer.geometry;

                    let symbol;
                    // Choose symbol based on geometry type
                    if (geometryJson.type.toLowerCase().includes('polygon')) {
                        symbol = simpleFillSymbol;
                    } else if (geometryJson.type.toLowerCase().includes('line')) {
                        symbol = simpleLineSymbol;
                    } else if (geometryJson.type.toLowerCase().includes('point')) {
                        symbol = simpleMarkerSymbol;
                    }

                    const graphic = new Graphic({
                        geometry: {
                            type: geometryJson.type.toLowerCase(),
                            rings: geometryJson.coordinates, // For polygons
                            paths: geometryJson.coordinates, // For polylines
                            x: geometryJson.coordinates[0],
                            y: geometryJson.coordinates[1],
                            spatialReference: view.spatialReference
                        },
                        symbol: symbol,
                        attributes: {
                            name: layer.name
                        }
                    });
                    graphicsLayer.add(graphic);
                }
            });
        });
    </script>
</body>
</html>