var items_shift = new Array();
var i=0;
/*
    notify
*/function notify(msg,timeout,redirectTo){
			timeout = typeof timeout !== 'undefined' ? timeout : 5000;
			redirectTo = typeof redirectTo !== 'undefined' ? redirectTo : "";
			$("#notify #msg").html(msg);
			$("#notify").fadeIn(500);
			setTimeout(function(){$("#notify").fadeOut(timeout);});
			if(redirectTo != ""){
				$("#notify #button").click(function(){
					$(location).attr("href","home.php");
				});
			}
		}

/*
######################### SLEEPING ####################
*/
function rest(){
 	$.ajax({
	  url: "process_v2.php",
	  type : 'get',
	 data : "rest=1",
	}).done(function(data){
	notify(data);
	});
setTimeout(function(){
	$.ajax({
	  url: "process_v2.php",
	  type : 'get',
	 data : "rest=2",
	}).done(function(data){
	notify(data);
	});
},10000);
	
}


//############################################################//



/*
	################# MAIN TO CURRENT INVENTORY ####################

*/
function MakeRequestMain(){
	
	items_shift.length=0;i=0;
	var txtbox=$('.invent_main').find('.text');
	txtbox.each(function(){
		if($(this).val()!='0')
		{
			var a=$(this).val();
			a=$(this).attr('id')+a;
			items_shift[i]=a;
			i++;
		}
		
	});	
	 if(items_shift.length!=0){
	$.ajax({
	  url: "process_v2.php",
	  type : 'get',
	 data : "q="+items_shift,
	}).done(function(data) {
	  // notify(data);
	  // $('#invent').removeData();
	  		 $.ajax({
			  url: "process_v2.php",
			  type : 'get',
			 data : "ajax_cur=1",
			}).done(function(data) {
			  // notify(data);
			  // $('#invent').removeData();
			  $('#current_div').html("");
			  
			   $('#current_div').html(data);
			  
			    $(".popup_table").show( 500,"linear" )
					$("#title").removeClass("show");
					$("#wt").removeClass("show");
			  				
			});	  
			$.ajax({
			url: "process_v2.php",
			   type : 'get',
			  data : "wt",
			 }).done(function(data) {
			// notify(data);
			if(data>100){
			   notify('MAXIMUM CARRYING CAPACITY EXCEEDED');
			   data=100;
			   	$('#chk_wt').addClass('red');
			   }else{
			   	$('#chk_wt').removeClass('red');
			   }
				  $('#chk_wt').removeData();
			   $('#chk_wt').html(data);
			   
			  				
			});	  
	    $('#main_div').removeData();
		$('#main_div').html(data);
	  
	});}
		else
			notify("Please enter sone quantity");
}
//############################################################################################//
/*
	################# CURRENT TO MAIN INVENTORY ####################

*/

function MakeRequestCur(){
	items_shift.length=0;i=0;
		
	var txtbox=$('.invent_cur').find('.text');
	txtbox.each(function(){
		if($(this).val()!='0')
		{
			var a=$(this).val();
			a=$(this).attr('id')+a;
			items_shift[i]=a;
			i++;
			//notify(a);
		}
		//notify();	
	});	
	 //notify('meeee');
	 if(items_shift.length!=0){
	$.ajax({
	  url: "process_v2.php",
	  type : 'get',
	  data : "q="+items_shift
	}).done(function(data) {
	  
					 $.ajax({
			  url: "process_v2.php",
			  type : 'get',
			 data : "ajax_main=1",
			}).done(function(data) {
			  // notify(data);
			  // $('#invent').removeData();
			   $('#main_div').removeData();
			   $('#main_div').html(data);
			  
			});	  
			$.ajax({
			url: "process_v2.php",
			   type : 'get',
			  data : "wt",
			 }).done(function(data) {
			// notify(data);
				  $('#chk_wt').removeData();
			   $('#chk_wt').html(data);
			   if(data>100){
			   	notify('MAXIMUM CARRYING CAPACITY EXCEEDED');
			   	$('#chk_wt').addClass('red');
			   }else{
			   	$('#chk_wt').removeClass('red');
			   }
			  				
			});	  
	  // $('#invent').removeData();
	   $('#current_div').removeData();
	  $('#current_div').html(data);
	  
	}).fail(function(data) {});}
		else
			notify("Please enter sone quantity");
}
//############################################################################################################//

//############################################################################################################//
/*
	################# SMITHING ####################

*/

function smith(id){
//notify(id);
	$.ajax({
			url: "smith_process.php",
			   type : 'get',
			  data : "inp="+id,
			 }).done(function(data) {
			notify(data);
					$('#test').html(data);	  				
			});	

}

//################ process forge//////////////////////
$('.forge').click( function () {
	// notify($(this).attr('id')+"_"+$(this).find('#text').text()+"_"+$(this).find('#l1').text()+"%"+$(this).children('#ref').text());
	$.ajax({
			url: "smith_process.php",
			   type : 'get',
			  data : "inp="+$(this).attr('id')+"_"+$(this).find('#text').text()+"_"+$(this).find('#l1').text()+"%"+$(this).children('#ref').text()+"%f",
			 }).done(function(data) {
			//notify(data);
			$('.out').hide(200,"swing");
					$('.out').removeData();

					
					$('.out').html(data)	  	
					$('.out').show(1000,"linear");			
			});	
	 

});
//--------------------------------------------------------------------//
$('.pro').click( function () {
	 if($('#qty').val()==0)
	 	notify("enter some qty");
	 else{
		$.ajax({
			url: "smith_process.php",
			   type : 'get',
			  data : "pro="+$('#qty').val(),
			 }).done(function(data) {

			notify(data);
			$('.out').hide(600,"linear");

					
			});	
	 
		}
});
//######################## process smith ###################################//
$('.smith').click( function () {

	//notify($(this).attr('id')+"_"+$(this).find('#text').text()+"_"+$(this).find('#l1').text()+"?"+$(this).find('#ref').text());
	$.ajax({

			url: "smith_process.php",
			   type : 'get',
			  data : "inp="+$(this).attr('id')+"_"+$(this).find('#text').text()+"_"+$(this).find('#l1').text()+"%"+$(this).children('#ref').text()+"%s",
			 }).done(function(data) {
					$('.out1').hide(200,"swing");
					$('.out1').removeData();

					
					$('.out1').html(data)	  	
					$('.out1').show(600,"linear");			
			});	
	 

});
//--------------------------------------------------------------------//
$('.pro_s').click( function () {
	 if($('#qty_s').val()==0)
	 	notify("enter some qty");
	 else{
		$.ajax({
			url: "smith_process.php",
			   type : 'get',
			  data : "pro="+$('#qty_s').val(),
			 }).done(function(data) {

			notify(data);
			$('.out1').hide(600,"linear");

					
			});	
	 
		}
});
//######################## process farming ###################################//

//---------------------------------------------------------------------------//
$('.pro_farm').click( function () {
	 if($('#qty').val()==0)
	 	notify("enter some qty");
	 else{
		$.ajax({
			url: "smith_process.php",
			   type : 'get',
			  data : "farm="+$('#qty').val(),
			 }).done(function(data) {

			notify(data);
			$('.out').hide(600,"linear");

					
			});	
	 
		}
});
//========================================================//\
$('.fland').click( function () {
	var t;
	$.ajax({
		
			url: "smith_process.php",
			   type : 'get',
			  data : "level="+$(this).attr('id'),
			 }).done(function(data) {
			 	
			if(data=1)
			 		notify('increase your skill');
			 else{	
			 	if(data==2)
			 		t=30000;
			 	else if(data==3)
			 		t=5*60*1000;
			 	else
			 		t=10*60*1000;
					notify("your item will will be made in"+t+"ms");			
			 	$.ajax({
					url: "smith_process.php",
				  	type : 'get',
				  	data : "clear="+$(this).attr('id'),
			 }).done(function(data) {
				notify();			
			});	
		}
	});

});
//---------------------------------------------------------------------------//
$('.pro_equip').click( function () {		
	$.ajax({
			url: "smith_process.php",
			   type : 'post',
			  data : {"equip":1}
			 }).done(function(data) {

			$('.out').html('');
			$('.out').html(data);
			$('.out').show();

			

					
			});	
	 
});
//--------------------------------------------------------------------------//
$('.pro_cons').click( function () {		
	$.ajax({
			url: "smith_process.php",
			   type : 'post',
			  data : {"cons":1},
			 }).done(function(data) {

			
			
			$('.out').html("");
			$('.out').html(data);
			$('.out').show();

			

					
			});	
	 
});
//=====================================================================================//
$('.pro_veg').click( function () {	
//lert($(this).attr("id"))	;
	$.ajax({
			url: "smith_process.php",
			   type : 'POST',
			  data : {"farm_pro":1,"id":$(this).attr("id")},
			 }).done(function(data) {

			//notify(data);
			$('.out').html("");
			$('.out').html(data);

			

					
			});	
	 
});