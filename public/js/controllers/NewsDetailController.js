app.controller('NewsDetailController', ['$scope', 'news', 'rating', '$routeParams', function($scope, news, rating, $routeParams) {
  news.success(function(data) {
  	$scope.items = data;
  	var res = $.grep(data, function(e){ if (e.id == $routeParams.id){ return e; } });
  	if (res.length == 0) {
  	  location.assign('/novedades');
  	}
  	$scope.item = res[0];
    $scope.relatedItems = filterRelatedItems($scope.item.title, data);
    $scope.title = 'Novedades';
  	$scope.itemType = 'news';
    $scope.path = 'novedades';
    $scope.esteItem = 'esta nota';
    $scope.voteable_type = 'News';
  	$scope.activeImage = $scope.item.images[0];
  	$scope.setActiveImage = function(index){
  		$scope.activeImage = $scope.item.images[index];
  	};
    if($scope.item.rating === undefined){
      $scope.item.rating = 0;
    }
    $scope.rate = function(i){
      $scope.item.rating = i+1;
      rating.scorePost({score : $scope.item.rating, ip : $("#ip").val(), voteable_id : $scope.item.id, voteable_type : $scope.voteable_type}).success(function(data){
        $scope.item.stars = data;
      });
    };	
  });

}]);

