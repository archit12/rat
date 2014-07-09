var arr=[];
function update_tables()
{
		$.post('./ajax/table_a.php' , 'shop=step1' , function(data){
			if(data.length!=0)
			{
				var parse=$.parseJSON(data);
				{
					$("#attack_table").html(parse['msg']);
					$("#attack_table").prepend(parse['msg1']);
					$('#shop_inventory').css({
						'left':'90'
					})
					$(".popup_table").css({'display' : 'block'});
						$("#attack_table").show();
				}
			}
	})
}
$(document).ready(function(){
	$('#shop').click(function(e){
		update_tables();
		e.preventDefault();
	})
	$('#shop_inventory .inventor_qty').live('change' , function(){
		var id=$(this).attr('id').slice(2);
		var val=$(this).val();
		var nxt_val=$(this).next().attr('id').slice(2);
		if((val-nxt_val)>0)
			{
				alert('Value should be less than...');
				$(this).val(0);
			}
		else if(val<0)
			{
				alert("Value Should be greter than 0..");
				$(this).val(0);
			}
		else
			{
				var prev_val=$(this).closest('td').prev('td').attr('id').slice(2);
				var tot=val * prev_val;
				$(this).closest('td').next('td').find('div').html(tot);
			}
		
	})
	$('#buy').live('click' , function(){
		var t=0;
		var datax='shop=step3';
		var x=$('#shop_inventory').find('.total_cost');
		x.each(function(){
			if($(this).html()!='')
				t=t+parseInt($(this).html());
		})
		$('#total_price').html(t);
		if(t>0)
			{
				$.post('./ajax/shop_a.php', 'shop=step2&total_cost='+t , function(data){
					if(data.length!=0)
						{
							if(data==0)
								{
									alert("You Don't have suffecient funds..");
								}
							if(data==1)
								{
									datax='shop=step3';
									var f=$("#shop_inventory").find(".inventor_qty");
									f.each(function(){
										var id=$(this).attr('id').slice(2);
										var val=$(this).val();
										if(val!=0)
											{
												datax+="&"+id+"="+val;
											}
									})
									if(datax!='shop=step3')
										{
											$.post('./ajax/shop_a.php' , datax+"&money="+t ,function(data){
												if(data==1)
													{
														alert("Transaction Complete..");
														update_tables();
													}
												if(data==0)
													{
														alert("Not Enough Funds..");
													}
											})
										}
									
								}
						}
					
				})
			}
		})
		$('#shop_return').live('click' , function(){
			var datax="shop=shop_give_values";
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
						$.post("./ajax/shop_a.php" , datax , function(data){
								if(data.length!=0)
								update_tables();
						})
					}
			
		})
})