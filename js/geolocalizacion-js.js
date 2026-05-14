// 1. Configuración Inicial 
const centroInicial = [31.7420431, -106.4331578];
const map = L.map('map', { zoomControl: false }).setView(centroInicial, 15);

// 2. Capa de mapa clara 
L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
    attribution: '&copy; OpenStreetMap'
}).addTo(map);

L.control.zoom({ position: 'bottomright' }).addTo(map);

// 3. Crear el marcador naranja DiDi
const naranjaIcon = L.divIcon({
    className: 'custom-icon',
    html: `<div style="background-color: #FF6600; width: 16px; height: 16px; border-radius: 50%; border: 3px solid white; box-shadow: 0 0 10px rgba(0,0,0,0.3);"></div>`,
    iconSize: [22, 22],
    iconAnchor: [11, 11]
});

let marcador = L.marker(centroInicial, { icon: naranjaIcon }).addTo(map);

// 4. Función para mover ubicación al hacer CLIC
map.on('click', function(e) {
    const lat = e.latlng.lat;
    const lng = e.latlng.lng;

    marcador.setLatLng([lat, lng]); // Mover marcador
    map.panTo([lat, lng]);          // Centrar suavemente
    
    // Actualizar texto en el panel
    document.getElementById('txt-ubicacion').innerText = `Lat: ${lat.toFixed(4)}, Lng: ${lng.toFixed(4)}`;
});

// 5. Función para usar GPS REAL --no funciona en la página porque no permite la ubicacion debido al http no confiable
document.getElementById('find-me').addEventListener('click', () => {
    if (!navigator.geolocation) {
        alert("Tu navegador no soporta GPS");
    } else {
        navigator.geolocation.getCurrentPosition((pos) => {
            const miLat = pos.coords.latitude;
            const miLng = pos.coords.longitude;

            marcador.setLatLng([miLat, miLng]);
            map.setView([miLat, miLng], 17);
            document.getElementById('txt-ubicacion').innerText = "Ubicación GPS detectada";
        }, () => {
            alert("Por favor, permite el acceso a tu ubicación.");
        });
    }
});