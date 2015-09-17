app.controller('VideosDetailController', ['$scope', '$sce', 'videos', 'rating', '$routeParams', function($scope, $sce, videos, rating, $routeParams) {
  videos.success(function(data) {
  	$scope.items = data;
  	var res = $.grep(data, function(e){ if (e.id == $routeParams.id){ return e; } });
  	if (res.length == 0) {
  	  location.assign('/galeria-videos');
  	}
  	$scope.item = res[0];
    $scope.relatedItems = filterRelatedItems($scope.item.title, data);
    $scope.title = 'Galería de videos';
  	$scope.itemType = 'videos';
    $scope.path = 'galeria-videos';
    $scope.esteItem = 'este video';
    $scope.voteable_type = 'Videos';
  	$scope.activeImage = false;
    $scope.item.iframeSrc = $sce.trustAsResourceUrl(getIframeSrc($scope.item.link));
    if($scope.item.rating === undefined){
      $scope.item.rating = 0;
    }
    $scope.isVideo = true;
    $scope.rate = function(i){
      $scope.item.rating = i+1;
      rating.scorePost({score : $scope.item.rating, ip : $("#ip").val(), voteable_id : $scope.item.id, voteable_type : $scope.voteable_type}).success(function(data){
        $scope.item.stars = data;
      });
    };	
  });

}]);

