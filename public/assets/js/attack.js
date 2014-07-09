var att_old='';
var attack1=0;
var att_old2='';
var attack_one=0;

function check_attack()
		{
			
			$.post('./ajax/attack_n_a.php' , "submit=attack_check" , function(data){
				if(data!=att_old)
					{
						$("#newchat").append(data);
						att_old=data;
						attack1=1;
					}	
			})
			
			$.post('./ajax/attack_n_a.php' , 'submit=attack_decision' , function(data_win_loss){
					if(data_win_loss!=att_old2)
						{
							$("#newchat").append(data_win_loss);
							if(data_win_loss=='Congrats You Won..:)')
								{
									$.post("./ajax/table_a.php" , 'submit=attack_winner' , function(data){
										$('body > div').hide();
										$('body').append("<div id='tables'>"+data+"</div>");
										$('#tables').show();
										$('.popup_table').show();
									});
								}
							if(data_win_loss=='You Lost...:(')
								{
									alert("You need Rest...");
									window.location.href='./map.php';	
									
								}
							att_old2=data_win_loss;
						}
				});
		}
function all_change()
	{
		val=$(this).attr('value');
		nxt=$(this).next().attr('id')
		nxtval=nxt.slice(2);
		if((val-nxtval)>0)
			{
				alert("Select less than carrying....!");
				$(this).val(0);
			}
		if(val<0)
			{
				alert("Value Should be greter than 0..");
				$(this).val(0);
			}
	}

$(document).ready(function(){
	$("#attack").click(function(){
		 $.post('./ajax/attack_n_a.php' , "submit=attack_start" , function(data){
		 if(data.slice(0,1)== 'D')
			 {
				 alert('Have Patience attack in progress.. ');
			 }
			else if(data.length!=0 && data!=0)
				{
					 $("#newchat").append(data);
					 $.post('./ajax/attack_n_a.php' , 'submit=attack_winner' , function(data){
							 if(data==1)
								{
									alert('Your attack is Successful..');
								}
					 })
				 }
				else
					{
						if(data==0)
							{
								alert('Not enough strength to attack..');
							}
					}
				
		 })
		//alert('Not Suffecient strength to attack...');
	});
	
	$("#attack_take").live('click' , function(e){
		var datax="submit=values";
		var chkzero=0;
		var times=0;
		var x=$("#looser_inventory").find('.inventor_qty');
		x.each(function(){
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
		if(chkzero==times)
			{
				alert("Select some value to be transferred...");
			}
		else
			{
				$.post('./try.php' , datax , function(data){
					if(data!=0)
						{
						$.post("./ajax/table_a.php" , 'submit=attack_winner' , function(data){
						$('body > div').hide();
						$('#tables').html(data);
						$(".popup_table").css({'display' : 'block'});
						$("#tables").show();
						})}
					if(data==0)
						{
							alert('Take as much as you can carry...');
						}
				});
				
			}
		e.preventDefault();
	})
	
	$("#attack_give").live('click' , function(){
		var datax="submit=give_values";
		var chkzero=0;
		var times=0;
		var x=$("#own_inventory").find('.inventor_qty');
		x.each(function(){
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
			if(chkzero==times)
				{
					alert("Select some value to be transferred from your inventory to loosers...");
				}
			else
				{
					$.post("./ajax/attack_n_a.php" , datax , function(data){
						if(data==1)
						{
						$.post("./ajax/table_a.php" , 'submit=attack_winner' , function(data){
						$('body > div').hide();
						$('#tables').html(data);
						$(".popup_table").css({'display' : 'block'});
						$("#tables").show();
				});
						}
					})
				}
				
	})
	$("#done").live('click' , function(){
		$.post("./ajax/attack_n_a.php" , "attack=end",function(data){
			if(data=='end')
				{
					end2();
					$('body > div').show();
					$('#tables').html('');
					$("#tables").remove();
				}
		})
	})
	
	$('#looser_inventory .inventor_qty').live('change',function(){
		val=$(this).attr('value');
		nxt=$(this).next().attr('id')
		nxtval=nxt.slice(2);
		if((val-nxtval)>0)
			{
				alert("Select less than carrying....!");
				$(this).val(0);
			}
		if(val<0)
			{
				alert("Value Should be greter than 0..");
				$(this).val(0);
			}
		})
			
	$('#own_inventory .inventor_qty').live('change' , function(){
		val=$(this).attr('value');
		nxt=$(this).next().attr('id')
		nxtval=nxt.slice(2);
		if((val-nxtval)>0)
			{
				alert("Select less than carrying....!");
				$(this).val(0);
			}
		if(val<0)
			{
				alert("Value Should be greter than 0..");
				$(this).val(0);
			}
	})
			
	// setInterval(function(){check_attack()},500)
});