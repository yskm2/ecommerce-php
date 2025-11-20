
<!DOCTYPE html>
<html lang="es">



<body>
    

    <section class="page-header">
        <div class="container">
            <h1>Contactanos</h1>
            <p>Proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet.</p>
        </div>
    </section>

    <div id="mapid" style="width: 100%; height: 300px;"></div>

    <section class="contact-section">
        <div class="container">
            <form class="contact-form" method="post" role="form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="inputname">Nombre</label>
                        <input type="text" id="name" name="name" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="inputemail">Email</label>
                        <input type="email" id="email" name="email" placeholder="Email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputsubject">Sobre que</label>
                    <input type="text" id="subject" name="subject" placeholder="Subject">
                </div>
                <div class="form-group">
                    <label for="inputmessage">Mensaje</label>
                    <textarea id="message" name="message" placeholder="Message" rows="8"></textarea>
                </div>
                <div class="form-submit-row">
                    <button type="submit" class="btn-primary">Enviar</button>
                </div>
            </form>
        </div>
    </section>

    

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
    // Primero, obtén el elemento del mapa
    var mymap = L.map('mapid');
    
    // Define las capas del mapa (el diseño visual)
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=TU_ACCESS_TOKEN_AQUI', {
        maxZoom: 18,
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1
    }).addTo(mymap);

    // Función que se ejecuta si se obtiene la ubicación con éxito
    function onLocationFound(e) {
        var radius = e.accuracy / 2;

        // Centra el mapa en la ubicación del usuario
        mymap.setView(e.latlng, 13);

        // Coloca un marcador en la ubicación y un círculo para mostrar la precisión
        L.marker(e.latlng).addTo(mymap)
            .bindPopup("¡Estás aquí! (con un radio de " + radius + " metros de precisión)").openPopup();

        L.circle(e.latlng, radius).addTo(mymap);
    }

    // Función que se ejecuta si hay un error al obtener la ubicación
    function onLocationError(e) {
        alert("No se pudo obtener tu ubicación. Mostrando una ubicación predeterminada.");
        // Si falla, muestra la ubicación original que tenías
        mymap.setView([-23.013104, -43.394365], 13);
        L.marker([-23.013104, -43.394365]).addTo(mymap)
            .bindPopup("Ubicación de ejemplo.").openPopup();
    }

    // Pide al navegador la ubicación del usuario
    mymap.on('locationfound', onLocationFound);
    mymap.on('locationerror', onLocationError);

    mymap.locate({setView: true, maxZoom: 16});

</script>

</body>
</html>