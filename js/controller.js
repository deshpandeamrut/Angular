app.controller('defaultController', function ($scope, myService) {
  $scope.imgsrc = "angular.jpg";
  makeMenuItemActive('#default');
});


app.controller('categoriesController',function($scope,$http){
  console.log("categores");
  
  $.ajax({
    url : "processListing.php",
    type : "POST",
    dataType : "json",
    data:{'data':{'method':'getAllCategories'}},
    success : function(categoriesData) {
      console.log(categoriesData);
      $scope.categories = categoriesData;
      console.log($scope.categories);
      $scope.$apply();
    }
  });
});

app.controller('categoryController',function($scope,$routeParams){
 $scope.categoryid = $routeParams.categoryid;
    // $scope.post = myService.getPost($scope.postId);
    console.log($scope.categoryid);

  $.ajax({
    url : "processListing.php",
    type : "POST",
    dataType : "json",
    data:{'data':{'method':'getListing','categoryID':$scope.categoryid}},
    success : function(listingData) {
      console.log(listingData);
      $scope.listings = listingData;
      $scope.$apply();
    }
  });
  });



makeMenuItemActive = function (currentMenuItem) {
  var menuItems = ['#ngRepeat', '#2way', '#addUser', '#showUser', '#feed', '#todo']
  menuItems.forEach(function (item) {
    if (currentMenuItem == item) {
      $(currentMenuItem).addClass("active");
    } else {
      $(item).removeClass('active');
    }
  });
}


app.filter('removeHtml', function () {
  return function (value) {
    var regex = /(<([^>]+)>)|&nbsp;| (\[&hellip;])|(#gallery.*\*\/)/ig;
    result = value.replace(regex, "");
    return result;
  };
});