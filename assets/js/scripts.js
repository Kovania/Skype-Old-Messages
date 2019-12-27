function Check() {
	var callData = JSON.stringify({"serviceName":"Core", "methodName":"Check"});
	$.post("/amfphp/gateway.php?contentType=application/json", callData, onSuccessCheck);
}

function onSuccessCheck(data) {
	if(data) {
		$(".nodb").hide();
		init();
	} else {
		$(".nodb").show();
		setTimeout(Check, 5000); 
	}
}

function init() {
    var callData = JSON.stringify({"serviceName":"Skype", "methodName":"GetConversations"});
    $.post("/amfphp/gateway.php?contentType=application/json", callData, onSuccessInit);
} 

function onSuccessInit(data)
{
	$(".people-list").show();
	$(".list").html(data);
	searchFilter.init();
	$(".loading").hide();
}

function loadchat(id) {
	$(".chat-num-messages").html("");
	$(".input").val("");
	$(".chaat").html("<center><img src='assets/img/loading.gif' height='50px'></center>");
	$(".chat-with").html( $("#" + id + " .name").html() );
	$(".chat").show();
	
	 var callData = JSON.stringify({"serviceName":"Skype", "methodName":"GetChat", "parameters":[id]});
	 $.post("/amfphp/gateway.php?contentType=application/json", callData, onSuccessChat);
}

function onSuccessChat(data) {
	$(".chaat").html(data.split('ss type').join('ss class'));
	$(".chat-num-messages").html( $(".nb_message").val() + " messages<br>" + $(".nb_appel").val() + " appel(s)");
}

var searchFilter = {
	    options: { valueNames: ['name'] },
	    init: function() {
	      var userList = new List('people-list', this.options);
	      var noItems = $('<li id="no-items-found">Aucun historique</li>');
	      
	      userList.on('updated', function(list) {
	        if (list.matchingItems.length === 0) {
	          $(list.list).append(noItems);
	        } else {
	          noItems.detach();
	        }
	      });
	    }
	  };