app.controller('NewsController', ['$scope', 'news', function($scope, news) {
  news.success(function(data) {
    $scope.items = data;
    
    var j = 0;
    $scope.itemsPages = [];
    $.log($scope.itemsPages);
    angular.forEach($scope.items, function(value, key){
      $scope.items[key].created_at = new Date($scope.items[key].created_at);
      if(key % 5 === 0)
       j++;
      
    });

  	$scope.currentPage = 0;
  	
    $scope.forwardPage = function () {
      $scope.currentPage++;
    };
    $scope.backwardPage = function () {
      $scope.currentPage--;
    };

    $scope.title = 'Novedades';
  	$scope.itemType = 'news';
  	$scope.path = 'novedades';
  });
}]);
