'use strict';

/*********************/
function PlayerService(){}
PlayerService.prototype.getUser =  function (paramters) {	
	var promise = $.getJSON('php/appServices.php',{"action":"getUser","parameters": paramters});	
	return promise;	
}

PlayerService.prototype.getUserProgress =  function (paramters) {	
	var promise = $.getJSON('php/appServices.php',{"action":"getUserProgress","parameters": paramters});	
	return promise;	
}

PlayerService.prototype.UpdateUserProgress =  function (paramters) {	
	var promise = $.getJSON('php/appServices.php',{"action":"UpdateUserProgress","parameters": paramters});	
	return promise;	
}
/********************/