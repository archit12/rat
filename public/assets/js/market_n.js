var xch_old='';
var xch_complete='';

		
function send_xchange()
	{
		var f=$("#own_inventory").find(".inventor_qty");
		var datax="submit=xch";
		var chkzero=0;
		var times=0;
		f.each(function(){
			var it_id=$(this).attr('id').slice(2);
			var val=$(this).val();
			var nxt=$(this).next().attr('id');
			nxtval=nxt.slice(2);
			times=times+1;
				if(val==0 || val<0)
					{
						chkzero+=1;
					}
				else
					{
						datax+="&"+it_id+"="+val;
					}
			})
		$.post("./ajax/exchange.php" , datax ,function(data){
			if(data==0)
				{
					alert('saamne wala inna nahi le skta..mat bhejo...pleez..');
				}
			if(data=='Your transaction request send..')
			{
				$("#newchat").append("<div style='color:red;'>To view your sent items and order status..<span id='order_status' style='cursor:pointer;'>Click Here</span></div>");
				$('#newchat').scrollTop(document.getElementById('newchat').scrollHeight);
					$('body > #attack_table').remove();
			}
		})
	}
function order_status()
	{
		$.post('./ajax/exchange.php' , 'submit=order_status' , function(data){
			if(data.length!=0)
				{
					$parse=$.parseJSON(data);
					if($parse['msg']!='')
						{
							alert("Status is :"+$parse['status']);
						}
				}
		})
	}
function chk_xchange()
	{
		$.post('./ajax/exchange.php' , "submit=get_xch_items" , function(data){
			if(data.length!=0)
				{
					var parse=$.parseJSON(data);
						{
							console.log(parse['comp']);
							if(parse['comp']==2)
								{
									$('#newchat').append("<div style='color:red;'>Transaction Denied...</div>");
									setTimeout(function(){
										$.post('./ajax/exchange.php' , 'submit=del_denied' , function(data){
											$('#newchat').scrollTop(document.getElementById('newchat').scrollHeight);
											$('body').append('<div id="attack_table" style="display:none;"></div>');
											
										});
									},100);
								}
							else if(parse['comp']==3)
								{
									$("#newchat").append("<div style='color:green;'>Transaction Complete...</div>");
									setTimeout(function(){
									$.post(' ./ajax/exchange.php' , 'submit=xchange_end' , function(data){
										$('body').append('<div id="attack_table" style="display:none;"></div>');
										$('#newchat').scrollTop(document.getElementById('newchat').scrollHeight);
									})
									},100);
								}
							else if(parse['msg']!=xch_old )
							{
								$("#newchat").append(parse['msg']);
								xch_old=parse['msg'];
								$("#newchat").scrollTop(document.getElementById('newchat').scrollHeight);
							
							}
						}
				}
			})
	}
$(document).ready(function(){

		$("#xchange").click(function(){
			//alert('Not suffeient resources to xchange...Try again later');
			 $.post('./ajax/table_a.php' ,"xchange=start" ,function(data){
			 if(data.length!=0)
				
					 {	
						 $("#attack_table").html(data);
						 $(".popup_table").css({'display' : 'block'});
						$("#attack_table").show();
					}
			 })
		});
			$("#xch_accept").live('click' , function(){
			$(".xch_buttons").fadeOut('slow');
			$.post('./ajax/exchange.php' , 'submit=xch_accept' , function(data){
				if(data==1)
					{
						var data="xchange=start";
						$.post('./ajax/table_a.php' ,data ,function(data){
							$("#attack_table").html(data);
							$("#own_inventory").css({'display' : 'block'});
							$("#attack_table").show();
							})
					}
				
			})
		})
		
	$('#xch_accept_test').live('click' , function(){
		
		$.post('./ajax/exchange.php' , 'submit=try_accept' , function(data){console.log(data);
			if(data==3)
				{
					$('.xch_deny_test').remove();
				}
			if(data==2)
				{
					$('.xch_deny_test').remove();
					$('#newchat').append('Due to..lack of carrying capacity..');
				}
		})
	})
	$('#xch_deny_test').live('click' , function(){
		$.post('./ajax/exchange.php' , 'submit=try_deny' , function(data){
			if(data==2)
				{
					$('.xch_deny_test').remove();
				}
		})
	
	});
	$('#xch_deny').live('click' , function(){
		$('#newchat').append('');
		$.post('./ajax/exchange.php' , 'submit=try_deny' , function(data){
			if(data==2)
				{
					$('.xch_buttons').remove();
					$('#newchat').scrollTop(document.getElementById('newchat').scrollHeight);
				}
		})
	
	});
	$("#xchange_give").live('click' , function(){
			send_xchange();
		});
		
	$("#order_status").live('click' , function(){
		order_status();
	});
	// setInterval(function(){chk_xchange();},500);
})