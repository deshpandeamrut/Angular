app.controller('defaultController', function ($scope, myService) {
    $scope.imgsrc = "angular.jpg";
    makeMenuItemActive('#default');
});


app.controller('categoriesController',function($scope,$firebaseAuth,$firebaseArray){
console.log("categores");

  var ref = new Firebase("https://listing-55002.firebaseio.com/categories");
  // download the data into a local object
  var auth = $firebaseAuth(ref);
    auth.$authWithOAuthPopup("facebook").then(function(authData) {
    console.log("Logged in as:", authData.uid);
  }).catch(function(error) {
    console.log("Authentication failed:", error);
  });

  $scope.categories = $firebaseArray(ref);
$scope.categories.$add({
      'id': 1,
      'name':'banks'
    });
console.log($scope.categories);
// $scope.categories = categores;
});

app.controller('categoryController',function($scope,$routeParams){
 $scope.categoryId = $routeParams.id;
    // $scope.post = myService.getPost($scope.postId);
    console.log("op: " + $scope.categoryId);
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