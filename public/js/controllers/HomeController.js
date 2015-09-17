app.controller('HomeController', ['$scope', 'sliders', 'lastNews', 'lastVideos', 'lastAlbums', 'calendarEvents', function($scope, sliders, lastNews, lastVideos, lastAlbums, calendarEvents) {
  $scope.tab = 1;
  $scope.setTab = function(t){
    $scope.tab = t;
  };
  $scope.isTabSet = function(t){
    return $scope.tab == t;
  };
  sliders.success(function(data) {
    $scope.sliders = data;
    $scope.sliders[0].isActive = true;
    $('.carousel').carousel();
  });
  lastNews.success(function(data) {
    $scope.lastNews = data;
  });
  lastVideos.success(function(data) {
    $scope.lastVideos = data;
  });
  lastAlbums.success(function(data) {
    $scope.lastAlbums = data;
  });
  calendarEvents.success(function(data) {
    $scope.calendarEvents = data;
  });
  $scope.selectEvent = function(i){
    $scope.selectedEvent = $scope.calendarEvents[i];
  }
}]);
