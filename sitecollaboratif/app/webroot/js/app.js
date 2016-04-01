$(document).ready(function() {
	$('body').append('<a href="#" class="to-the-top"><i class="fa fa-arrow-up"></i></a>');

	$('.to-the-top').css({
		'position'				:	'fixed',
		'right'					:	'0',
		'bottom'				:	'0',
		'display'				:	'none',
		'padding'				:	'13px',
		'background'			:	'#222',
		'opacity'				:	'0.9',
		'color'                 :   '#fff',
		'z-index'				:	'2000'
	});

	$(window).scroll(function() {
		posScroll = $(document).scrollTop();
		if(posScroll >=600)
			$('.to-the-top').fadeIn(600);
		else
			$('.to-the-top').fadeOut(600);
	});

	$(".to-the-top").click(function() {
    	$("html, body").animate({scrollTop: 0}, 600);
		return false;
 	});

	$('#search').keyup(function(e) {
		var search_input = $(this).val();

		if (search_input.length >= 2) {
			$.ajax({
				type : "GET",
				url : '/Projet_web/sitecollaboratif/posts/resultSearch/' + search_input,
				data : {search: search_input},
				success : function(server_response) {
					$('#result').html(server_response).show();
				}
			});
		}

		if (search_input.length == 0) {
			$('#result').html('').show();
		}

	});

	$('#search_archives').keyup(function(e) {
		var search_input = $(this).val();

		if (search_input.length >= 2) {
			$.ajax({
				type : "GET",
				url : '/Projet_web/sitecollaboratif/archives/resultSearch/' + search_input,
				data : {search: search_input},
				success : function(server_response) {
					$('#result').html(server_response).show();
				}
			});
		}

		if (search_input.length == 0) {
			$('#result').html('').show();
		}
	})

});

setInterval(ajaxCall, 1000);

function ajaxCall() {

	if (typeof $('#chat-message').val() === "undefined") {
		return false;
	}

	var current_url = $(location).attr('href');
	var params = current_url.substring(current_url.lastIndexOf("/")+1);
	var id = params.slice(0, 1);

	if (isNaN(id))
		id = 1;

	var url = '/Projet_web/sitecollaboratif/Chats/ajaxProcessing' + '/' + id;

	$.get(url, function(data, status) {
		$('#chat-message').empty().append(data);
	});

	var tchat_scroll = document.getElementById('chat-message');
	tchat_scroll.scrollTop = tchat_scroll.scrollHeight;

	var focus_message = document.getElementById('chat-messsage-input');
	focus_message.focus();

	return true;
}

function recuperer_json(file) {
	var request = new XMLHttpRequest();
    request.open('GET', file, false);
    request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    request.send(null);

    try {
    	return JSON.parse(request.responseText);
    } catch(ex) {
    	return '';
    }
}

function sanitize_badwords(message) {

    badwords = recuperer_json('/Projet_web/sitecollaboratif/app/webroot/js/badwords_file.json');

    if (badwords.length == 0) {
    	console.log("impossible de recuperer_json");
    	return message;
    }

    for (i = 0 ; i < badwords.length ; i++) {
    	regExp = new RegExp('\\b' + badwords[i] + '\\b', 'gi');

    	if (regExp.test(message)) {
    		return message.replace(regExp, '***');
    	}
    }
    return message;
}

function EnvoyerMSG(id) {

	var msg = sanitize_badwords($('#chat-messsage-input').val());
	console.log(msg);
	if (msg == '')
		return false;

	$('#chat-form-control').submit(function(evt) {
		evt.preventDefault();
		$.ajax({
		    url: '/Projet_web/sitecollaboratif/Chats/envoyer_msg/' + id + '/' + msg,
		    data: {
		    	id: id,
		        msg: msg
		    }
		});

		msg = '';
	  	$('#chat-messsage-input').val('');
	  	$('#chat-messsage-input').focus();

		return true;
	});
}

function EnvoyerMAIL(id) {

	$('#mail-button-control').submit(function(evt) {
		evt.preventDefault();

		$.ajax({
		    url: '/Projet_web/sitecollaboratif/Chats/envoyer_mail/' + id,
		    data: {
		    	id: id
		    },
		    success : function() {
		    	alert("Votre question a été envoyée");
		    },
		    error : function(status) {
		    	alert("Une erreur est survenue lors de l'envoi");
		    }
		});
		return true;
	});
}

function poser_question() {
	$('#question-button-control').submit(function(evt) {
		evt.preventDefault();
		var str = prompt("Merci de nous préciser votre question : ", "");
		if (str != '') {
			var msg = sanitize_badwords(str);
			$.ajax({
			    url: '/Projet_web/sitecollaboratif/Archives/question/' +  msg,
			    data: {
			        msg: msg
			    },
			    success : function(data) {
			    	alert("Question enregistrée " + data);
			    },
			    error : function() {
			    	alert("Une erreur est survenue");
			    }
			});
		} else return false;
		return true;
	});
}

function enregistrer_reponse() {
	$('#reponse-button-control').submit(function(evt) {
		evt.preventDefault();
		var qst = prompt("Merci de nous rappeler votre question : ", "");
		var str = prompt("Merci de nous préciser la réponse qui vous semble la plus appropriée : ", "");
		if (str != '' && qst != '') {
			var qst = sanitize_badwords(qst);
			var msg = sanitize_badwords(str);
			$.ajax({
			    url: '/Projet_web/sitecollaboratif/Archives/reponse/' + qst + '/' + msg,
			    data: {
			    	qst: qst,
			        msg: msg
			    },
			    success : function(data) {
			    	alert(data);
			    },
			    error : function() {
			    	alert("Une erreur est survenue");
			    }
			});
		} else return false;
		return true;
	});
}
