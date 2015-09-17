app.factory('albums', ['$http', function($http) {
  return $http.get('api/albums')
         .success(function(data) {
           return data;
         })
         .error(function(data) {
           return data;
         });
}]);