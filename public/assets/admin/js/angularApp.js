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


/**
 * Created by psybo-03 on 25/4/17.
 */
app.controller('adminController', ['$scope', '$location', '$http', '$rootScope', '$filter', '$window', 'uibDateParser', function ($scope, $location, $http, $rootScope, $filter, $window, uibDateParser) {

    $scope.error = {};
    var base_url = $scope.baseUrl = $location.protocol() + "://" + location.host + '/';
    $rootScope.base_url = base_url;
    $rootScope.public_url = $scope.baseUrl = $location.protocol() + "://" + location.host;


    $scope.paginations = [5, 10, 20, 25];
    $scope.numPerPage = 10;

    $scope.user = {};
    $scope.curuser = {};
    $scope.newuser = {};
    $scope.newuser = {};
    $rootScope.loading = false;

    $rootScope.url = 'dashboard';
    $scope.formdisable = false;

    //$rootScope.url = $location.path().replace('/', '');
    console.log($rootScope.url);
    $rootScope.loading = false;

    $scope.format = 'yyyy/MM/dd';
    //$scope.date = new Date();

    check_thumb();

    load_user();

    function load_user() {
        var url = $rootScope.base_url + 'admin/user';
        $http.get(url).then(function (response) {
            if (response.data) {
                $scope.curuser = response.data.username;
                $scope.newuser.username = $scope.curuser;
            }
        });
    }

    $scope.login = function () {
        console.log('login');
        var fd = new FormData();
        angular.forEach($scope.user, function (item, key) {
            fd.append(key, item);
        });

        var url = $rootScope.base_url + '/login/verify';
        $http.post(url, fd, {
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined, 'Process-Data': false}
        })
            .then(function onSuccess(response) {
                $window.location.href = base_url + 'admin/#';
            }, function onError(response) {
                console.log('login error');
                console.log(response.data);
                $scope.error = response.data;
                $scope.showerror = true;
            });
    };

    function check_thumb() {
        $rootScope.loading = true;
        var url = $rootScope.base_url + 'admin/check-thumb';
        $http.post(url, {
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined, 'Process-Data': false}
        })
            .then(function nSuccess(response) {
                console.log('success');
                $rootScope.loading = false;
            }, function onError(response) {
                console.log('error');
                $rootScope.loading = false;
            })
    }

    $scope.changeProfile = function () {
        $rootScope.loading = true;
        var fd = new FormData();

        angular.forEach($scope.newuser, function (item, key) {
            fd.append(key, item);
        });
        var url = $rootScope.base_url + 'admin/change/submit';
        $http.post(url, fd, {
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined, 'Process-Data': false}
        })
            .then(function onSuccess(response) {
                $rootScope.loading = false;
                console.log('profile changed');
                $scope.showmsg = true;
                $scope.formdisable = true;
            }, function onError(response) {
                $rootScope.loading = false;
                $scope.showerror = true;
            });
    };

    $scope.reset = function () {
        $scope.newuser = {};
        load_user();
        $scope.newuser.username = $scope.curuser;
        $scope.showerror = false;
        $scope.showmsg = false;
        $scope.formdisable = false;
    };

    $scope.cancel = function () {
        $window.location.href = 'admin/#';
    };


    /******DATE Picker start******/
    $scope.today = function () {
        $scope.date = new Date();
    };
    $scope.today();

    $scope.clear = function () {
        $scope.date = null;
    };

    $scope.inlineOptions = {
        customClass: getDayClass,
        minDate: new Date(),
        showWeeks: true
    };

    $scope.dateOptions = {
        formatYear: 'yy',
        maxDate: new Date(2020, 5, 22),
        minDate: new Date(),
        startingDay: 1
    };

    // Disable weekend selection
    function disabled(data) {
        var date = data.date,
            mode = data.mode;
        return mode === 'day' && (date.getDay() === 0 || date.getDay() === 6);
    }

    $scope.toggleMin = function () {
        $scope.inlineOptions.minDate = $scope.inlineOptions.minDate ? null : new Date();
        $scope.dateOptions.minDate = $scope.inlineOptions.minDate;
    };

    $scope.toggleMin();

    $scope.open1 = function () {
        $scope.popup1.opened = true;
    };

    $scope.open2 = function () {
        $scope.popup2.opened = true;
    };

    $scope.setDate = function (year, month, day) {
        $scope.date = new Date(year, month, day);
    };

    $scope.formats = ['dd-MMMM-yyyy', 'yyyy/MM/dd', 'dd.MM.yyyy', 'shortDate'];
    $scope.format = $scope.formats[0];
    $scope.altInputFormats = ['M!/d!/yyyy'];

    $scope.popup1 = {
        opened: false
    };

    $scope.popup2 = {
        opened: false
    };

    var tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    var afterTomorrow = new Date();
    afterTomorrow.setDate(tomorrow.getDate() + 1);
    $scope.events = [
        {
            date: tomorrow,
            status: 'full'
        },
        {
            date: afterTomorrow,
            status: 'partially'
        }
    ];

    function getDayClass(data) {
        var date = data.date,
            mode = data.mode;
        if (mode === 'day') {
            var dayToCheck = new Date(date).setHours(0, 0, 0, 0);

            for (var i = 0; i < $scope.events.length; i++) {
                var currentDay = new Date($scope.events[i].date).setHours(0, 0, 0, 0);

                if (dayToCheck === currentDay) {
                    return $scope.events[i].status;
                }
            }
        }

        return '';
    }


    /******DATE Picker END******/

}]);


/**
 * Created by psybo-03 on 8/5/17.
 */

app.controller('blogController', ['$scope', '$http', '$rootScope', '$location', 'Upload', '$timeout', '$filter', function ($scope, $http, $rootScope, $location, Upload, $timeout, $filter) {

    $scope.bloges = [];
    $scope.newblog = {};
    $scope.curblog = {};
    $scope.files = [];
    $scope.showform = false;
    $scope.message = {};
    $rootScope.url = $location.path().replace('/', '');

    $scope.uploaded = [];
    $scope.newblog.date = new Date();

    $scope.uploadstatus = '';

    loadBlog();

    function loadBlog() {
        $http.get($rootScope.base_url + 'admin/blog/get-all').then(function (response) {
            if (response.data) {
                $scope.bloges = response.data;
                $scope.showtable = true;
            } else {
                console.log('No data Found');
                $scope.showtable = false;
                $scope.message = 'No data found';
            }
        });
    }

    $scope.newBlog = function () {
        $scope.newblog = {};
        $scope.filespre = [];
        $scope.showform = true;
    };

    $scope.showForm = function (item) {
        $scope.curblog = item;
        $scope.newblog = angular.copy(item);
        $scope.filespre = [];
        $scope.showform = true;
    };

    $scope.hideForm = function () {
        $scope.showform = false;
        $scope.errFiles = '';
    };

    $scope.addBlog = function () {
        $rootScope.loading = true;
        $scope.newblog.date = $filter('date')($scope.date, "yyyy-MM-dd");

        var fd = new FormData();
        angular.forEach($scope.newblog, function (item, key) {
            fd.append(key, item);
        });

        fd.append('uploaded', JSON.stringify($scope.uploaded));

        if ($scope.newblog['id']) {
            var url = $rootScope.base_url + 'admin/blog/edit/' + $scope.newblog.id;
            $http.post(url, fd, {
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined, 'Process-Data': false}
            })
                .then(function onSuccess(response) {
                    $scope.bloges.push(response.data);
                    loadBlog();
                    $scope.newblog = {};
                    $scope.showform = false;
                    $rootScope.loading = false;
                    $scope.files = '';
                },function onError(response) {
                    console.log('edit Error :- Status :' + response.status + 'data : ' + response.data);
                    $rootScope.loading = false;
                    $scope.files = '';
                });
        } else {
            var url = $rootScope.base_url + 'admin/blog/add';

            $http.post(url, fd, {
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined, 'Process-Data': false}
            })
                .then(function onSuccess(response) {
                    $scope.bloges.push(response.data);
                    loadBlog();
                    $scope.newblog = {};
                    $scope.showform = false;
                    $rootScope.loading = false;
                    $scope.files = '';

                }, function onError(response) {
                    console.log('addError :- Status :' + response.status + 'data : ' + response.data);
                    console.log(response.data);
                    $rootScope.loading = false;
                    $scope.files = '';
                });
        }
    };

    $scope.deleteBlog = function (item) {
        $rootScope.loading = true;
        var url = $rootScope.base_url + 'admin/blog/delete/' + item['id'];
        $http.delete(url)
            .then(function onSuccess(response) {
                var index = $scope.bloges.indexOf(item);
                $scope.bloges.splice(index, 1);
                alert(response.data.msg);
                loadBlog();
                $rootScope.loading = false;
            },function onError(response) {
                console.log('Delete Error :- Status :' + response.status + 'data : ' + response.data);
                console.log(response.data);
                $rootScope.loading = false;
            });
    };


    $scope.uploadFiles = function (files, errFiles) {
        $scope.files = files;
        $scope.errFiles = errFiles;
        angular.forEach(files, function (file) {
            file.upload = Upload.upload({
                url: $rootScope.base_url + 'admin/blog/upload',
                data: {file: file}
            });

            file.upload.then(function (response) {
                $timeout(function () {
                    $scope.uploaded = response.data;
                    file.result = response.data;
                });
            }, function (response) {
                if (response.status > 0)
                    $scope.errorMsg = response.status + ': ' + response.data;
            }, function (evt) {
                file.progress = Math.min(100, parseInt(100.0 *
                evt.loaded / evt.total));
            });
            file.upload.xhr(function (xhr) {
                $scope.abort = function () {
                    xhr.abort();
                    $scope.uploadstatus = 1;
                    file.progressmsg = 'Canceled';
                };
            });
        });
    };

    $scope.deleteImage =function(item) {
        $rootScope.loading = true;
        var url = $rootScope.base_url + 'admin/blog/delete-image/' + item['id'];
        $http.delete(url)
            .then(function onSuccess(response) {
                console.log('image deleted');
                delete $scope.newblog.thumbImgUrl;
                $rootScope.loading = false;
            },function onError(response) {
                console.log('Delete Error :- Status :' + response.status + 'data : ' + response.data);
                console.log(response.data);
                $rootScope.loading = false;
            });
    };

}]);




/**
 * Created by psybo-03 on 4/5/17.
 */


app.controller('brochureController', ['$scope', '$http', '$rootScope', '$location', 'Upload', '$timeout', '$filter', function ($scope, $http, $rootScope, $location, Upload, $timeout, $filter) {

    $scope.brochures = [];
    $scope.newbrochure = {};
    $scope.curbrochure = {};
    $scope.files = [];
    $scope.showform = false;
    $scope.message = {};
    $rootScope.url = $location.path().replace('/', '');

    $scope.uploaded = [];
    $scope.newbrochure.date = new Date();
    $scope.fileValidation = {};
    $scope.uploadstatus = '';

    loadBrochure();

    function loadBrochure() {
        $http.get($rootScope.base_url + 'admin/brochure/get-all').then(function (response) {
            if (response.data) {
                $scope.brochures = response.data;
                $scope.showtable = true;
            } else {
                console.log('No data Found');
                $scope.showtable = false;
                $scope.message = 'No data found';
            }
        });
    }







    $scope.newBrochure = function () {
        $scope.newbrochure = {};
        $scope.filespre = [];
        $scope.showform = true;
    };

    $scope.showForm = function (item) {
        $scope.curbrochure = item;
        $scope.newbrochure = angular.copy(item);
        $scope.filespre = [];
        $scope.showform = true;
    };

    $scope.hideForm = function () {
        $scope.showform = false;
        $scope.errFiles = '';
    };

    $scope.addBrochure = function () {
        $rootScope.loading = true;
        $scope.newbrochure.date = $filter('date')($scope.date, "yyyy-MM-dd");

        var fd = new FormData();
        angular.forEach($scope.newbrochure, function (item, key) {
            fd.append(key, item);
        });

        fd.append('uploaded', JSON.stringify($scope.uploaded));

        if ($scope.newbrochure['id']) {
            var url = $rootScope.base_url + 'admin/brochure/edit/' + $scope.newbrochure.id;
            $http.post(url, fd, {
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined, 'Process-Data': false}
            })
                .then(function onSuccess(response) {
                    $scope.brochures.push(response.data);
                    loadBrochure();
                    $scope.newbrochure = {};
                    $scope.showform = false;
                    $rootScope.loading = false;
                    $scope.files = '';
                },function onError(response) {
                    console.log('edit Error :- Status :' + response.status + 'data : ' + response.data);
                    $rootScope.loading = false;
                    $scope.files = '';
                });
        } else {
            var url = $rootScope.base_url + 'admin/brochure/add';

            $http.post(url, fd, {
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined, 'Process-Data': false}
            })
                .then(function onSuccess(response) {
                    $scope.brochures.push(response.data);
                    loadBrochure();
                    $scope.newbrochure = {};
                    $scope.showform = false;
                    $rootScope.loading = false;
                    $scope.files = '';

                }, function onError(response) {
                    console.log(response.data);
                    console.log('addError :- Status :  ' + response.status + 'data : ' + response.data);
                    if (response.status == 403) {
                        $scope.fileValidation.status = true;
                        $scope.fileValidation.msg = response.data.validation_error;
                    }
                    console.log(response.data.validation_error);
                    $rootScope.loading = false;
                    $scope.files = '';
                });
        }
    };

    $scope.deleteBrochure = function (item) {
        $rootScope.loading = true;
        var url = $rootScope.base_url + 'admin/brochure/delete/' + item['id'];
        $http.delete(url)
            .then(function onSuccess(response) {
                var index = $scope.brochures.indexOf(item);
                $scope.brochures.splice(index, 1);
                alert(response.data);
                loadBrochure();
                $rootScope.loading = false;
            },function onError(response) {
                console.log('Delete Error :- Status :' + response.status + 'data : ' + response.data);
                console.log(response.data);
                $rootScope.loading = false;
            });
    };


    $scope.uploadFiles = function (files, errFiles) {
        $scope.files = files;
        $scope.errFiles = errFiles;
        angular.forEach(files, function (file) {
            file.upload = Upload.upload({
                url: $rootScope.base_url + 'admin/brochure/upload',
                data: {file: file}
            });

            file.upload.then(function (response) {
                $timeout(function () {
                    $scope.uploaded = response.data;
                    file.result = response.data;
                });
            }, function (response) {
                if (response.status > 0)
                    $scope.errorMsg = response.status + ': ' + response.data;
            }, function (evt) {
                file.progress = Math.min(100, parseInt(100.0 *
                evt.loaded / evt.total));
            });
            file.upload.xhr(function (xhr) {
                $scope.abort = function () {
                    xhr.abort();
                    $scope.uploadstatus = 1;
                    file.progressmsg = 'Canceled';
                };
            });
        });
    };

    $scope.deleteImage =function(item) {
        $rootScope.loading = true;
        var url = $rootScope.base_url + 'admin/brochure/delete-image/' + item['id'];
        $http.delete(url)
            .then(function onSuccess(response) {
                console.log('image deleted');
                delete $scope.newbrochure.thumbImgUrl;
                $rootScope.loading = false;
            },function onError(response) {
                console.log('Delete Error :- Status :' + response.status + 'data : ' + response.data);
                console.log(response.data);
                $rootScope.loading = false;
            });
    };



}]);





/**
 * Created by psybo-03 on 4/5/17.
 */

app.controller('galleryController', ['$scope', '$http', '$rootScope', '$location', 'Upload', '$timeout', '$filter', function ($scope, $http, $rootScope, $location, Upload, $timeout, $filter) {

    $scope.galleries = [];
    $scope.newgallery = {};
    $scope.curgallery = {};
    $scope.files = [];
    $scope.errFiles = [];
    $scope.showform = false;
    $scope.message = {};
    $rootScope.url = $location.path().replace('/', '');

    $scope.uploaded = [];
    $scope.fileValidation = {};


    loadGallery();

    function loadGallery() {
        $scope.loading = true;
        $http.get($rootScope.base_url + 'admin/gallery/get-all').then(function (response) {
            if (response.data) {
                $scope.galleries = response.data;
                $scope.showtable = true;
                console.log($scope.galleries);
                $scope.loading = false;
            } else {
                console.log('No data Found');
                $scope.showtable = false;
                $scope.message = 'No data found';
                $scope.loading = false;
            }
        });
    }


    $scope.newGallery = function () {
        $scope.newgallery = {};
        $scope.filespre = [];
        $scope.uploaded = [];
        $scope.files = [];
        $scope.errFiles = [];
        $scope.showform = true;
    };

    $scope.ShowForm = function (item) {
        $scope.showform = true;
        $scope.curgallery = item;
        $scope.newgallery = angular.copy(item);
        $scope.item_files = item.files;
    };

    $scope.hideForm = function () {
        $scope.errFiles = '';
        $scope.showform = false;
    };

    $scope.addGallery = function () {
        $rootScope.loading = true;

        var fd = new FormData();
        angular.forEach($scope.newgallery, function (item, key) {
            fd.append(key, item);
        });

        fd.append('uploaded', JSON.stringify($scope.uploaded));

        if ($scope.newgallery['id']) {
            var url = $rootScope.base_url + 'admin/gallery/edit/' + $scope.newgallery.id;
            $http.post(url, fd, {
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined, 'Process-Data': false}
            })
                .then(function onSuccess(response) {
                    $scope.galleries.push(response.data);
                    loadGallery();
                    $scope.newgallery = {};
                    $scope.showform = false;
                    $rootScope.loading = false;
                    $scope.files = '';
                },function onError(response) {
                    console.log('edit Error :- Status :' + response.status + 'data : ' + response.data);
                    $rootScope.loading = false;
                    $scope.files = '';
                });
        } else {
            var url = $rootScope.base_url + 'admin/gallery/add';

            $http.post(url, fd, {
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined, 'Process-Data': false}
            })
                .then(function onSuccess(response) {
                    $scope.galleries.push(response.data);
                    loadGallery();
                    $scope.newgallery = {};
                    $scope.showform = false;
                    $rootScope.loading = false;
                    $scope.files = '';

                }, function onError(response) {
                    console.log('addError :- Status :' + response.status + 'data : ' + response.data);
                    console.log(response.data);
                    $rootScope.loading = false;
                    $scope.files = '';

                    if (response.status == 403) {
                        $scope.fileValidation.status = true;
                        $scope.fileValidation.msg = response.data.validation_error;
                    }
                });
        }
    };

    $scope.deleteGallery = function (item) {
        $rootScope.loading = true;
        var url = $rootScope.base_url + 'admin/gallery/delete/' + item['id'];
        $http.delete(url)
            .then(function onSuccess(response) {
                var index = $scope.galleries.indexOf(item);
                $scope.galleries.splice(index, 1);
                alert(response.data.msg);
                loadGallery();
                $rootScope.loading = false;
            },function onError(response) {
                console.log('Delete Error :- Status :' + response.status + 'data : ' + response.data);
                console.log(response.data);
                $rootScope.loading = false;
            });
    };


    $scope.uploadFiles = function (files, errFiles) {
        angular.forEach(errFiles, function (errFile) {
            $scope.errFiles.push(errFile);
        });
        angular.forEach(files, function (file) {
            $scope.files.push(file);
            file.upload = Upload.upload({
                url: $rootScope.base_url + 'admin/gallery/upload',
                data: {file: file}
            });

            file.upload.then(function (response) {
                $timeout(function () {
                    $scope.uploaded.push(response.data);
                    file.result = response.data;
                });
            }, function (response) {
                if (response.status > 0)
                    $scope.errorMsg = response.status + ': ' + response.data;
            }, function (evt) {
                file.progress = Math.min(100, parseInt(100.0 *
                evt.loaded / evt.total));
            });
        });
    };

    $scope.deleteImage =function(item) {

        $rootScope.loading = true;
        var url = $rootScope.base_url + 'admin/gallery/delete-image/' + item['id'];
        $http.delete(url)
            .then(function onSuccess(response) {
                console.log('image deleted');
                /*remove deleted file from scope variable*/
                var index = $scope.item_files.indexOf(item);
                $scope.item_files.splice(index, 1);

                $rootScope.loading = false;
            },function onError(response) {
                console.log('Delete Error :- Status :' + response.status + 'data : ' + response.data);
                console.log(response.data);
                $rootScope.loading = false;
            });
    };

    $scope.showGalleryFiles = function (item) {
        console.log(item);
        $scope.galleryfiles = item;
    };


}]);




/**
 * Created by psybo-03 on 4/5/17.
 */


app.controller('helpfulLinkController', ['$scope', '$http', '$rootScope', '$location', 'Upload', '$timeout', '$filter', function ($scope, $http, $rootScope, $location, Upload, $timeout, $filter) {

    $scope.links = [];
    $scope.newlink = {};
    $scope.curlink = {};
    $scope.showform = false;
    $scope.message = {};
    $rootScope.url = $location.path().replace('/', '');

    $scope.newlink.date = new Date();

    loadLink();

    function loadLink() {
        $http.get($rootScope.base_url + 'admin/helpful-link/get-all').then(function (response) {
            if (response.data) {
                $scope.links = response.data;
                $scope.showtable = true;
            } else {
                console.log('No data Found');
                $scope.showtable = false;
                $scope.message = 'No data found';
            }
        });
    }


    $scope.newLink = function () {
        $scope.newlink = {};
        $scope.filespre = [];
        $scope.showform = true;
    };

    $scope.showForm = function (item) {
        $scope.curlink = item;
        $scope.newlink = angular.copy(item);
        $scope.filespre = [];
        $scope.showform = true;
    };

    $scope.hideForm = function () {
        $scope.showform = false;
    };

    $scope.addLink = function () {
        $rootScope.loading = true;
        if ($scope.newlink.link != undefined) {
            var string = $scope.newlink.link;
            if (!~string.indexOf("http")) {
                $scope.newlink.link = "http://" + string;
            }
        }


        var fd = new FormData();
        angular.forEach($scope.newlink, function (item, key) {
            fd.append(key, item);
        });


        if ($scope.newlink['id']) {
            var url = $rootScope.base_url + 'admin/helpful-link/edit/' + $scope.newlink.id;
            $http.post(url, fd, {
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined, 'Process-Data': false}
            })
                .then(function onSuccess(response) {
                    $scope.links.push(response.data);
                    loadLink();
                    $scope.newlink = {};
                    $scope.showform = false;
                    $rootScope.loading = false;
                    $scope.files = '';
                },function onError(response) {
                    console.log('edit Error :- Status :' + response.status + 'data : ' + response.data);
                    $rootScope.loading = false;
                    $scope.files = '';
                });
        } else {
            var url = $rootScope.base_url + 'admin/helpful-link/add';

            $http.post(url, fd, {
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined, 'Process-Data': false}
            })
                .then(function onSuccess(response) {
                    $scope.links.push(response.data);
                    loadLink();
                    $scope.newlink = {};
                    $scope.showform = false;
                    $rootScope.loading = false;
                    $scope.files = '';

                }, function onError(response) {
                    console.log('addError :- Status :' + response.status + 'data : ' + response.data);
                    console.log(response.data);
                    $rootScope.loading = false;
                    $scope.files = '';
                });
        }
    };

    $scope.deleteLink = function (item) {
        $rootScope.loading = true;
        var url = $rootScope.base_url + 'admin/helpful-link/delete/' + item['id'];
        $http.delete(url)
            .then(function onSuccess(response) {
                var index = $scope.links.indexOf(item);
                $scope.links.splice(index, 1);
                alert(response.data);
                loadLink();
                $rootScope.loading = false;
            },function onError(response) {
                console.log('Delete Error :- Status :' + response.status + 'data : ' + response.data);
                console.log(response.data);
                $rootScope.loading = false;
            });
    };



}]);





/**
 * Created by psybo-03 on 26/4/17.
 */


app.controller('newsController', ['$scope', '$http', '$rootScope', '$location', 'Upload', '$timeout', '$filter', function ($scope, $http, $rootScope, $location, Upload, $timeout, $filter) {

    $scope.newses = [];
    $scope.newnews = {};
    $scope.curnews = {};
    $scope.files = [];
    $scope.showform = false;
    $scope.message = {};
    $rootScope.url = $location.path().replace('/', '');

    $scope.uploaded = [];
    $scope.newnews.date = new Date();

    loadNews();

    function loadNews() {
        $http.get($rootScope.base_url + 'admin/news/get-all').then(function (response) {
            if (response.data) {
                $scope.newses = response.data;
                $scope.showtable = true;
            } else {
                console.log('No data Found');
                $scope.showtable = false;
                $scope.message = 'No data found';
            }
        });
    }

    $scope.newNews = function () {
        $scope.newnews = {};
        $scope.filespre = [];
        $scope.showform = true;
    };

    $scope.showForm = function (item) {
        $scope.curnews = item;
        $scope.newnews = angular.copy(item);
        $scope.filespre = [];
        $scope.showform = true;
    };

    $scope.hideForm = function () {
        $scope.showform = false;
        $scope.errFiles = '';
    };

    $scope.addNews = function () {
        $rootScope.loading = true;
        $scope.newnews.date = $filter('date')($scope.date, "yyyy-MM-dd");

        var fd = new FormData();
        angular.forEach($scope.newnews, function (item, key) {
            fd.append(key, item);
        });

        fd.append('uploaded', JSON.stringify($scope.uploaded));

        if ($scope.newnews['id']) {
            var url = $rootScope.base_url + 'admin/news/edit/' + $scope.newnews.id;
            $http.post(url, fd, {
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined, 'Process-Data': false}
            })
                .then(function onSuccess(response) {
                    $scope.newses.push(response.data);
                    loadNews();
                    $scope.newnews = {};
                    $scope.showform = false;
                    $rootScope.loading = false;
                    $scope.files = '';
                },function onError(response) {
                    console.log('edit Error :- Status :' + response.status + 'data : ' + response.data);
                    $rootScope.loading = false;
                    $scope.files = '';
                });
        } else {
            var url = $rootScope.base_url + 'admin/news/add';

            $http.post(url, fd, {
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined, 'Process-Data': false}
            })
                .then(function onSuccess(response) {
                    $scope.newses.push(response.data);
                    loadNews();
                    $scope.newnews = {};
                    $scope.showform = false;
                    $rootScope.loading = false;
                    $scope.files = '';

                }, function onError(response) {
                    console.log('addError :- Status :' + response.status + 'data : ' + response.data);
                    console.log(response.data);
                    $rootScope.loading = false;
                    $scope.files = '';
                });
        }
    };

    $scope.deleteNews = function (item) {
        $rootScope.loading = true;
        var url = $rootScope.base_url + 'admin/news/delete/' + item['id'];
        $http.delete(url)
            .then(function onSuccess(response) {
                var index = $scope.newses.indexOf(item);
                $scope.newses.splice(index, 1);
                alert(response.data);
                loadNews();
                $rootScope.loading = false;
            },function onError(response) {
                console.log('Delete Error :- Status :' + response.status + 'data : ' + response.data);
                console.log(response.data);
                $rootScope.loading = false;
            });
    };



    $scope.uploadFiles = function(files, errFiles) {
        $scope.files = files;
        $scope.errFiles = errFiles;
        angular.forEach(files, function (file) {
            file.upload = Upload.upload({
                url: $rootScope.base_url + 'admin/news/upload',
                data: {file: file}
            });

            file.upload.then(function (response) {
                $timeout(function () {
                    $scope.uploaded = response.data;
                    file.result = response.data;
                });
            }, function (response) {
                if (response.status > 0)
                    $scope.errorMsg = response.status + ': ' + response.data;
            }, function (evt) {
                file.progress = Math.min(100, parseInt(100.0 *
                evt.loaded / evt.total));
                file.progressmsg = Math.min(100, parseInt(100.0 *
                evt.loaded / evt.total));
            });
            file.upload.xhr(function (xhr) {
                $scope.abort = function () {
                    xhr.abort();
                    $scope.uploadstatus = 1;
                    file.progressmsg = 'Canceled';
                };
            });
        });
    }

    $scope.deleteImage =function(item) {
        $rootScope.loading = true;
        var url = $rootScope.base_url + 'admin/news/delete-image/' + item['id'];
        $http.delete(url)
            .then(function onSuccess(response) {
                console.log('image deleted');
                delete $scope.newnews.thumbImgUrl;
                $rootScope.loading = false;
            },function onError(response) {
                console.log('Delete Error :- Status :' + response.status + 'data : ' + response.data);
                console.log(response.data);
                $rootScope.loading = false;
            });
    };



}]);




/**
 * Created by psybo-03 on 6/5/17.
 */

app.controller('slideImageController', ['$scope', '$http', '$rootScope', '$location', 'Upload', '$timeout', '$filter', function ($scope, $http, $rootScope, $location, Upload, $timeout, $filter) {

    $scope.slideimages = [];
    $scope.newslideimages = {};
    $scope.curslideimages = {};
    $scope.showform = false;
    $scope.message = {};
    $rootScope.url = $location.path().replace('/', '');

    $scope.uploaded = [];

    loadSlideImage();

    function loadSlideImage() {
        $http.get($rootScope.base_url + 'admin/slide-images/get-all').then(function (response) {
            if (response.data) {
                $scope.slideimages = response.data;
                $scope.showtable = true;
            } else {
                console.log('No data Found');
                $scope.showtable = false;
                $scope.message = 'No data found';
            }
        });
    }

    $scope.newSlideImage = function () {
        $scope.newslideimages = {};
        $scope.filespre = [];
        $scope.showform = true;
    };

    $scope.showForm = function (item) {
        $scope.curslideimages = item;
        $scope.newslideimages = angular.copy(item);
        $scope.filespre = [];
        $scope.showform = true;
    };

    $scope.hideForm = function () {
        $scope.showform = false;
        $scope.errFiles = '';
    };

    $scope.addSlideImage = function () {
        $rootScope.loading = true;

        var fd = new FormData();

        fd.append('uploaded', JSON.stringify($scope.uploaded));

        var url = $rootScope.base_url + 'admin/slide-images/add';

        $http.post(url, fd, {
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined, 'Process-Data': false}
        })
            .then(function onSuccess(response) {
                $scope.slideimages.push(response.data);
                loadSlideImage();
                $scope.newslideimages = {};
                $scope.showform = false;
                $rootScope.loading = false;
                $scope.files = '';

            }, function onError(response) {
                console.log('addError :- Status :' + response.status + 'data : ' + response.data);
                console.log(response.data);
                $rootScope.loading = false;
                $scope.files = '';
            });
    };


    $scope.uploadFiles = function(files, errFiles) {
        $scope.uploaded = [];
        $scope.files = files;
        $scope.errFiles = errFiles;
        angular.forEach(files, function (file) {
            file.upload = Upload.upload({
                url: $rootScope.base_url + 'admin/slide-images/upload',
                data: {file: file}
            });

            file.upload.then(function (response) {
                $timeout(function () {
                    $scope.uploaded.push(response.data);
                    file.result = response.data;
                });
            }, function (response) {
                if (response.status > 0)
                    $scope.errorMsg = response.status + ': ' + response.data;
            }, function (evt) {
                file.progress = Math.min(100, parseInt(100.0 *
                evt.loaded / evt.total));
            });
        });
    }

    $scope.deleteImage =function(item) {
        $rootScope.loading = true;
        var url = $rootScope.base_url + 'admin/slide-images/delete/' + item['id'];
        $http.delete(url)
            .then(function onSuccess(response) {
                console.log('image deleted');
                var index = $scope.slideimages.indexOf(item);
                $scope.slideimages.splice(index, 1);
                $rootScope.loading = false;
            },function onError(response) {
                console.log('Delete Error :- Status :' + response.status + 'data : ' + response.data);
                console.log(response.data);
                $rootScope.loading = false;
            });
    };



}]);





