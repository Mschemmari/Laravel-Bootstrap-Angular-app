app.factory('rating', ['$http', function($http) {

  return{
	scorePost: function(data){
	    return $http.post('api/rate', data)
		    	.success(function(data) {
	           return data;
	         })
	         .error(function(data) {
	           return data;
	         });
	}
  }

}]);