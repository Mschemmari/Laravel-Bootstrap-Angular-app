var app = angular.module('BayerHappeningApp', ['ngRoute', 'ngSanitize']);

app.config(function ($locationProvider, $routeProvider) {

  $routeProvider
    .when('/', {
      controller: "HomeController",
      templateUrl: "views/home.html"
    })
    .when('/novedades', {
      controller: "NewsController",
      templateUrl: "views/itemsMainList.html"
    })
    .when('/novedades/:id', {
      controller: 'NewsDetailController',
      templateUrl: 'views/itemDetail.html'
    })
    .when('/galeria-imagenes', {
      controller: "AlbumsController",
      templateUrl: "views/itemsMainList.html"
    })
    .when('/galeria-imagenes/:id', {
      controller: 'AlbumsDetailController',
      templateUrl: 'views/itemDetail.html'
    })
    .when('/galeria-videos', {
      controller: "VideosController",
      templateUrl: "views/itemsMainList.html"
    })
    .when('/galeria-videos/:id', {
      controller: 'VideosDetailController',
      templateUrl: 'views/itemDetail.html'
    })
    .otherwise({
      redirectTo: '/'
    });
    $locationProvider.html5Mode(true);
});



var filterRelatedItems = function(itemTitle, data){
  var relatedItems = [];
  var titleArray = itemTitle.toLowerCase().split(" ");
  var toRemove   = ["un", "una", "unos", "unas", "el", "la", "los", "las", "a", "ante", "bajo", "se", "cabe", "con", "contra", "de", "desde", "durante", "en", "entre", "hacia", "hasta", "mediante", "para", "por", "según", "sin", "so", "sobre", "tras", "versus", "vía"];
  titleArray = titleArray.filter( function( i ) {
    return toRemove.indexOf( i ) < 0;
  } );
  for(i = 0; i < data.length; i++){
    if(data[i].title != itemTitle){
      var dataTitleArray = data[i].title.toLowerCase().split(" ");
      dataTitleArray = dataTitleArray.filter( function( i ) {
        return toRemove.indexOf( i ) < 0;
      } );
      for(j = 0; j < titleArray.length; j++){
        for(x = 0; x < dataTitleArray.length; x++){
          if(dataTitleArray[x] == titleArray[j]){
            relatedItems.push(data[i]);
          }
        }
      }
    }
  }
  return relatedItems;
}

var getIframeSrc = function(string){
    var subStringArr = string.split('src="');
    subStringArr = subStringArr[1].split('" width');
    return subStringArr[0];
}