<div class="row">

    <div class="col-sm-4">

        <?php if (count($multimedia->row) > 1) { ?>
        <div id="carousel-captions" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <?php $multimediaCount = 0; ?>
                <?php foreach ($multimedia->row as $row) { ?>
                    <div class="item <?= $multimediaCount == 0 ? 'active' : '' ?>">
                        <img data-src="<?= $row->server_path ?>" src="<?= $row->server_path ?>"
                             data-holder-rendered="true" style="width: 100%;">

                        <div class="carousel-caption">
                        </div>
                    </div>
                    <?php $multimediaCount++; ?>
                <?php } ?>
                <?php } ?>

            </div>
            <a class="left carousel-control" href="#carousel-captions" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-captions" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

    </div>

    <?php
    $tableData = [
        'Number of rooms' => @$product->number_of_rooms,
        'Check In' => @$product->check_in_time . ' - ' . @$product->check_out_time,
        'Reception Hours Text' => @$product->reception_hours_text,
        'Price Range' => @$product->attribute_id_currency . ' ' . @$product->rate_from . ' - ' . $product->attribute_id_currency . ' ' . $product->rate_to,
        'Address' => @$product->city_name . ' ' . @$product->area_name . ' ' . @$product->state_name . ' ' . @$product->country_name
    ];
    ?>
    <div class="col-sm-8" style="margin-bottom: 5px;">
        <p><?= @$product->product_description ?></p>

        <div class="col-sm-6">
            <table class="table table-hover">
                <tbody>
                <?php foreach ($tableData as $key => $value) { ?>
                    <tr>
                        <th scope="row">
                            <?= $key ?>
                        </th>
                        <td><?= $value ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="col-sm-6 hidden-sm hidden-xs" id="map" style="overflow: hidden; transform: translateZ(0px); background-color: rgb(229, 227, 223);">

        </div>
    </div>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBjjfQiE6n4l2WG_QUj7PM3hP6cMhGoL_8&callback=initMap"
            async defer></script>
    <script>
        function initMap(){
            var map;
            var latlng = new google.maps.LatLng(<?= (string) $address->row[0]->geocode_gda_latitude ?>,<?= (string) $address->row[0]->geocode_gda_longitude ?>);
            map = new google.maps.Map(document.getElementById('map'), {
                center: latlng,
                zoom: 16
            });
            google.maps.event.trigger(map, 'resize');
            var marker = new google.maps.Marker({
                position: latlng,
                title:"More Information can be added here"
            });

            marker.setMap(map);
        }
        $(document).ready(function () {
            initMap();
        })
    </script>



    <pre style="padding-top:15px;">
        Online booking coming soon
    </pre>

