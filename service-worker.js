self.addEventListener('install', event => {
    console.log("Service Worker installeren");
    event.waitUntil(
    caches.open('brakdag-1').then(function(cache) {
      return cache.addAll([
        '/style/design.css',
        '/style/font-awesome.min.css',
        '/style/weather-icons.min.css',
        '/js/brakdag.js',
        '/js/date-nl-NL.js',
        '/js/showads.js',
        'fonts/FontAwesome.otf',
        'fonts/fontawesome-webfont.eot',
        'fonts/fontawesome-webfont.svg',
        'fonts/fontawesome-webfont.ttf',
        'fonts/fontawesome-webfont.woff',
        'fonts/fontawesome-webfont.woff2',
        'fonts/weathericons-regular-webfont.eot',
        'fonts/weathericons-regular-webfont.svg',
        'fonts/weathericons-regular-webfont.ttf',
        'fonts/weathericons-regular-webfont.woff',
        'fonts/weathericons-regular-webfont.woff2',
        'frames/info-page.php',
        'img/logo_rtvnoord.png',
        'img/logo_oog.png',
        'img/logo_gezinsbode.png',
        'img/logo_gic.png',
        'img/logo_dichtbij.png',
        'img/logo_toerisme.png',
        'img/logo_sk.png',
        'img/logo_uk.png',
        'img/logo_nu.png',
        'img/logo_paal.png',
        'img/logo_bereikbaar.png',
        'img/logo_bereikbaar.png',
        'img/logo_bereikbaar.png',
        'img/logo_smaak.PNG',
        'img/logo_eetbare.png',
        'img/logo_horeca.png',
        'img/logo_hanzemag.png',
        'img/logo_clickt.png',
        'img/logo_groc.png',
        'img/logo_fietsstad.png',
        'img/logo_oogst.png',
        'img/logo_datmag.png',
        'img/logo_vera.png',
        'img/logo_sikkom.png',
        'img/logo_rug.png',
        'img/logo_zernike.png',
        'img/logo_stadmagazine.png',
        'img/logo_dichtbij.png',
        'img/logo_os.png',
        'img/logo_stadsgoud.png'
      ]);
    })
  );
});



//self.addEventListener('activate', event => {
//  // Kom op jonges
//});
