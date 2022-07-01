/* -------------------------------------------------------
 * Filename:     Adding Form Fields Dynamically and show hide
 ---------------------------------------------------------*/

var app = angular.module('migration-fields', []);

app.controller('MainCtrl', function ($scope) {
    var migration_fields_show = false;
    var counter=0;
    $scope.fields = [{id:counter, name : '', data_type : '', default_check : '', default : '', nullable : '', unique : '', is_required : ''}];

    $scope.addNewfield = function () {
        counter++;
        $scope.fields.push(  { id:counter, name : '', data_type : '', default_check : '', default : '', nullable : '', unique : '', is_required : ''} );

    };

    $scope.showMigrations = function () {
        document.getElementById('jumbotronDisplay').removeAttribute('style');
        migration_fields_show = !migration_fields_show;
    };

    $scope.showDefaultTableAttribute = function () {
        field.default_check = !field.default_check;
    };

    $scope.removefield = function () {
        var lastItem = $scope.fields.length - 1;
        $scope.fields.splice(lastItem);
    };

});