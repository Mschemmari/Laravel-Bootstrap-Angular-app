app.factory('sliders', ['$http', function($http) {
  return $http.get('api/home')
         .success(function(data) {
           return data;
         })
         .error(function(data) {
           return data;
         });
}]);

app.factory('lastNews', ['$http', function($http) {
  return $http.get('api/lastNews')
         .success(function(data) {
           return data;
         })
         .error(function(data) {
           return data;
         });
}]);

app.factory('lastAlbums', ['$http', function($http) {
  return $http.get('api/lastAlbums')
         .success(function(data) {
           return data;
         })
         .error(function(data) {
           return data;
         });
}]);

app.factory('lastVideos', ['$http', function($http) {
  return $http.get('api/lastVideos')
         .success(function(data) {
           return data;
         })
         .error(function(data) {
           return data;
         });
}]);

app.factory('calendarEvents', ['$http', function($http) {
  return $http.get('api/calendarEvents')
         .success(function(data) {
           return data;
         })
         .error(function(data) {
           return data;
         });
}]);