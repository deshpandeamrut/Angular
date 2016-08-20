var app = angular.module('myAngularApp', ['ngRoute', 'ngAnimate', 'ngAria', 'ngMaterial']);
app.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider.
                when('/default', {
                    templateUrl: 'default.html',
                    controller: 'defaultController'
                }).
                when('/categories',{
                   templateUrl: 'categories.html',
                    controller: 'categoriesController' 
                }).
                 when('/category/:categoryid?', {
                    templateUrl: 'category.html',
                    controller: 'categoryController'
                }).
                otherwise({
                    redirectTo: '/default'
                });
    }]);
app.config(function($mdThemingProvider) {
  $mdThemingProvider.theme('default')
    .primaryPalette('blue')
    .accentPalette('red');
    
});

