/**
 * Created by psybo-03 on 25/4/17.
 */

var app = angular.module('myApp', ['ngRoute', 'ui.bootstrap', 'angularUtils.directives.dirPagination', 'ngFileUpload']);
app.config(['$routeProvider', '$locationProvider','$qProvider', function ($routeProvider, $locationProvider, $qProvider) {
    $qProvider.errorOnUnhandledRejections(false);
    $locationProvider.hashPrefix('');
    $routeProvider
        .when('/#/', {
            templateUrl: '',
            controller:'dashboardController'
        })
        .when('/news', {
            templateUrl: 'news',
            controller:'newsController'
        })
        .when('/brochures', {
            templateUrl: 'brochures',
            controller:'brochureController'
        })
        .when('/helpful-links', {
            templateUrl: 'helpful-links',
            controller:'helpfulLinkController'
        })
        .when('/gallery', {
            templateUrl: 'gallery',
            controller:'galleryController'
        })
        .when('/slide-images', {
            templateUrl: 'slide-images',
            controller:'slideImageController'
        })
        .when('/blog', {
            templateUrl: 'blog',
            controller:'blogController'
        })
        .when('/edit-profile', {
            templateUrl: 'change'
        })

}]);

//Pagination filter
app.filter('startFrom', function() {
    return function(input, start) {
        start = +start; //parse to int
        return input.slice(start);
    }
});


app.directive('fileModel', ['$parse', function ($parse) {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            var model = $parse(attrs.fileModel);
            var modelSetter = model.assign;
            scope.filespre = [];

            element.bind('change', function(){
                var values = [];
                angular.forEach(element[0].files, function (item) {
                    //url
                    item.url = URL.createObjectURL(item);
                    item.model = attrs.fileModel;
                    scope.filespre.push(item);
                });
                scope.$apply(function(){
                    modelSetter(scope, element[0].files);
                    //old
                    //modelSetter(scope, element[0].files[0]);
                });
            });
        }
    };
}]);

app.directive('ngConfirmClick', [
    function () {
        return {
            link: function (scope, element, attr) {
                var msg = attr.ngConfirmClick || "Are you sure?";
                var clickAction = attr.confirmedClick;
                element.bind('click', function (event) {
                    if (window.confirm(msg)) {
                        scope.$eval(clickAction)
                    }
                });
            }
        };
    }

]);

