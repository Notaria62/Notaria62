<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="blue">
                <h4 class="title">
                    Mapa Notaria 62 del circulo de bogota.
                </h4>
            </div>
            <div class="card-content table-responsive">
                <div id="map"></div>
                <script>
                    function initMap() {
                        var uluru = { lat: -25.363, lng: 131.044 };
                        var map = new google.maps.Map(document.getElementById('map'), {
                            zoom: 4,
                            center: uluru
                        });
                        var marker = new google.maps.Marker({
                            position: uluru,
                            map: map
                        });
                    }
                </script>
                <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB950G4atdX9jj6N85Sc7PWC1FoFqJgNxQ&callback=initMap"></script>


            </div>
        </div>
    </div>
</div>

