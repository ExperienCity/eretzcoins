var ajaxProcess;

$(document).on('pageinit', '#page1', function (event, data) {	
	
});

$(document).ready(function() {	
	
	$('#initGame').on('click',function(){	
	
		if(ajaxProcess){
			ajaxProcess.abort();
		}
	
		if(parseInt($('#playerId').val())) {
		
			var player = new PlayerService();
			var promise = player.getUser({ "playerId":$('#playerId').val()});
			ajaxProcess = promise;
		
			promise.done(function(data){	
				if(data.status == "ok"){
					window.location = "third.html?id=" + data.id;
				}
			}).error(function(er){ console.log(er);});
		}		
	});	
});