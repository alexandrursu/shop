

  google.maps.event.addDomListener(window, 'load', function() {

    var map = new google.maps.Map(document.getElementById('map-canvas'), {

      zoom: 11,

      center: new google.maps.LatLng(47.027897, 28.840656),

      mapTypeId: google.maps.MapTypeId.ROADMAP,

      scrollwheel: false

    });



    var infoWindow = new google.maps.InfoWindow;



    google.maps.event.addListener(map, 'click', function() {

      infoWindow.close();

    });

	

//Harta M2 start

        var marker2 = new google.maps.Marker({

        map: map,

        position: new google.maps.LatLng(47.023822,28.834295)

      });

  

  

      google.maps.event.addListener(marker2, 'click', function(){

        var marker = this;

        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">Gemenii, St.cel Mare 136; but. 29/1</span><br>Tel.: 078 303 702<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');

        infoWindow.open(map, marker);

        map.setCenter(new google.maps.LatLng(47.023822,28.834295), 14);        

        map.setZoom(14);

      });

      

      $("#showonmap2").bind("click", function(){

        infoWindow.close();

        var marker = marker2;

        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">Gemenii, St.cel Mare 136; but. 29/1</span><br>Tel.: 078 303 702<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');

        infoWindow.open(map, marker);

        map.setZoom(14);

        map.setCenter(new google.maps.LatLng(47.023822,28.834295), 14);

        $mcoff = $("#map-canvas").offset();

        $('html, body').animate({scrollTop:$mcoff.top-10}, 300, 'easeInSine');

      })  

//Harta M2 end

//Harta M3 start

        var marker3 = new google.maps.Marker({

        map: map,

        position: new google.maps.LatLng(47.017161, 28.835203)

      });

  

  

      google.maps.event.addListener(marker3, 'click', function(){

        var marker = this;

        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str.Armeneasca 33</span><br>Tel.: 078 303 703<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');

        infoWindow.open(map, marker);

        map.setCenter(new google.maps.LatLng(47.017161, 28.835203), 14);        

        map.setZoom(14);

      });

      

      $("#showonmap3").bind("click", function(){

        infoWindow.close();

        var marker = marker3;

        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str.Armeneasca 33</span><br>Tel.: 078 303 703<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');

        infoWindow.open(map, marker);

        map.setZoom(14);

        map.setCenter(new google.maps.LatLng(47.017161, 28.835203), 14);

        $mcoff = $("#map-canvas").offset();

        $('html,body').animate({scrollTop:$mcoff.top-10}, 300, 'easeInSine');

      })  

//Harta M3 end

//Harta M4 start

        var marker4 = new google.maps.Marker({

        map: map,

        position: new google.maps.LatLng(46.9933412, 28.8656847)

      });

  

  

      google.maps.event.addListener(marker4, 'click', function(){

        var marker = this;

        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str.Zelinski 6/1</span><br>Tel.: 078 303 704<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');

        infoWindow.open(map, marker);

        map.setCenter(new google.maps.LatLng(46.9933412, 28.8656847), 14);        

        map.setZoom(14);

      });

      

      $("#showonmap4").bind("click", function(){

        infoWindow.close();

        var marker = marker4;

        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str.Zelinski 6/1</span><br>Tel.: 078 303 704<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');

        infoWindow.open(map, marker);

        map.setZoom(14);

        map.setCenter(new google.maps.LatLng(46.9933412, 28.8656847), 14);

        $mcoff = $("#map-canvas").offset();

        $('html,body').animate({scrollTop:$mcoff.top-10}, 300, 'easeInSine');

      })  

//Harta M4 end

//Harta M5 start

        var marker5 = new google.maps.Marker({

        map: map,

        position: new google.maps.LatLng(47.0288078, 28.7982143)

      });

  

  

      google.maps.event.addListener(marker5, 'click', function(){

        var marker = this;

        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str.Ion Creanga 76 nr 65</span><br>Tel.: 078 303 705<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');

        infoWindow.open(map, marker);

        map.setCenter(new google.maps.LatLng(47.0288078, 28.7982143), 14);        

        map.setZoom(14);

      });

      

      $("#showonmap5").bind("click", function(){

        infoWindow.close();

        var marker = marker5;

        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str.Ion Creanga 76 nr 65</span><br>Tel.: 078 303 705<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');

        infoWindow.open(map, marker);

        map.setZoom(14);

        map.setCenter(new google.maps.LatLng(47.0288078, 28.7982143), 14);

        $mcoff = $("#map-canvas").offset();

        $('html, body').animate({scrollTop:$mcoff.top-10}, 300, 'easeInSine');

      })  

//Harta M5 end

//Harta M6 start	  

        var marker6 = new google.maps.Marker({

        map: map,

        position: new google.maps.LatLng(46.9917129,28.8565215)

      });

  

  

      google.maps.event.addListener(marker6, 'click', function(){

        var marker = this;

        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">bd.  Decebal 63   </span><br>Tel.: 078 303 706<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - &nbsp;&nbsp;20:00 10:00 - 17:00</div>');

        infoWindow.open(map, marker);

        map.setCenter(new google.maps.LatLng(46.9917129,28.8565215), 14);        

        map.setZoom(14);

      });

      

      $("#showonmap6").bind("click", function(){

        infoWindow.close();

        var marker = marker6;

        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">bd.  Decebal 63   </span><br>Tel.: 078 303 706<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');

        infoWindow.open(map, marker);

        map.setZoom(14);

        map.setCenter(new google.maps.LatLng(46.9917129,28.8565215), 14);

        $mcoff = $("#map-canvas").offset();

        $('html, body').animate({scrollTop:$mcoff.top-10}, 300, 'easeInSine');

      })    

       

//Harta M6 end

//Harta M7 start

	   var marker7 = new google.maps.Marker({

        map: map,

        position: new google.maps.LatLng(47.043498, 28.865159)

      });

  

  

      google.maps.event.addListener(marker7, 'click', function(){

        var marker = this;

        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">Aleco Russo 4</span><br>Tel.: 078 303 707<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');

        infoWindow.open(map, marker);

        map.setCenter(new google.maps.LatLng(47.043498, 28.865159), 14);        

        map.setZoom(14);

      });

      

      $("#showonmap7").bind("click", function(){

        infoWindow.close();

        var marker = marker7;

        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">Aleco Russo 4</span><br>Tel.: 078 303 707<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');

        infoWindow.open(map, marker);

        map.setZoom(14);

        map.setCenter(new google.maps.LatLng(47.043498, 28.865159), 14);

        $mcoff = $("#map-canvas").offset();

        $('html, body').animate({scrollTop:$mcoff.top-10}, 300, 'easeInSine');

      })   



//Harta M7 end

//Harta M8 start

	   var marker8 = new google.maps.Marker({

        map: map,

        position: new google.maps.LatLng(47.019019, 28.837928)

      });

  

  

      google.maps.event.addListener(marker8, 'click', function(){

        var marker = this;

        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">Armeneasca 42</span><br>Tel.: 078 303 708<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');

        infoWindow.open(map, marker);

        map.setCenter(new google.maps.LatLng(47.019019, 28.837928), 14);        

        map.setZoom(14);

      });

      

      $("#showonmap8").bind("click", function(){

        infoWindow.close();

        var marker = marker8;

        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">Armeneasca 42</span><br>Tel.: 078 303 708<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');

        infoWindow.open(map, marker);

        map.setZoom(14);

        map.setCenter(new google.maps.LatLng(47.019019, 28.837928), 14);

        $mcoff = $("#map-canvas").offset();

        $('html, body').animate({scrollTop:$mcoff.top-10}, 300, 'easeInSine');

      })   



//Harta M8 end



//Harta M9 start

	   var marker9 = new google.maps.Marker({

        map: map,

        position: new google.maps.LatLng(47.0304596,28.8400528)

      });

  

  

      google.maps.event.addListener(marker9, 'click', function(){

        var marker = this;

        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">Grigore Vieru nr.13</span><br>Tel.: 078 303 709<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');

        infoWindow.open(map, marker);

        map.setCenter(new google.maps.LatLng(47.0304596,28.8400528), 14);        

        map.setZoom(14);

      });

      

      $("#showonmap9").bind("click", function(){

        infoWindow.close();

        var marker = marker9;

        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">Grigore Vieru nr.13</span><br>Tel.: 078 303 709<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');

        infoWindow.open(map, marker);

        map.setZoom(14);

        map.setCenter(new google.maps.LatLng(47.0304596,28.8400528), 14);

        $mcoff = $("#map-canvas").offset();

        $('html, body').animate({scrollTop:$mcoff.top-10}, 300, 'easeInSine');

      })   



//Harta M9 end



//Harta M10 start

	   var marker10 = new google.maps.Marker({

        map: map,

        position: new google.maps.LatLng(47.054271, 28.866025)

      });

  

  

      google.maps.event.addListener(marker10, 'click', function(){

        var marker = this;

        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">bd. Moscovei 16</span><br>Tel.: 078 303 710<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');

        infoWindow.open(map, marker);

        map.setCenter(new google.maps.LatLng(47.054271, 28.866025), 14);        

        map.setZoom(14);

      });

      

      $("#showonmap10").bind("click", function(){

        infoWindow.close();

        var marker = marker10;

        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">bd. Moscovei 16</span><br>Tel.: 078 303 710<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');

        infoWindow.open(map, marker);

        map.setZoom(14);

        map.setCenter(new google.maps.LatLng(47.054271, 28.866025), 14);

        $mcoff = $("#map-canvas").offset();

        $('html, body').animate({scrollTop:$mcoff.top-10}, 300, 'easeInSine');

      })   



//Harta M10 end



//Harta M11 start

	   var marker11 = new google.maps.Marker({

        map: map,

        position: new google.maps.LatLng(47.0436798,28.8579281)

      });

  

  

      google.maps.event.addListener(marker11, 'click', function(){

        var marker = this;

        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">bd. Bogdan Voievod 2 ap 145</span><br>Tel.: 078 303 711<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');

        infoWindow.open(map, marker);

        map.setCenter(new google.maps.LatLng(47.0436798,28.8579281), 14);        

        map.setZoom(14);

      });

      

      $("#showonmap11").bind("click", function(){

        infoWindow.close();

        var marker = marker11;

        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">bd. Bogdan Voievod 2 ap 145</span><br>Tel.: 078 303 711<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');

        infoWindow.open(map, marker);

        map.setZoom(14);

        map.setCenter(new google.maps.LatLng(47.0436798,28.8579281), 14);

        $mcoff = $("#map-canvas").offset();

        $('html, body').animate({scrollTop:$mcoff.top-10}, 300, 'easeInSine');

      })   



//Harta M11 end



//Harta M12 start

	   var marker12 = new google.maps.Marker({

        map: map,

        position: new google.maps.LatLng(47.0320132,28.8218661)

      });

  

  

      google.maps.event.addListener(marker12, 'click', function(){

        var marker = this;

        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">bd. Stefan cel Mare nr 184</span><br>Tel.: 078 303 712<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');

        infoWindow.open(map, marker);

        map.setCenter(new google.maps.LatLng(47.0320132,28.8218661), 14);        

        map.setZoom(14);

      });

      

      $("#showonmap12").bind("click", function(){

        infoWindow.close();

        var marker = marker12;

        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">bd. Stefan cel Mare nr 184</span><br>Tel.: 078 303 712<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');

        infoWindow.open(map, marker);

        map.setZoom(14);

        map.setCenter(new google.maps.LatLng(47.0320132,28.8218661), 14);

        $mcoff = $("#map-canvas").offset();

        $('html, body').animate({scrollTop:$mcoff.top-10}, 300, 'easeInSine');

      })   



//Harta M12 end



//Harta M13 start

	   var marker13 = new google.maps.Marker({

        map: map,

        position: new google.maps.LatLng(47.038449, 28.888916)

      });

  

  

      google.maps.event.addListener(marker13, 'click', function(){

        var marker = this;

        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">bd. Mircea cel Batrin 3</span><br>Tel.: 078 303 713<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');

        infoWindow.open(map, marker);

        map.setCenter(new google.maps.LatLng(47.038449, 28.888916), 14);        

        map.setZoom(14);

      });

      

      $("#showonmap13").bind("click", function(){

        infoWindow.close();

        var marker = marker13;

        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">bd. Mircea cel Batrin 3</span><br>Tel.: 078 303 713<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');

        infoWindow.open(map, marker);

        map.setZoom(14);

        map.setCenter(new google.maps.LatLng(47.038449, 28.888916), 14);

        $mcoff = $("#map-canvas").offset();

        $('html, body').animate({scrollTop:$mcoff.top-10}, 300, 'easeInSine');

      })   



//Harta M13 end



//Harta M14 start

	   var marker14 = new google.maps.Marker({

        map: map,

        position: new google.maps.LatLng(46.9983693,28.8536925)

      });

  

  

      google.maps.event.addListener(marker14, 'click', function(){

        var marker = this;

        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str. Trandafirilor 15/1</span><br>Tel.: 078 303 714<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');

        infoWindow.open(map, marker);

        map.setCenter(new google.maps.LatLng(46.9983693,28.8536925), 14);        

        map.setZoom(14);

      });

      

      $("#showonmap14").bind("click", function(){

        infoWindow.close();

        var marker = marker14;

        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str. Trandafirilor 15/1</span><br>Tel.: 078 303 714<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');

        infoWindow.open(map, marker);

        map.setZoom(14);

        map.setCenter(new google.maps.LatLng(46.9983693,28.8536925), 14);

        $mcoff = $("#map-canvas").offset();

        $('html, body').animate({scrollTop:$mcoff.top-10}, 300, 'easeInSine');

      })   



//Harta M14 end



//Harta str. Ștefan cel Mare 16, Balti

	   var marker15 = new google.maps.Marker({

        map: map,

        position: new google.maps.LatLng(46.9914394,28.8518894)

      });

  

  

      google.maps.event.addListener(marker15, 'click', function(){

        var marker = this;

        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str. Dacia 3/3</span><br>Tel.: tel: 078 303 817<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');

        infoWindow.open(map, marker);

        map.setCenter(new google.maps.LatLng(46.9914394,28.8518894), 14);        

        map.setZoom(14);

      });

      

      $("#showonmap15").bind("click", function(){

        infoWindow.close();

        var marker = marker15;

        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str. Dacia 3/3</span><br>Tel.: tel: 078 303 817<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');

        infoWindow.open(map, marker);

        map.setZoom(14);

        map.setCenter(new google.maps.LatLng(46.9914394,28.8518894), 14);

        $mcoff = $("#map-canvas").offset();

        $('html, body').animate({scrollTop:$mcoff.top-10}, 300, 'easeInSine');

      })   



//Harta str. Ștefan cel Mare 16, Balti end	  



//Harta M15 start

	   var marker16 = new google.maps.Marker({

        map: map,

        position: new google.maps.LatLng(47.762313,27.928228)

      });

  

  

      google.maps.event.addListener(marker16, 'click', function(){

        var marker = this;

        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str. Ștefan cel Mare 16, Balți</span><br>Tel.: 078 303 715<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');

        infoWindow.open(map, marker);

        map.setCenter(new google.maps.LatLng(47.762313,27.928228), 14);        

        map.setZoom(14);

      });

      

      $("#showonmap16").bind("click", function(){

        infoWindow.close();

        var marker = marker16;

        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str. Ștefan cel Mare 16, Balți</span><br>Tel.: 078 303 715<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');

        infoWindow.open(map, marker);

        map.setZoom(14);

        map.setCenter(new google.maps.LatLng(47.762313,27.928228), 14);

        $mcoff = $("#map-canvas").offset();

        $('html, body').animate({scrollTop:$mcoff.top-10}, 300, 'easeInSine');

      })   



//Harta M15 end	



//Harta magazin Edinet

     var marker21 = new google.maps.Marker({

        map: map,

        position: new google.maps.LatLng(46.9914394,28.8518894)

      });

  

  

      google.maps.event.addListener(marker21, 'click', function(){

        var marker = this;

        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str.Mihai Eminescu 1a</span><br>Tel.: 069616045<br>Luni - Vineri &nbsp;&nbsp;Sîmbătă-Duminică<br>09:00 - 18:00 &nbsp;&nbsp;09:00 - 14:00</div>');

        infoWindow.open(map, marker);

        map.setCenter(new google.maps.LatLng(48.1680600,27.3050000), 14);        

        map.setZoom(14);

      });

      

      $("#showonmap21").bind("click", function(){

        infoWindow.close();

        var marker = marker21;

        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str.Mihai Eminescu 1a</span><br>Tel.: 069616045<br>Luni - Vineri &nbsp;&nbsp;Sîmbătă-Duminică<br>09:00 - 18:00 &nbsp;&nbsp;09:00 - 14:00</div>');

        infoWindow.open(map, marker);

        map.setZoom(14);

        map.setCenter(new google.maps.LatLng(48.1680600,27.3050000), 14);

        $mcoff = $("#map-canvas").offset();

        $('html, body').animate({scrollTop:$mcoff.top-10}, 300, 'easeInSine');

      })   



//Harta  magazin Edinet end


//Harta magazin Sculeanca

     var marker22 = new google.maps.Marker({

        map: map,

        position: new google.maps.LatLng(46.9914394,28.8518894)

      });

  

  

      google.maps.event.addListener(marker22, 'click', function(){

        var marker = this;

        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str.Calea Ieșilor 1b</span><br>Tel.:  078 303 704<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');

        infoWindow.open(map, marker);

        map.setCenter(new google.maps.LatLng(47.0463907,28.711769), 14);        

        map.setZoom(14);

      });

      

      $("#showonmap22").bind("click", function(){

        infoWindow.close();

        var marker = marker22;

        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str.Calea Ieșilor 1b</span><br>Tel.:  078 303 704<br>Luni - Sîmbătă &nbsp;&nbsp;Duminică<br>09:00 - 20:00 &nbsp;&nbsp;10:00 - 17:00</div>');

        infoWindow.open(map, marker);

        map.setZoom(14);

        map.setCenter(new google.maps.LatLng(47.0463907,28.711769), 14);

        $mcoff = $("#map-canvas").offset();

        $('html, body').animate({scrollTop:$mcoff.top-10}, 300, 'easeInSine');

      })   



//Harta  magazin Sculeanca end
  

      });



