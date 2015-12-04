'use strict';

/**
 * @ngdoc function
 * @name tagLifeApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the tagLifeApp
 */
angular.module('tagLifeApp')
  .controller('AboutCtrl', function ($scope) {
    $scope.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];
  });
