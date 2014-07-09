/* ##GLOBAL VARIABLES## */
var users=0;
var oldusers='';
var l=0;
var oldchat='';var oldchat2='';
var chat_size=0;
var chat_rows=0;
var hi=new Array();
hi[0]="Hey...wasssup..?";
hi[1]="Kaise..?";
hi[2]="feeling great to say..hi..";
hi[3]="Der..?";
hi[4]="jus for u...";

function get_logged_user()
	{
		var data="submit=login_users";
		$.post('./ajax/show_users.php' ,data , function(data){
			if(data.length>0)
				{
					var parse=$.parseJSON(data);
					users=parse['ids'];
					$('.maparea').html(parse['msg']);
				}
		} );
	}
function append_logged_user()
	{
		$.post('./ajax/show_users.php' ,"submit=append_users&already_exist="+users , function(data){
			var parse=$.parseJSON(data);
			if(parse['msg'].length!=0)
				{
					$('.maparea').append(parse['msg']);
					users=parse['ids'];
				}
			if(parse['remove'].length!=0)
				{
					var rem=parse['remove'];
					var rem_ids=rem.substr(',');
					$("#13").remove();
				}
		});
		$.post('./ajax/show_users.php' , "submit=remove_users" , function(data){
			if(data.length!=0)
				{
					var ids=data;
					x=ids.split(',');
					len=x.length;
					i=0;
					while(i<len){
						if($('#'+i).length>0)
						$("#"+i).remove();
						i++;
					}
				}
		})
	}
function main()
		{
			$('.player').live('click' , function(){
				if(l==0)
				{	
					var id=$(this).attr('id');
					var username=$(this).attr('title');
					$.post('./ajax/session.php' , 'submit=chek_id&id='+id , function(data){
						if(data==0)
							{		
								$.post('./ajax/session.php' , 'to='+id , function(data){
									if(data=='ok')
										{
											$('#to').html(username);
											$('#chatbox').show();
											l=1;
										}
								})
								var ran=Math.floor(Math.random()*4);
								$.post('./ajax/chat.php' , 'submit=chat_own&chattext='+hi[ran] , function(data){
								if(data.length!=0)
									{
										var parse=$.parseJSON(data);
										$('#chattext').val('');
										$("#newchat").scrollTop(document.getElementById('newchat').scrollHeight);
									}
							})
							}
						else if(data==1)
							{
								alert("Busy...");
							}
					})
				}
				else
					alert("Please end previous chat..");
			})
		}
function end()
	{		
		$.post('./ajax/chat.php' , 'chat=end', function(data){
			$("#newchat").html('');
			//$("#attack_table").hide('slow');
			l=0;
			$("#chatbox").hide();
			oldchat='';
			chat_rows=0;
			alert(data);
		});
	}
function end2()
	{		
		$.post('./ajax/chat.php' , 'chat=end2', function(data){
			$("#newchat").html('');
			//$("#attack_table").hide('slow');
			l=0;
			$("#chatbox").hide();
			oldchat='';
			chat_rows=0;
			alert(data);
		});
	}
function chekchat()
	{
		$.post('./ajax/chat.php' , "submit=chat_chek" ,function(data){
			if(data.length!=0)
			{	
				var parse1=$.parseJSON(data);
				if(parse1['msg']!=oldchat && parse1['msg']!='|')
					{	
						$("#newchat").html(parse1['msg']).fadeIn('slow');
						$("#to").html(parse1['to_name']);
						$("#chatbox").show();
						oldchat=parse1['msg'];
						$("#newchat").scrollTop(document.getElementById('newchat').scrollHeight);
					}
			}
		})
	}
	
/* ##Calling All The Functions## */
$(document).ready(function(){
	get_logged_user();
	setInterval(function()
		{
			append_logged_user()
		},2000);
	setTimeout(function()
		{
			$('.player').each(function(){
			animateDiv($(this).attr('id'));
			});
		},100);
	main();
	$('#chatend').click(function(){
	end();
	})
	setTimeout(function(){chekchat();},500);
	$('#logout').click(function(){
		$.post('./ajax/user_login_a.php' , 'submit=exit' , function(data){	
				
				if(data=='out')
					window.location.href='index.php';
		})
	});
	/////////////////////////////////////braodcast/////
	$('#broadcast_button').click(function(){
		var msg=$('#broadcast_msg').val();
		if(msg=='')
			{
				alert('Write something...');
			}
		else
			{
				$.post('./ajax/chat.php' , 'submit=insert_msg&msg='+msg ,function(data){
					$('#broadcast_msg').val('');
					$('#broadcast_button').hide()
					setTimeout(function(){
						$('#broadcast_button').show();
						},10000);
						})
			}
		});
	
	$('.hide_process').live('click' , function(){
		$('.popup_table').hide();
		// alert();
	})
	
})