app.factory('news', ['$http', function($http) {
  return $http.get('api/news')
         .success(function(data) {
           return data;
         })
         .error(function(data) {
           return data;
         });
}]);