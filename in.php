<!DOCTYPE html>
<html>
<head>
<title>Restaurante :: La Placinte</title>



<script type="text/javascript" src="http://www.laplacinte.md/js/al_ext_nogzip.js?d=1"></script>





</head>
<body>





<!-- content -->


<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&hl=ro"></script>
<script>

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
          var marker8 = new google.maps.Marker({
        map: map,
        position: new google.maps.LatLng(47.04454824948344, 28.89097033645635)
      });
  
  
      google.maps.event.addListener(marker8, 'click', function(){
        var marker = this;
        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">bul. Mircea cel Bătrân, 12/5</span><br>Tel. 022 265 441<br>10.00 - 23.00<br>Fără zile de odihnă</div>');
        infoWindow.open(map, marker);
        map.setCenter(new google.maps.LatLng(47.04454824948344, 28.89097033645635), 14);        
        map.setZoom(14);
      });
      
      $("#showonmap8").bind("click", function(){
        infoWindow.close();
        var marker = marker8;
        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">bul. Mircea cel Bătrân, 12/5</span><br>Tel. 022 265 441<br>10.00 - 23.00<br>Fără zile de odihnă</div>');
        infoWindow.open(map, marker);
        map.setZoom(14);
        map.setCenter(new google.maps.LatLng(47.04454824948344, 28.89097033645635), 14);
        $mcoff = $("#map-canvas").offset();
        $('html, body').animate({scrollTop:$mcoff.top-10}, 300, 'easeInSine');
      })    
          var marker5 = new google.maps.Marker({
        map: map,
        position: new google.maps.LatLng(47.043923159975094, 28.861626969833424)
      });
  
  
      google.maps.event.addListener(marker5, 'click', function(){
        var marker = this;
        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str. Kiev, 16/1</span><br>Tel. 022 265 437<br>10.00 - 23.00<br>Fără zile de odihnă</div>');
        infoWindow.open(map, marker);
        map.setCenter(new google.maps.LatLng(47.043923159975094, 28.861626969833424), 14);        
        map.setZoom(14);
      });
      
      $("#showonmap5").bind("click", function(){
        infoWindow.close();
        var marker = marker5;
        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str. Kiev, 16/1</span><br>Tel. 022 265 437<br>10.00 - 23.00<br>Fără zile de odihnă</div>');
        infoWindow.open(map, marker);
        map.setZoom(14);
        map.setCenter(new google.maps.LatLng(47.043923159975094, 28.861626969833424), 14);
        $mcoff = $("#map-canvas").offset();
        $('html, body').animate({scrollTop:$mcoff.top-10}, 300, 'easeInSine');
      })    
          var marker7 = new google.maps.Marker({
        map: map,
        position: new google.maps.LatLng(47.05518826946362, 28.865339147110035)
      });
  
  
      google.maps.event.addListener(marker7, 'click', function(){
        var marker = this;
        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">bd. Moscovei, 9/1</span><br>Tel. 022 265 440<br>10.00 - 22.00<br>Fără zile de odihnă</div>');
        infoWindow.open(map, marker);
        map.setCenter(new google.maps.LatLng(47.05518826946362, 28.865339147110035), 14);        
        map.setZoom(14);
      });
      
      $("#showonmap7").bind("click", function(){
        infoWindow.close();
        var marker = marker7;
        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">bd. Moscovei, 9/1</span><br>Tel. 022 265 440<br>10.00 - 22.00<br>Fără zile de odihnă</div>');
        infoWindow.open(map, marker);
        map.setZoom(14);
        map.setCenter(new google.maps.LatLng(47.05518826946362, 28.865339147110035), 14);
        $mcoff = $("#map-canvas").offset();
        $('html, body').animate({scrollTop:$mcoff.top-10}, 300, 'easeInSine');
      })    
          var marker9 = new google.maps.Marker({
        map: map,
        position: new google.maps.LatLng(47.03167943344726, 28.82226823474889)
      });
  
  
      google.maps.event.addListener(marker9, 'click', function(){
        var marker = this;
        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">bul. Ștefan cel Mare, 182</span><br>Tel. 022 265 442<br>10.00 - 23.00<br>Fără zile de odihnă</div>');
        infoWindow.open(map, marker);
        map.setCenter(new google.maps.LatLng(47.03167943344726, 28.82226823474889), 14);        
        map.setZoom(14);
      });
      
      $("#showonmap9").bind("click", function(){
        infoWindow.close();
        var marker = marker9;
        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">bul. Ștefan cel Mare, 182</span><br>Tel. 022 265 442<br>10.00 - 23.00<br>Fără zile de odihnă</div>');
        infoWindow.open(map, marker);
        map.setZoom(14);
        map.setCenter(new google.maps.LatLng(47.03167943344726, 28.82226823474889), 14);
        $mcoff = $("#map-canvas").offset();
        $('html, body').animate({scrollTop:$mcoff.top-10}, 300, 'easeInSine');
      })    
          var marker13 = new google.maps.Marker({
        map: map,
        position: new google.maps.LatLng(47.027575017692364, 28.833619343299915)
      });
  
  
      google.maps.event.addListener(marker13, 'click', function(){
        var marker = this;
        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str. Mitropolit Dosoftei, 100</span><br>Tel. 022 265 430<br>08.00 - 22.00<br>Fără zile de odihnă</div>');
        infoWindow.open(map, marker);
        map.setCenter(new google.maps.LatLng(47.027575017692364, 28.833619343299915), 14);        
        map.setZoom(14);
      });
      
      $("#showonmap13").bind("click", function(){
        infoWindow.close();
        var marker = marker13;
        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str. Mitropolit Dosoftei, 100</span><br>Tel. 022 265 430<br>08.00 - 22.00<br>Fără zile de odihnă</div>');
        infoWindow.open(map, marker);
        map.setZoom(14);
        map.setCenter(new google.maps.LatLng(47.027575017692364, 28.833619343299915), 14);
        $mcoff = $("#map-canvas").offset();
        $('html, body').animate({scrollTop:$mcoff.top-10}, 300, 'easeInSine');
      })    
          var marker11 = new google.maps.Marker({
        map: map,
        position: new google.maps.LatLng(47.017048354049635, 28.84697137977605)
      });
  
  
      google.maps.event.addListener(marker11, 'click', function(){
        var marker = this;
        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str. Izmail, 45</span><br>Tel. 022 265 421<br>09.00 - 23.00<br>Fără zile de odihnă</div>');
        infoWindow.open(map, marker);
        map.setCenter(new google.maps.LatLng(47.017048354049635, 28.84697137977605), 14);        
        map.setZoom(14);
      });
      
      $("#showonmap11").bind("click", function(){
        infoWindow.close();
        var marker = marker11;
        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str. Izmail, 45</span><br>Tel. 022 265 421<br>09.00 - 23.00<br>Fără zile de odihnă</div>');
        infoWindow.open(map, marker);
        map.setZoom(14);
        map.setCenter(new google.maps.LatLng(47.017048354049635, 28.84697137977605), 14);
        $mcoff = $("#map-canvas").offset();
        $('html, body').animate({scrollTop:$mcoff.top-10}, 300, 'easeInSine');
      })    
          var marker12 = new google.maps.Marker({
        map: map,
        position: new google.maps.LatLng(47.01058907137253, 28.85976015235906)
      });
  
  
      google.maps.event.addListener(marker12, 'click', function(){
        var marker = this;
        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str. Iurie Gagarin, 5/3</span><br>Tel. 022 265 452<br>10.00- 00.00<br>Fără zile de odihnă</div>');
        infoWindow.open(map, marker);
        map.setCenter(new google.maps.LatLng(47.01058907137253, 28.85976015235906), 14);        
        map.setZoom(14);
      });
      
      $("#showonmap12").bind("click", function(){
        infoWindow.close();
        var marker = marker12;
        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str. Iurie Gagarin, 5/3</span><br>Tel. 022 265 452<br>10.00- 00.00<br>Fără zile de odihnă</div>');
        infoWindow.open(map, marker);
        map.setZoom(14);
        map.setCenter(new google.maps.LatLng(47.01058907137253, 28.85976015235906), 14);
        $mcoff = $("#map-canvas").offset();
        $('html, body').animate({scrollTop:$mcoff.top-10}, 300, 'easeInSine');
      })    
          var marker1 = new google.maps.Marker({
        map: map,
        position: new google.maps.LatLng(47.02954709025683, 28.799114816913743)
      });
  
  
      google.maps.event.addListener(marker1, 'click', function(){
        var marker = this;
        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str. Ion Creangă,64</span><br>Tel. 022 265 431<br>11.00 - 22.00<br>Fără zile de odihnă</div>');
        infoWindow.open(map, marker);
        map.setCenter(new google.maps.LatLng(47.02954709025683, 28.799114816913743), 14);        
        map.setZoom(14);
      });
      
      $("#showonmap1").bind("click", function(){
        infoWindow.close();
        var marker = marker1;
        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str. Ion Creangă,64</span><br>Tel. 022 265 431<br>11.00 - 22.00<br>Fără zile de odihnă</div>');
        infoWindow.open(map, marker);
        map.setZoom(14);
        map.setCenter(new google.maps.LatLng(47.02954709025683, 28.799114816913743), 14);
        $mcoff = $("#map-canvas").offset();
        $('html, body').animate({scrollTop:$mcoff.top-10}, 300, 'easeInSine');
      })    
          var marker2 = new google.maps.Marker({
        map: map,
        position: new google.maps.LatLng(46.988375589659256, 28.85783014110575)
      });
  
  
      google.maps.event.addListener(marker2, 'click', function(){
        var marker = this;
        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str. Decebal, 82</span><br>Tel. 022 265 433<br>10.00 - 22.00<br>Без выходных</div>');
        infoWindow.open(map, marker);
        map.setCenter(new google.maps.LatLng(46.988375589659256, 28.85783014110575), 14);        
        map.setZoom(14);
      });
      
      $("#showonmap2").bind("click", function(){
        infoWindow.close();
        var marker = marker2;
        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str. Decebal, 82</span><br>Tel. 022 265 433<br>10.00 - 22.00<br>Без выходных</div>');
        infoWindow.open(map, marker);
        map.setZoom(14);
        map.setCenter(new google.maps.LatLng(46.988375589659256, 28.85783014110575), 14);
        $mcoff = $("#map-canvas").offset();
        $('html, body').animate({scrollTop:$mcoff.top-10}, 300, 'easeInSine');
      })    
          var marker3 = new google.maps.Marker({
        map: map,
        position: new google.maps.LatLng(46.97936063103853, 28.867286430854847)
      });
  
  
      google.maps.event.addListener(marker3, 'click', function(){
        var marker = this;
        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">bul. Dacia, 47/6</span><br>Tel. 022 265 435<br>10.00 - 23.00<br>Fără zile de odihnă</div>');
        infoWindow.open(map, marker);
        map.setCenter(new google.maps.LatLng(46.97936063103853, 28.867286430854847), 14);        
        map.setZoom(14);
      });
      
      $("#showonmap3").bind("click", function(){
        infoWindow.close();
        var marker = marker3;
        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">bul. Dacia, 47/6</span><br>Tel. 022 265 435<br>10.00 - 23.00<br>Fără zile de odihnă</div>');
        infoWindow.open(map, marker);
        map.setZoom(14);
        map.setCenter(new google.maps.LatLng(46.97936063103853, 28.867286430854847), 14);
        $mcoff = $("#map-canvas").offset();
        $('html, body').animate({scrollTop:$mcoff.top-10}, 300, 'easeInSine');
      })    
          var marker4 = new google.maps.Marker({
        map: map,
        position: new google.maps.LatLng(46.99374590902548, 28.850898133773853)
      });
  
  
      google.maps.event.addListener(marker4, 'click', function(){
        var marker = this;
        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str. Zelinski, 36/1</span><br>Tel. 022 265 438 <br>11.00 - 23.00<br>Fără zile de odihnă</div>');
        infoWindow.open(map, marker);
        map.setCenter(new google.maps.LatLng(46.99374590902548, 28.850898133773853), 14);        
        map.setZoom(14);
      });
      
      $("#showonmap4").bind("click", function(){
        infoWindow.close();
        var marker = marker4;
        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str. Zelinski, 36/1</span><br>Tel. 022 265 438 <br>11.00 - 23.00<br>Fără zile de odihnă</div>');
        infoWindow.open(map, marker);
        map.setZoom(14);
        map.setCenter(new google.maps.LatLng(46.99374590902548, 28.850898133773853), 14);
        $mcoff = $("#map-canvas").offset();
        $('html, body').animate({scrollTop:$mcoff.top-10}, 300, 'easeInSine');
      })    
          var marker6 = new google.maps.Marker({
        map: map,
        position: new google.maps.LatLng(47.04258522448186, 28.794003116149952)
      });
  
  
      google.maps.event.addListener(marker6, 'click', function(){
        var marker = this;
        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str. Calea Ieșilor, 43/3</span><br>Tel. 022 265 439<br>10.00 - 23.00<br>Fără zile de odihnă</div>');
        infoWindow.open(map, marker);
        map.setCenter(new google.maps.LatLng(47.04258522448186, 28.794003116149952), 14);        
        map.setZoom(14);
      });
      
      $("#showonmap6").bind("click", function(){
        infoWindow.close();
        var marker = marker6;
        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str. Calea Ieșilor, 43/3</span><br>Tel. 022 265 439<br>10.00 - 23.00<br>Fără zile de odihnă</div>');
        infoWindow.open(map, marker);
        map.setZoom(14);
        map.setCenter(new google.maps.LatLng(47.04258522448186, 28.794003116149952), 14);
        $mcoff = $("#map-canvas").offset();
        $('html, body').animate({scrollTop:$mcoff.top-10}, 300, 'easeInSine');
      })    
          var marker10 = new google.maps.Marker({
        map: map,
        position: new google.maps.LatLng(47.003997310562696, 28.818379031677296)
      });
  
  
      google.maps.event.addListener(marker10, 'click', function(){
        var marker = this;
        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str. Șoseaua Hâncești, 58</span><br>Tel. 022 265 443<br>10.00 - 22.00<br>Fără zile de odihnă</div>');
        infoWindow.open(map, marker);
        map.setCenter(new google.maps.LatLng(47.003997310562696, 28.818379031677296), 14);        
        map.setZoom(14);
      });
      
      $("#showonmap10").bind("click", function(){
        infoWindow.close();
        var marker = marker10;
        infoWindow.setContent('<div class="googleinfowindow"><span style="white-space: nowrap;">str. Șoseaua Hâncești, 58</span><br>Tel. 022 265 443<br>10.00 - 22.00<br>Fără zile de odihnă</div>');
        infoWindow.open(map, marker);
        map.setZoom(14);
        map.setCenter(new google.maps.LatLng(47.003997310562696, 28.818379031677296), 14);
        $mcoff = $("#map-canvas").offset();
        $('html, body').animate({scrollTop:$mcoff.top-10}, 300, 'easeInSine');
      })    
      });

  

</script>

<div class="cl content-wrap">
  <div id="menu-content-list">
    <h1>Magazine</h1>
      <div class="hr1 mr1"></div>
        <div class="rm3"><div id="map-canvas" style="width:100%; height:399px"></div></div>
         <h2 class="mr1">Chișinău</h2>
          <span class="showonmap" id="showonmap8">vezi pe hartă</span>
          <span class="showonmap" id="showonmap9">vezi pe hartă</span>
          <span class="showonmap" id="showonmap7">vezi pe hartă</span>
</div>
</div>
</div>

<!-- //content -->




</body>
</html>