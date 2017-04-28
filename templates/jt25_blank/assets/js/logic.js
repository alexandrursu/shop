// index JS

$jQ = jQuery.noConflict();

// ===== Scroll to Top ====
$jQ(window).scroll(function() {
    if ($jQ(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
        $jQ('#return-to-top').fadeIn(200);    // Fade in the arrow
    } else {
        $jQ('#return-to-top').fadeOut(200);   // Else fade out the arrow
    }
});


$jQ(document).ready(function() {
    $jQ('#return-to-top').click(function() {
        $jQ('body,html').animate({
            scrollTop : 0                       // Scroll to top of body
        }, 500);
    });

    // Logica pentru magazine

    $jQ('.click-magazine-tab').click(function(){
        var tab_id = $jQ(this).attr('data-tab');

        $jQ('.click-magazine-tab').removeClass('current');
        $jQ('.magazine-content').removeClass('current');

        $jQ(this).addClass('current');
        $jQ("#"+tab_id).addClass('current');
    });

    // Logica pentru magazine

    //if any elements with a class of 'category' are found
    $jQ( ".produse-recent-vizualizate").hide();

    if($jQ('.productdetails-view').length){
        $jQ('.fl-mega').hide();
        $jQ('#component.smaller-container').css('width','1004px');
        $jQ( ".produse-recent-vizualizate").show();
    }

    if($jQ('.browse-view').length){
        $jQ('#breadcrumbs').hide();
    }

    if($jQ('.blog.blog-class').length){
        $jQ('.right-sidebars').hide();

    }


    if($jQ('div.PricetaxAmount>span.PricetaxAmount').length){
        $jQ('.PricepriceWithoutTax').css('text-decoration', 'line-through');
    }


    if($jQ('.productdetails-view').length){
        $jQ('.banner-categorii').hide();

    }


/* Maps checking start */
//    if($jQ('.magazine').length){
//        // Map.js
//
//        google.maps.event.addDomListener(window, 'load', function() {
//
//            var map = new google.maps.Map(document.getElementById('map-canvas'), {
//
//                zoom: 11,
//
//                center: new google.maps.LatLng(47.027897, 28.840656),
//
//                mapTypeId: google.maps.MapTypeId.ROADMAP,
//
//                scrollwheel: false
//
//            });
//
//
//
//            var infoWindow = new google.maps.InfoWindow;
//
//
//
//            google.maps.event.addListener(map, 'click', function() {
//
//                infoWindow.close();
//
//            });
//
////Harta Tudor Vladimirescu start
//
//            var markerTV = new google.maps.Marker({
//
//                map: map,
//
//                position: new google.maps.LatLng(47.0354852, 28.8596803)
//
//            });
//
//
//
//
//
//            google.maps.event.addListener(markerTV, 'click', function(){
//
//                var marker = this;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str. Tudor Vladimirescu 14</span><br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setCenter(new google.maps.LatLng(47.0354852, 28.8596803), 14);
//
//                map.setZoom(14);
//
//            });
//
//
//
//            $jQ("#showonmapTudorVladimirescu").bind("click", function(){
//
//                infoWindow.close();
//
//                var marker = markerTV;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str. Tudor Vladimirescu 14</span><br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setZoom(14);
//
//                map.setCenter(new google.maps.LatLng(47.0354852, 28.8596803), 14);
//
//                $jQmcoff = $jQ("#map-canvas").offset();
//
//                $jQ('html, body').animate({scrollTop:$jQmcoff.top-10}, 300, 'easeInSine');
//
//            })
//
//
//
////Harta Tudor Vladimirescu end
//
//
////Harta M2 start
//
//            var marker2 = new google.maps.Marker({
//
//                map: map,
//
//                position: new google.maps.LatLng(47.023822,28.834295)
//
//            });
//
//
//
//
//
//            google.maps.event.addListener(marker2, 'click', function(){
//
//                var marker = this;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">Gemenii, St.cel Mare 136; but. 29/1</span><br>Tel.: 078 303 702<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setCenter(new google.maps.LatLng(47.023822,28.834295), 14);
//
//                map.setZoom(14);
//
//            });
//
//
//
//            $jQ("#showonmap2").bind("click", function(){
//
//                infoWindow.close();
//
//                var marker = marker2;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">Gemenii, St.cel Mare 136; but. 29/1</span><br>Tel.: 078 303 702<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setZoom(14);
//
//                map.setCenter(new google.maps.LatLng(47.023822,28.834295), 14);
//
//                $jQmcoff = $jQ("#map-canvas").offset();
//
//                $jQ('html, body').animate({scrollTop:$jQmcoff.top-10}, 300, 'easeInSine');
//
//            })
//
////Harta M2 end
//
////Harta M3 start
//
//            var marker3 = new google.maps.Marker({
//
//                map: map,
//
//                position: new google.maps.LatLng(47.017161, 28.835203)
//
//            });
//
//
//
//
//
//            google.maps.event.addListener(marker3, 'click', function(){
//
//                var marker = this;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str.Armeneasca 33</span><br>Tel.: 078 303 703<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setCenter(new google.maps.LatLng(47.017161, 28.835203), 14);
//
//                map.setZoom(14);
//
//            });
//
//
//
//            $jQ("#showonmap3").bind("click", function(){
//
//                infoWindow.close();
//
//                var marker = marker3;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str.Armeneasca 33</span><br>Tel.: 078 303 703<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setZoom(14);
//
//                map.setCenter(new google.maps.LatLng(47.017161, 28.835203), 14);
//
//                $jQmcoff = $jQ("#map-canvas").offset();
//
//                $jQ('html,body').animate({scrollTop:$jQmcoff.top-10}, 300, 'easeInSine');
//
//            })
//
////Harta M3 end
//
////Harta M5 start
//
//            var marker5 = new google.maps.Marker({
//
//                map: map,
//
//                position: new google.maps.LatLng(47.0288078, 28.7982143)
//
//            });
//
//
//
//
//
//            google.maps.event.addListener(marker5, 'click', function(){
//
//                var marker = this;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str.Ion Creanga 76 nr 65&nbsp;&nbsp;&nbsp;&nbsp;</span><br>Tel.: 078 303 705<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setCenter(new google.maps.LatLng(47.0288078, 28.7982143), 14);
//
//                map.setZoom(14);
//
//            });
//
//
//
//            $jQ("#showonmap5").bind("click", function(){
//
//                infoWindow.close();
//
//                var marker = marker5;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str.Ion Creanga 76 nr 65&nbsp;&nbsp;&nbsp;&nbsp;</span><br>Tel.: 078 303 705<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setZoom(14);
//
//                map.setCenter(new google.maps.LatLng(47.0288078, 28.7982143), 14);
//
//                $jQmcoff = $jQ("#map-canvas").offset();
//
//                $jQ('html, body').animate({scrollTop:$jQmcoff.top-10}, 300, 'easeInSine');
//
//            })
//
////Harta M5 end
//
////Harta M Stock start
//
//            var markerStock = new google.maps.Marker({
//
//                map: map,
//
//                position: new google.maps.LatLng(47.0288078, 28.7982143)
//
//            });
//
//
//
//
//
//            google.maps.event.addListener(markerStock, 'click', function(){
//
//                var marker = this;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str.Ion Creanga 76 nr 65(STOCK)</span><br>Tel.: 078 303 705<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setCenter(new google.maps.LatLng(47.0288078, 28.7982143), 14);
//
//                map.setZoom(14);
//
//            });
//
//
//
//            $jQ("#showonmapStock").bind("click", function(){
//
//                infoWindow.close();
//
//                var marker = markerStock;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str.Ion Creanga 76 nr 65 (STOCK)</span><br>Tel.: 078 303 705<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setZoom(14);
//
//                map.setCenter(new google.maps.LatLng(47.0288078, 28.7982143), 14);
//
//                $jQmcoff = $jQ("#map-canvas").offset();
//
//                $jQ('html, body').animate({scrollTop:$jQmcoff.top-10}, 300, 'easeInSine');
//
//            })
//
////Harta M Stock end
//
////Harta M6 start
//
//            var marker6 = new google.maps.Marker({
//
//                map: map,
//
//                position: new google.maps.LatLng(46.9917129,28.8565215)
//
//            });
//
//
//
//
//
//            google.maps.event.addListener(marker6, 'click', function(){
//
//                var marker = this;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">bd.  Decebal 63   </span><br>Tel.: 078 303 706<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - &nbsp;&nbsp;20:00 10:00 - 17:00</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setCenter(new google.maps.LatLng(46.9917129,28.8565215), 14);
//
//                map.setZoom(14);
//
//            });
//
//
//
//            $jQ("#showonmap6").bind("click", function(){
//
//                infoWindow.close();
//
//                var marker = marker6;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">bd.  Decebal 63   </span><br>Tel.: 078 303 706<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setZoom(14);
//
//                map.setCenter(new google.maps.LatLng(46.9917129,28.8565215), 14);
//
//                $jQmcoff = $jQ("#map-canvas").offset();
//
//                $jQ('html, body').animate({scrollTop:$jQmcoff.top-10}, 300, 'easeInSine');
//
//            })
//
//
//
////Harta M6 end
//
////Harta M7 start
//
//            var marker7 = new google.maps.Marker({
//
//                map: map,
//
//                position: new google.maps.LatLng(47.043498, 28.865159)
//
//            });
//
//
//
//
//
//            google.maps.event.addListener(marker7, 'click', function(){
//
//                var marker = this;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">Aleco Russo 4</span><br>Tel.: 078 303 707<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setCenter(new google.maps.LatLng(47.043498, 28.865159), 14);
//
//                map.setZoom(14);
//
//            });
//
//
//
//            $jQ("#showonmap7").bind("click", function(){
//
//                infoWindow.close();
//
//                var marker = marker7;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">Aleco Russo 4</span><br>Tel.: 078 303 707<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setZoom(14);
//
//                map.setCenter(new google.maps.LatLng(47.043498, 28.865159), 14);
//
//                $jQmcoff = $jQ("#map-canvas").offset();
//
//                $jQ('html, body').animate({scrollTop:$jQmcoff.top-10}, 300, 'easeInSine');
//
//            })
//
//
//
////Harta M7 end
//
////Harta M8 start
//
//            var marker8 = new google.maps.Marker({
//
//                map: map,
//
//                position: new google.maps.LatLng(47.019019, 28.837928)
//
//            });
//
//
//
//
//
//            google.maps.event.addListener(marker8, 'click', function(){
//
//                var marker = this;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">Armeneasca 42</span><br>Tel.: 078 303 708<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setCenter(new google.maps.LatLng(47.019019, 28.837928), 14);
//
//                map.setZoom(14);
//
//            });
//
//
//
//            $jQ("#showonmap8").bind("click", function(){
//
//                infoWindow.close();
//
//                var marker = marker8;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">Armeneasca 42</span><br>Tel.: 078 303 708<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setZoom(14);
//
//                map.setCenter(new google.maps.LatLng(47.019019, 28.837928), 14);
//
//                $jQmcoff = $jQ("#map-canvas").offset();
//
//                $jQ('html, body').animate({scrollTop:$jQmcoff.top-10}, 300, 'easeInSine');
//
//            })
//
//
//
////Harta M8 end
//
//
//
////Harta M9 start
//
//            var marker9 = new google.maps.Marker({
//
//                map: map,
//
//                position: new google.maps.LatLng(47.0304596,28.8400528)
//
//            });
//
//
//
//
//
//            google.maps.event.addListener(marker9, 'click', function(){
//
//                var marker = this;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">Grigore Vieru nr.13</span><br>Tel.: 078 303 709<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setCenter(new google.maps.LatLng(47.0304596,28.8400528), 14);
//
//                map.setZoom(14);
//
//            });
//
//
//
//            $jQ("#showonmap9").bind("click", function(){
//
//                infoWindow.close();
//
//                var marker = marker9;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">Grigore Vieru nr.13</span><br>Tel.: 078 303 709<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setZoom(14);
//
//                map.setCenter(new google.maps.LatLng(47.0304596,28.8400528), 14);
//
//                $jQmcoff = $jQ("#map-canvas").offset();
//
//                $jQ('html, body').animate({scrollTop:$jQmcoff.top-10}, 300, 'easeInSine');
//
//            })
//
//
//
////Harta M9 end
//
//
//
////Harta M10 start
//
//            var marker10 = new google.maps.Marker({
//
//                map: map,
//
//                position: new google.maps.LatLng(47.054271, 28.866025)
//
//            });
//
//
//
//
//
//            google.maps.event.addListener(marker10, 'click', function(){
//
//                var marker = this;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">bd. Moscovei 16</span><br>Tel.: 078 303 710<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setCenter(new google.maps.LatLng(47.054271, 28.866025), 14);
//
//                map.setZoom(14);
//
//            });
//
//
//
//            $jQ("#showonmap10").bind("click", function(){
//
//                infoWindow.close();
//
//                var marker = marker10;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">bd. Moscovei 16</span><br>Tel.: 078 303 710<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setZoom(14);
//
//                map.setCenter(new google.maps.LatLng(47.054271, 28.866025), 14);
//
//                $jQmcoff = $jQ("#map-canvas").offset();
//
//                $jQ('html, body').animate({scrollTop:$jQmcoff.top-10}, 300, 'easeInSine');
//
//            })
//
//
//
////Harta M10 end
//
//
//
////Harta M11 start
//
//            var marker11 = new google.maps.Marker({
//
//                map: map,
//
//                position: new google.maps.LatLng(47.0436798,28.8579281)
//
//            });
//
//
//
//
//
//            google.maps.event.addListener(marker11, 'click', function(){
//
//                var marker = this;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">bd. Bogdan Voievod 2 ap 145</span><br>Tel.: 078 303 711<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setCenter(new google.maps.LatLng(47.0436798,28.8579281), 14);
//
//                map.setZoom(14);
//
//            });
//
//
//
//            $jQ("#showonmap11").bind("click", function(){
//
//                infoWindow.close();
//
//                var marker = marker11;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">bd. Bogdan Voievod 2 ap 145</span><br>Tel.: 078 303 711<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setZoom(14);
//
//                map.setCenter(new google.maps.LatLng(47.0436798,28.8579281), 14);
//
//                $jQmcoff = $jQ("#map-canvas").offset();
//
//                $jQ('html, body').animate({scrollTop:$jQmcoff.top-10}, 300, 'easeInSine');
//
//            })
//
//
//
////Harta M11 end
//
//
//
////Harta M12 start
//
//            var marker12 = new google.maps.Marker({
//
//                map: map,
//
//                position: new google.maps.LatLng(47.0320132,28.8218661)
//
//            });
//
//
//
//
//
//            google.maps.event.addListener(marker12, 'click', function(){
//
//                var marker = this;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">bd. Stefan cel Mare nr 184</span><br>Tel.: 078 303 712<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setCenter(new google.maps.LatLng(47.0320132,28.8218661), 14);
//
//                map.setZoom(14);
//
//            });
//
//
//
//            $jQ("#showonmap12").bind("click", function(){
//
//                infoWindow.close();
//
//                var marker = marker12;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">bd. Stefan cel Mare nr 184</span><br>Tel.: 078 303 712<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setZoom(14);
//
//                map.setCenter(new google.maps.LatLng(47.0320132,28.8218661), 14);
//
//                $jQmcoff = $jQ("#map-canvas").offset();
//
//                $jQ('html, body').animate({scrollTop:$jQmcoff.top-10}, 300, 'easeInSine');
//
//            })
//
//
//
////Harta M12 end
//
//
//
////Harta M13 start
//
//            var marker13 = new google.maps.Marker({
//
//                map: map,
//
//                position: new google.maps.LatLng(47.038449, 28.888916)
//
//            });
//
//
//
//
//
//            google.maps.event.addListener(marker13, 'click', function(){
//
//                var marker = this;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">bd. Mircea cel Batrin 3</span><br>Tel.: 078 303 713<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setCenter(new google.maps.LatLng(47.038449, 28.888916), 14);
//
//                map.setZoom(14);
//
//            });
//
//
//
//            $jQ("#showonmap13").bind("click", function(){
//
//                infoWindow.close();
//
//                var marker = marker13;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">bd. Mircea cel Batrin 3</span><br>Tel.: 078 303 713<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setZoom(14);
//
//                map.setCenter(new google.maps.LatLng(47.038449, 28.888916), 14);
//
//                $jQmcoff = $jQ("#map-canvas").offset();
//
//                $jQ('html, body').animate({scrollTop:$jQmcoff.top-10}, 300, 'easeInSine');
//
//            })
//
//
//
////Harta M13 end
//
//
//
////Harta M14 start
//
//            var marker14 = new google.maps.Marker({
//
//                map: map,
//
//                position: new google.maps.LatLng(46.9983693,28.8536925)
//
//            });
//
//
//
//
//
//            google.maps.event.addListener(marker14, 'click', function(){
//
//                var marker = this;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str. Trandafirilor 15/1</span><br>Tel.: 078 303 714<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setCenter(new google.maps.LatLng(46.9983693,28.8536925), 14);
//
//                map.setZoom(14);
//
//            });
//
//
//
//            $jQ("#showonmap14").bind("click", function(){
//
//                infoWindow.close();
//
//                var marker = marker14;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str. Trandafirilor 15/1</span><br>Tel.: 078 303 714<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setZoom(14);
//
//                map.setCenter(new google.maps.LatLng(46.9983693,28.8536925), 14);
//
//                $jQmcoff = $jQ("#map-canvas").offset();
//
//                $jQ('html, body').animate({scrollTop:$jQmcoff.top-10}, 300, 'easeInSine');
//
//            })
//
//
//
////Harta M14 end
//
//
//
////Harta str. Ștefan cel Mare 16, Balti
//
//            var marker15 = new google.maps.Marker({
//
//                map: map,
//
//                position: new google.maps.LatLng(46.9914394,28.8518894)
//
//            });
//
//
//
//
//
//            google.maps.event.addListener(marker15, 'click', function(){
//
//                var marker = this;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str. Dacia 3/3</span><br>Tel.: tel: 078 303 817<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setCenter(new google.maps.LatLng(46.9914394,28.8518894), 14);
//
//                map.setZoom(14);
//
//            });
//
//
//
//            $jQ("#showonmap15").bind("click", function(){
//
//                infoWindow.close();
//
//                var marker = marker15;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str. Dacia 3/3</span><br>Tel.: tel: 078 303 817<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setZoom(14);
//
//                map.setCenter(new google.maps.LatLng(46.9914394,28.8518894), 14);
//
//                $jQmcoff = $jQ("#map-canvas").offset();
//
//                $jQ('html, body').animate({scrollTop:$jQmcoff.top-10}, 300, 'easeInSine');
//
//            })
//
//
//
////Harta str. Ștefan cel Mare 16, Balti end
//
//
//
////Harta M15 start
//
//            var marker16 = new google.maps.Marker({
//
//                map: map,
//
//                position: new google.maps.LatLng(47.762313,27.928228)
//
//            });
//
//
//
//
//
//            google.maps.event.addListener(marker16, 'click', function(){
//
//                var marker = this;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str. Ștefan cel Mare 16, Balți</span><br>Tel.: 078 303 715<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setCenter(new google.maps.LatLng(47.762313,27.928228), 14);
//
//                map.setZoom(14);
//
//            });
//
//
//
//            $jQ("#showonmap16").bind("click", function(){
//
//                infoWindow.close();
//
//                var marker = marker16;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str. Ștefan cel Mare 16, Balți</span><br>Tel.: 078 303 715<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setZoom(14);
//
//                map.setCenter(new google.maps.LatLng(47.762313,27.928228), 14);
//
//                $jQmcoff = $jQ("#map-canvas").offset();
//
//                $jQ('html, body').animate({scrollTop:$jQmcoff.top-10}, 300, 'easeInSine');
//
//            });
//
//
//
////Harta M15 end
////Harta  magazin Sculeanca
//
//            var marker22 = new google.maps.Marker({
//
//                map: map,
//
//                position: new google.maps.LatLng(47.0463907,28.711769)
//
//            });
//
//
//
//
//
//            google.maps.event.addListener(marker22, 'click', function(){
//
//                var marker = this;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str.Calea Ieșilor 1b</span><br>Tel.:  078 303 704<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setCenter(new google.maps.LatLng(47.0463907,28.711769), 14);
//
//                map.setZoom(14);
//
//            });
//
//
//
//            $jQ("#showonmap22").bind("click", function(){
//
//                infoWindow.close();
//
//                var marker = marker22;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str.Calea Ieșilor 1b</span><br>Tel.:  078 303 704<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setZoom(14);
//
//                map.setCenter(new google.maps.LatLng(47.0463907,28.711769), 14);
//
//                $jQmcoff = $jQ("#map-canvas").offset();
//
//                $jQ('html, body').animate({scrollTop:$jQmcoff.top-10}, 300, 'easeInSine');
//
//            })
//
//
//
////Harta  magazin Sculeanca end
////Harta magazin Edinet
//
//            var marker21 = new google.maps.Marker({
//
//                map: map,
//
//                position: new google.maps.LatLng(48.1680600,27.3050000)
//
//            });
//
//
//
//
//
//            google.maps.event.addListener(marker21, 'click', function(){
//
//                var marker = this;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str.Mihai Eminescu 1a</span><br>Tel.: 069616045<br>Luni - Vineri &nbsp;&nbsp;Sîmbătă-Duminică<br>09:00 - 18:00 &nbsp;&nbsp;09:00 - 14:00</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setCenter(new google.maps.LatLng(48.1680600,27.3050000), 14);
//
//                map.setZoom(14);
//
//            });
//
//
//
//            $jQ("#showonmap21").bind("click", function(){
//
//                infoWindow.close();
//
//                var marker = marker21;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str.Mihai Eminescu 1a</span><br>Tel.: 069616045<br>Luni - Vineri &nbsp;&nbsp;Sîmbătă-Duminică<br>09:00 - 18:00 &nbsp;&nbsp;09:00 - 14:00</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setZoom(14);
//
//                map.setCenter(new google.maps.LatLng(48.1680600,27.3050000), 14);
//
//                $jQmcoff = $jQ("#map-canvas").offset();
//
//                $jQ('html, body').animate({scrollTop:$jQmcoff.top-10}, 300, 'easeInSine');
//
//            });
//
//
//
////Harta  magazin Edinet end
//
//
////Harta magazin Angro
//
//            var markerAngro = new google.maps.Marker({
//
//                map: map,
//
//                position: new google.maps.LatLng(47.0046429,28.8101072)
//
//            });
//
//
//
//
//
//            google.maps.event.addListener(markerAngro, 'click', function(){
//
//                var marker = this;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str.Academiei 15/1</span><br>Luni - Vineri &nbsp;&nbsp;Sîmbătă-Duminică<br>08:30 - 18:30 &nbsp;&nbsp;&nbsp;&nbsp;zi liberă</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setCenter(new google.maps.LatLng(47.0046429,28.8101072), 14);
//
//                map.setZoom(14);
//
//            });
//
//
//
//            $jQ("#showonmapAngro").bind("click", function(){
//
//                infoWindow.close();
//
//                var marker = markerAngro;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str.Academiei 15/1</span><br>Luni - Vineri &nbsp;&nbsp;Sîmbătă-Duminică<br>08:30 - 18:30 &nbsp;&nbsp;&nbsp;&nbsp;zi liberă</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setZoom(14);
//
//                map.setCenter(new google.maps.LatLng(47.0046429,28.8101072), 14);
//
//                $jQmcoff = $jQ("#map-canvas").offset();
//
//                $jQ('html, body').animate({scrollTop:$jQmcoff.top-10}, 300, 'easeInSine');
//
//            });
//
//
//
////Harta  magazin Angro end
////Harta magazin Vasile Alexandri Balti
//
//            var markerBVAlexandri = new google.maps.Marker({
//
//                map: map,
//
//                position: new google.maps.LatLng(47.758624,27.9365091)
//
//            });
//
//
//
//
//
//            google.maps.event.addListener(markerBVAlexandri, 'click', function(){
//
//                var marker = this;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str.V.Alecsandrii 4, Balți</span><br>Luni - Sîmbătă &nbsp;&nbsp;&nbsp;&nbsp;Duminică<br>08:30 - 18:00 &nbsp;&nbsp;08:30 - 16:00</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setCenter(new google.maps.LatLng(47.758624,27.9365091), 14);
//
//                map.setZoom(14);
//
//            });
//
//
//
//            $jQ("#showonmapBL2").bind("click", function(){
//
//                infoWindow.close();
//
//                var marker = markerBVAlexandri;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str.V.Alecsandrii 4, Balți</span><br>Luni - Sîmbătă &nbsp;&nbsp;&nbsp;&nbsp;Duminică<br>08:30 - 18:00 &nbsp;&nbsp;08:30 - 16:00</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setZoom(14);
//
//                map.setCenter(new google.maps.LatLng(47.758624,27.9365091), 14);
//
//                $jQmcoff = $jQ("#map-canvas").offset();
//
//                $jQ('html, body').animate({scrollTop:$jQmcoff.top-10}, 300, 'easeInSine');
//
//            });
//
//
//
////Harta  magazin Vasile Alexandri Balti end
//
////Harta magazin Orhei
//
//            var markerOR = new google.maps.Marker({
//
//                map: map,
//
//                position: new google.maps.LatLng(47.3776642,28.8218536)
//
//            });
//
//
//
//
//
//            google.maps.event.addListener(markerOR, 'click', function(){
//
//                var marker = this;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str.V.Lupu 41, Orhei</span><br>Luni - Sîmbătă &nbsp;&nbsp;&nbsp;&nbsp;Duminică<br>08:30 - 18:30 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;zi liberă</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setCenter(new google.maps.LatLng(47.3776642,28.8218536), 14);
//
//                map.setZoom(14);
//
//            });
//
//
//
//            $jQ("#showonmapOR").bind("click", function(){
//
//                infoWindow.close();
//
//                var marker = markerOR;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str.V.Lupu 41, Orhei</span><br>Luni - Sîmbătă &nbsp;&nbsp;&nbsp;&nbsp;Duminică<br>08:30 - 18:30 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;zi liberă</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setZoom(14);
//
//                map.setCenter(new google.maps.LatLng(47.3776642,28.8218536), 14);
//
//                $jQmcoff = $jQ("#map-canvas").offset();
//
//                $jQ('html, body').animate({scrollTop:$jQmcoff.top-10}, 300, 'easeInSine');
//
//            });
//
//
//
////Harta  magazin Orhei end
//
////Harta magazin  31 August, Hînceşti
//
//            var markerHN = new google.maps.Marker({
//
//                map: map,
//
//                position: new google.maps.LatLng(47.3776642,28.8218536)
//
//            });
//
//
//
//
//
//            google.maps.event.addListener(markerHN, 'click', function(){
//
//                var marker = this;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str. 31 August, Hînceşti</span><br>Marți - Sîmbătă &nbsp;&nbsp;&nbsp;&nbsp;Duminică&nbsp;&nbsp;&nbsp;&nbsp;Luni<br>09:00 - 18:00 &nbsp;&nbsp;&nbsp;&nbsp;09:30 - 14:00 &nbsp;&nbsp;&nbsp;&nbsp;zi liberă</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setCenter(new google.maps.LatLng(47.3776642,28.8218536), 14);
//
//                map.setZoom(14);
//
//            });
//
//
//
//            $jQ("#showonmapHN").bind("click", function(){
//
//                infoWindow.close();
//
//                var marker = markerHN;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str. 31 August, Hînceşti</span><br>Marți - Sîmbătă &nbsp;&nbsp;&nbsp;&nbsp;Duminică&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Luni<br>09:00 - 18:00 &nbsp;&nbsp;&nbsp;&nbsp;09:30 - 14:00 &nbsp;&nbsp;&nbsp;&nbsp;zi liberă</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setZoom(14);
//
//                map.setCenter(new google.maps.LatLng(47.3776642,28.8218536), 14);
//
//                $jQmcoff = $jQ("#map-canvas").offset();
//
//                $jQ('html, body').animate({scrollTop:$jQmcoff.top-10}, 300, 'easeInSine');
//
//            });
//
//
//
////Harta  magazin  31 August, Hînceşti end
//
//
////Harta magazin Orhei
//
//            var markerSV = new google.maps.Marker({
//
//                map: map,
//
//                position: new google.maps.LatLng(46.5196759,29.6660489)
//
//            });
//
//
//
//
//
//            google.maps.event.addListener(markerSV, 'click', function(){
//
//                var marker = this;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str. 31 August, Stefan Voda</span><br>Luni - Sîmbătă &nbsp;&nbsp;&nbsp;&nbsp;Duminică<br>09:00 - 18:00 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;zi liberă</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setCenter(new google.maps.LatLng(46.5196759,29.6660489), 14);
//
//                map.setZoom(14);
//
//            });
//
//
//
//            $jQ("#showonmapSV").bind("click", function(){
//
//                infoWindow.close();
//
//                var marker = markerSV;
//
//                infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str. 31 August, Stefan Voda</span><br>Luni - Sîmbătă &nbsp;&nbsp;&nbsp;&nbsp;Duminică<br>09:00 - 18:00 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;zi liberă</div>');
//
//                infoWindow.open(map, marker);
//
//                map.setZoom(14);
//
//                map.setCenter(new google.maps.LatLng(46.5196759,29.6660489), 14);
//
//                $jQmcoff = $jQ("#map-canvas").offset();
//
//                $jQ('html, body').animate({scrollTop:$jQmcoff.top-10}, 300, 'easeInSine');
//
//            });
//
//
//
////Harta  magazin Orhei end
//        });



// Map.js
//    }
    /* Maps checking end */

    var news = $jQ(".browse-view .product.floatleft.width25");
    $jQ.each(news, function (idx, elem) {
        var odd = (idx % 4 == 0);
        if (odd)
            $jQ(elem).css("margin-left", "0px");
    });


    $jQ(".show-pop-up").click(function () {

        $jQ("#dialog-links-blocks").show();

    });
    $jQ(".popupClose").click(function () {
        $jQ("#dialog-links-blocks").hide();
    });

    $jQ(".marimi-dame").click(function () {
        $jQ(".pop-dame").show();
    });

    $jQ(".marimi-copii").click(function () {
        $jQ(".pop-copii").show();
    });
    $jQ(".marimi-barbati").click(function () {
        $jQ(".pop-barbati").show();
    });
    $jQ(".marimi-ado").click(function () {
        $jQ(".pop-ado").show();
    });
    $jQ(".simboluri-ro").click(function () {

        $jQ(".pop2").show();

    });
    $jQ(".marimi-ru").click(function () {

        $jQ(".pop3").show();

    });
    $jQ(".simboluri-ru").click(function () {

        $jQ(".pop4").show();

    });
    $jQ(".hidden-marimi").click(function () {
        $jQ(".pop1, .pop2, .pop3, .pop4").hide();
    });

    $jQ('.toggle1').click(function() {
        $jQ('.slider_m1').slideToggle("fast");
    });

    $jQ('.toggle2').click(function() {
        $jQ('.slider_m2').slideToggle("fast");
    });

    $jQ('.toggle3').click(function() {
        $jQ('.slider_m3').slideToggle("fast");
    });

    $jQ('.toggle5').click(function() {
        $jQ('.slider_m5').slideToggle("fast");
    });

    $jQ('.toggle6').click(function() {
        $jQ('.slider_m6').slideToggle("fast");
    });
    $jQ('.toggle7').click(function() {
        $jQ('.slider_m7').slideToggle("fast");
    });

    $jQ('.toggle8').click(function() {
        $jQ('.slider_m8').slideToggle("fast");
    });
    $jQ('.toggle9').click(function() {
        $jQ('.slider_m9').slideToggle("fast");
    });

    $jQ('.toggle10').click(function() {
        $jQ('.slider_m10').slideToggle("fast");
    });
    $jQ('.toggle11').click(function() {
        $jQ('.slider_m11').slideToggle("fast");
    });

    $jQ('.toggle12').click(function() {
        $jQ('.slider_m12').slideToggle("fast");
    });
    $jQ('.toggle13').click(function() {
        $jQ('.slider_m13').slideToggle("fast");
    });
    $jQ('.toggle14').click(function() {
        $jQ('.slider_m14').slideToggle("fast");
    });
    $jQ('.toggle15').click(function() {
        $jQ('.slider_m15').slideToggle("fast");
    });
    $jQ('.toggle21').click(function() {
        $jQ('.slider_m21').slideToggle("fast");
    });
    $jQ('.toggle22').click(function() {
        $jQ('.slider_m22').slideToggle("fast");
    });
    $jQ('.toggleSV').click(function() {
        $jQ('.slider_SV').slideToggle("fast");
    });
    $jQ('.toggleHN').click(function() {
        $jQ('.slider_HN').slideToggle("fast");
    });
    $jQ('.toggleTudorVladimirescu').click(function() {
        $jQ('.slider_TudorVladimirescu').slideToggle("fast");
    });
    $jQ('.toggleBL2').click(function() {
        $jQ('.slider_BL2').slideToggle("fast");
    });
    $jQ('.toggleOR').click(function() {
        $jQ('.slider_OR').slideToggle("fast");
    });
    $jQ('.toggleAngro').click(function() {
        $jQ('.slider_Angro').slideToggle("fast");
    });
    //$jQ( ".mobile-menu .moduletable_menu > ul").hide();
    $jQ('.fa-bars').click(function(){
        $jQ( ".mobile-menu .moduletable_menu > ul" ).toggle( "medium", function() {
            // Animation complete.
        });
    });

    $jQ('.mobile-menu .moduletable_menu > ul > li').click(function(){
        $jQ(this).children('ul').toggle( "medium", function() { });
        $jQ(this).toggleClass("super-active");
    });

    var wishlist = $jQ('.modEasyCompareItem').length;
    $jQ( ".whishlist-count").append(wishlist);
    $jQ( ".produse-recent-vizualizate").hide();


});



