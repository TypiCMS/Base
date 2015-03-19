angular.module('typicms').directive('typiBtnFiles', function() {
    return {
        scope: {
            model: '='
        },
        template: '<a class="label label-default" ng-class="model.files_count ? \'label-success\' : \'\'" href="/admin/galleries/{{ model.id }}/edit?tab=tab-files">{{ model.files_count }}</a>'
    };
});
