app.controller('VideosController', ['$scope', 'videos', function($scope, videos) {
  videos.success(function(data) {
    $scope.items = data;
    var j = 0;
    $scope.pages = new Array;
    $scope.pages.push({items:[]});
    angular.forEach($scope.items, function(value, key){
      if(key != 0 && key % 6 === 0){
      	j++;
      	$scope.pages.push({items:[]});
      }
      $scope.pages[j].items.push($scope.items[key]);
    });
    $scope.lastPage = j;
  	$scope.currentPage = 0;
    $scope.forwardPage = function () {
      $scope.currentPage++;
    };
    $scope.backwardPage = function () {
      $scope.currentPage--;
    };
    $scope.title = 'Galería de videos';
  	$scope.itemType = 'videos';
  	$scope.path = 'galeria-videos';
  });
}]);