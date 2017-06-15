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



