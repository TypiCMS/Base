(function (angular) {

    'use strict';

    /*jslint browser: true*/
    /*globals $, jQuery, angular, TypiCMS, alertify, top*/

    angular.module('typicms').controller('ListController', ['$http', '$scope', '$location', '$api',

        function ($http, $scope, $location, $api) {

            $scope.itemsByPage = 25;
            var url = $location.absUrl().split('?')[0],
                moduleName = url.split('/')[4],
                $params = {};

            $scope.TypiCMS = TypiCMS;

            // if we query files from a gallery, we need the gallery_id value :
            if (moduleName === 'galleries' && url.split('/')[5]) {
                $params.gallery_id = url.split('/')[5];
                $scope.gallery_id = $params.gallery_id;
            }

            // if we query menulinks menu_id value :
            if (moduleName === 'menus' && url.split('/')[5]) {
                $params.menu_id = url.split('/')[5];
                moduleName = 'menulinks';
            }

            $api.query($params).$promise.then(function (all) {
                $scope.models = all;
                //copy the references (you could clone ie angular.copy but then have to go through a dirty checking for the matches)
                $scope.displayedModels = [].concat($scope.models);
            });

            /**
             * Set status = 0 or 1 for item
             */
            $scope.toggleStatus = function (model) {
                var status = Math.abs(model.status - 1),
                    statuses = [
                        'offline',
                        'online'
                    ];
                model.status = status;
                $api.update({'id': model.id}, model).$promise.then(
                    function () {
                        alertify.success('Item is ' + statuses[status] + '.');
                    },
                    function (reason) {
                        alertify.error('Error ' + reason.status + ' ' + reason.statusText);
                    }
                );
            };

            /**
             * Set homepage = 0 or 1 for item
             */
            $scope.toggleHomepage = function (model) {
                model.homepage = Math.abs(model.homepage - 1);
                $api.update({'id': model.id}, model).$promise.then(
                    function () {
                    },
                    function (reason) {
                        alertify.error('Error ' + reason.status + ' ' + reason.statusText);
                    }
                );
            };

            /**
             * Update model
             */
            $scope.update = function (model) {
                $api.update({'id': model.id}, model).$promise.then(
                    function () {
                    },
                    function (reason) {
                        alertify.error('Error ' + reason.status + ' ' + reason.statusText);
                    }
                );
            };

            /**
             * TinyMCE File picker
             */
            $scope.selectAndClose = function (CKEditorFuncNum, file) {
                window.opener.CKEDITOR.tools.callFunction(CKEditorFuncNum, file);
                window.close();
            };

            /**
             * Delete an item from a non-nested list
             */
            $scope.delete = function (model, title) {
                if (!title) {
                    title = model.title;
                }
                if (!window.confirm('Supprimer « ' + title + ' » ?')) {
                    return false;
                }
                var index = $scope.models.indexOf(model);
                $api.delete({'id': model.id},
                    function () {
                        if (index !== -1) {
                            $scope.models.splice(index, 1);
                        }
                    },
                    function (reason) {
                        alertify.error('Error ' + reason.status + ' ' + reason.statusText);
                    }
                );
            };

            /**
             * Delete an item from a nested list
             */
            $scope.deleteFromNested = function (scope, title) {
                if (!title) {
                    title = scope.model.title;
                }
                if (scope.hasChild()) {
                    alertify.error('Cannot delete item because it has children.');
                    return false;
                }
                if (!window.confirm('Supprimer « ' + title + ' » ?')) {
                    return false;
                }
                $api.delete({'id': scope.model.id}, function () {
                    scope.remove();
                });
            };

            $scope.treeOptions = {
                dragThreshold: 0,
                dropped: function (event) {

                    var model = event.source.nodeScope.model,
                        parentId = null,
                        data = {},
                        nodes = event.dest.nodesScope,
                        currentList = nodes.$modelValue;

                    // if there is a parent
                    if (event.dest.nodesScope.$nodeScope) {
                        parentId = nodes.$nodeScope.model.id;
                    }

                    // do nothing when no move
                    if (event.dest.index === event.source.index && model.parent_id === parentId) {
                        return false;
                    }

                    data.moved = model.id;
                    data.item = [];
                    model.position = event.dest.index + 1;
                    model.parent_id = parentId;

                    angular.forEach(currentList, function (model) {
                        data.item.push({'id': model.id, 'parent_id': model.parent_id});
                    });

                    $http.post('/admin/' + moduleName + '/sort', data).
                        success(function (data) {
                            alertify.success(data.message);
                        }).
                        error(function (data) {
                            alertify.error(data.error.message);
                        });

                }
            };

        }]);

})(angular);
