@extends('layouts.main-layout')

@section('title', 'Geofencing Management')

@section('main-content')
@include('components.breadcrumb', [
  'title' => 'Geofencing Management',
  'items' => [
      ['name' => 'Admin', 'url' => '#', 'active' => false],
      ['name' => 'Geofencing', 'url' => '#', 'active' => true],
  ],
  'buttonUrl' => '#',
  'buttonIcon' => 'bi bi-plus-circle',
  'buttonText' => 'Add Geofence'
])

<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-center">Geofencing Area</h2>
            <p class="text-center">Draw and manage your geofenced areas on the map.</p>
        </div>
    </div>

    {{--  <div class="row mb-4">
        <div class="col-md-12">
            <div id="map" style="height: 400px;"></div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <h5>Existing Geofences</h5>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Geofence Name</th>
                            <th>Coordinates</th>
                            <th>Radius (m)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="geofenceTableBody">
                        <!-- Geofences will be dynamically loaded here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-primary" id="saveGeofenceBtn">Save Geofence</button>
        </div>
    </div>
</div>  --}}
<div class="row">
  <!-- map from google Maps -->
  <div class="col">
    <iframe 			src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1983.239474237366!2d3.3710422916827073!3d6.510079535239555!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103b8c8750b896f3%3A0x6c99e23f37fe16b3!2sAlagomeji%2C%20Yaba%2C%20Lagos%2C%20Nigeria!5e0!3m2!1sen!2sus!4v1694467200253!5m2!1sen!2sus" frameborder="0" style="border:0; width: 100%; height: 400px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  </div>

  <!-- map from google Maps -->
</div>
</div>

<script>
    // Initialize the map
    const map = L.map('map').setView([51.505, -0.09], 13); // Replace with your desired location

    // Add OpenStreetMap tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    }).addTo(map);

    let drawnItems = new L.FeatureGroup();
    map.addLayer(drawnItems);

    // Add drawing controls
    const drawControl = new L.Control.Draw({
        edit: {
            featureGroup: drawnItems
        },
        draw: {
            polygon: true,
            marker: false,
            polyline: false,
            rectangle: false,
            circle: {
                shapeOptions: {
                    color: '#f357a1',
                    opacity: 0.5
                }
            }
        }
    });
    map.addControl(drawControl);

    // Event when a new shape is created
    map.on('draw:created', function(e) {
        const layer = e.layer;
        drawnItems.addLayer(layer);
        
        // You can access the coordinates of the drawn shape here
        const coordinates = layer.getLatLngs();
        console.log(coordinates);
    });

    // Save geofence button
    document.getElementById('saveGeofenceBtn').addEventListener('click', function() {
        // Logic to save the drawn geofences to the server goes here
        alert('Geofence saved!');
    });

    // Load existing geofences (example data)
    const existingGeofences = [
        { name: 'Office', coordinates: '51.505, -0.09', radius: 100 },
        { name: 'Home', coordinates: '51.507, -0.08', radius: 150 }
    ];

    const geofenceTableBody = document.getElementById('geofenceTableBody');
    existingGeofences.forEach(geofence => {
        const row = `<tr>
                        <td>${geofence.name}</td>
                        <td>${geofence.coordinates}</td>
                        <td>${geofence.radius}</td>
                        <td>
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>`;
        geofenceTableBody.innerHTML += row;
    });
</script>

@endsection
