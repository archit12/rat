var oldchat2='';
var oldbroad='';
var opt=0;
var x=0;
function chat_get()
	{
		$.post('./ajax/chat.php' ,'submit=chat_get' ,function(data){
			if(data.length!=0)
			{
				var parse1=$.parseJSON(data);
				if(parse1['msg']!=oldchat2)
				{
					if(parse1['msg']!='' && parse1['msg']!='|')
					{	
						$("#newchat").append(parse1['msg']);
						$("#to").html(parse1['to_name']);
						$("#chatbox").show();
						oldchat2=parse1['msg'];
						$("#newchat").scrollTop(document.getElementById('newchat').scrollHeight);
					}
					if(parse1['msg']!='' && parse1['msg']=='|')
						{
							oldchat2=parse1['msg'];
							$('#newchat').append('<span style="color:red">You are no longer into conversation...Your chat xperience ends nw...</span>');
							$('#newchat').scrollTop(document.getElementById('newchat').scrollHeight);
							setTimeout(function(){end2();},3000);
						}
					}
			}
		})
		$.post('./ajax/chat.php' , 'broad=broad_get' , function(data){
			if(data.length!=0)
			{	
				var parse1=$.parseJSON(data);
				if(parse1['broad_msg']!=oldbroad)
						{
							$('#broadcast_displaymsg').html(parse1['broad_msg_write']);
							var p_id=parse1['broad_msg'].split('|');
							var len=parse1['broad_msg'].length;
							$('#broadcast_displaymsg').show();
							$('#'+p_id[1]).html(p_id[0]);
						}
			}
		})
		if($('#chatbox').is(':visible'))
			{
					check_attack();
					chk_xchange();
			}
	}
function send()
	{
		var chattext=$('#chattext').val();
					if(chattext!= '')
						{
							data="submit=chat_own"+"&chattext="+chattext;
							$.post('./ajax/chat.php' , data , function(data){
								if(data.length!=0)
									{
										var parse=$.parseJSON(data);
										$('#chattext').val('');
										$('#newchat').append('<p><span class="chat_recieved">'+"  "+parse['username']+"</span>"+chattext+'</p>');
										$("#newchat").scrollTop(document.getElementById('newchat').scrollHeight);
									}
							})
						}
					else
						alert('Enter a message..');
	}

$(document).ready(function(){
	$("#chattext").keyup(function(event){
			var key=event.keyCode;
			if(key==13)	
				{
					send();
				}
		})
	$("#chatsend").click(function(){
		send();
	})
	setInterval(function(){chat_get()},500);

});