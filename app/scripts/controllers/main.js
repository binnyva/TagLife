'use strict';

/**
 * @ngdoc function
 * @name tagLifeApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the tagLifeApp
 */
angular.module('tagLifeApp')
  .controller('MainCtrl', ['$scope', '$http', '$location', function ($scope, $http, $location) {
	var MainCtrl = this;

	$scope.api_base_url = "http://" + $location.host() + "/Projects/MyLife/api/";
	MainCtrl.all_tags = ["tag", "life", "fun", "misc"];
	MainCtrl.date = moment();

	MainCtrl.init = function(){
		// $("h2").swipe({
		// 	swipeLeft:function(event, direction, distance, duration, fingerCount) {
		// 		MainCtrl.nextDay();
		// 	},
		// 	swipeRight:function(event, direction, distance, duration, fingerCount) {
		// 		MainCtrl.prevDay();
		// 	}
		// });

		$("#tags").tagit({
			availableTags: MainCtrl.all_tags,
			autocomplete: {delay: 0, minLength: 2},
			afterTagAdded: MainCtrl.tagged,
			afterTagRemoved: MainCtrl.untagged
		});

		MainCtrl.getDay(0);
	}

	MainCtrl.tagged = function(e, tag_info) {
		var tag = tag_info['tagLabel'];
	}

	MainCtrl.untagged = function() {

	}

	MainCtrl.nextDay = function() {
		MainCtrl.getDay(1);
	}
	MainCtrl.prevDay = function() {
		MainCtrl.getDay(-1);
	}

	MainCtrl.getDay = function(direction) {
		if(direction) MainCtrl.date = MainCtrl.date.add(direction, 'day');

		// loading();
		$.ajax(	{"url"		: $scope.api_base_url + "entry/get_tags.php", 
				"dataType"	: "json", 
				"data"		: {"date": MainCtrl.date.format("YYYY-MM-DD")},
				"type"		: "GET",
				"success"	: MainCtrl.setTags
		});
	}

	MainCtrl.setTags = function(data) {
		// loaded();
		// $("#date").html(date.format('Do MMM, YYYY'));
		$("#tags").tagit("removeAll");
		for(var index in data) $("#tags").tagit("createTag", data[index]);
	}

	MainCtrl.init();
}]);
