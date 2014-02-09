<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Reiches 3.0 | Archit Chetan!!! yay</title>
    {{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js') }}
    {{ HTML::script('assets/js/jquery.fullbg.min.js') }}
    {{ HTML::style('assets/css/login.css') }}
    <link rel="icon" href="img/favicon.ico" type="image/x-icon" />
</head>

<body>
    <div id="backdiv"></div>
	<div id="timer"></div>
    <div style="width: 100%; height: 60%; z-index: 10; position: absolute;">
        <div id="loginpanel">
            <div id="slidedowner" style="background-image: url('assets/images/panelbg.png')">
                <div style="width: 535px; margin-top: 200px; height: 300px;">                                	
                    {{ Form::open(array('url' => '/login', 'method' => 'post')) }}
                        <p>Enter TT Email ID</p>
                        <input  type="text" id='user' name="emailid" {{ (Input::old('emailid')) ? 'value="'.e(Input::old('emailid')).'"' : "" }}/>
                        @if ($errors->has('emailid'))
                        	{{ $errors->first('emailid') }}
                        @endif
                        <p>Enter Password</p>
                        <input  type="password" id='pwd'  name="password"/>
                        @if ($errors->has('password'))
                        	{{ $errors->first('password') }}
                        @endif                        
                        <input type="submit" title="Enter Reiches" value="Enter Reiches" id="loginbutton" />
                    {{ Form::close() }}
                    <!-- <script type='text/javascript'>
                            $('#loginbutton').click(function(){
                                    $.ajax({
                                      url: "login_check.php",
                                      type : 'post',
                                     data : {user:$('#user').val(),password:$('#pwd').val()}
                                    }).done(function(data){
                                   if(data==1)
                                     $(location).attr('href','map.php');
                                    else if(data==2)
                                     $(location).attr('href','emp.php');
                                    else
                                        alert(data);
                                    });
                            });
                    </script> -->

                    <img src="{{ URL::to('assets/images/credits.png') }}" id="mapper" style="margin-top:70px;margin-left:205px;z-index:2000;"/>

                    <div class="fblike">
                        <table>
                            <tr>
                                <td>Like Reiches </td>
                                <td>
                                    <iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2FReiches.Evolution&amp;send=false&amp;layout=button_count&amp;width=80&amp;show_faces=false&amp;font=verdana&amp;colorscheme=light&amp;action=like&amp;height=21&amp;appId=144923822270787" scrolling="no" frameborder="0" style="border: none; overflow: hidden; width: 80px; height: 21px;" allowtransparency="true"></iframe>
                                </td>
                                <td>and developers</td>
                                <td>
                                    <iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2FRedifiningLimitations&amp;send=false&amp;layout=button_count&amp;width=80&amp;show_faces=false&amp;font=verdana&amp;colorscheme=light&amp;action=like&amp;height=21&amp;appId=144923822270787" scrolling="no" frameborder="0" style="border: none; overflow: hidden; width: 80px; height: 21px;" allowtransparency="true"></iframe>
                                </td>
                            </tr>
                        </table>


                    </div>
                </div>
            </div>

            <img style="position:absolute;" alt="rieches logo" src="assets/images/reichesbanner.png" id="banner" />
           
        </div>
        <div id="credits" style="position: absolute; top: 50px; left: 50px; z-index: 1000;">
            <table>
                <tr>
                    <td>
                     <a href="https://www.facebook.com/hashmi786" target="_blank">   <img src="assets/images/credits/fraaz.jpg" /></a></td>
                </tr>
                <tr>
                    <td>Fraaz Hashmi</td>
                </tr>
               
                 <tr>
                    <td>
                         <a href="https://www.facebook.com/tushar.gupta.9792" target="_blank"> <img src="assets/images/credits/tushar.jpg" /></a></td>
                </tr>
                <tr>
                    <td>Tushar Gupta</td>
                </tr><tr>
                    <td>
                         <a href="https://www.facebook.com/afaq.alam.35" target="_blank"> <img src="assets/images/credits/afaq.jpg" /></a></td>
                </tr>
                <tr>
                    <td>Afaq Alam</td>
                </tr>
            </table>

        </div>
        <div id="credits2" style="position: absolute; top: 50px; right: 50px; z-index: 1000;">
            <table>
                <tr>
                    <td>
                         <a href="https://www.facebook.com/PRANEET007" target="_blank"> <img src="assets/images/credits/praneet.jpg" /></a></td>
                </tr>
                <tr>
                    <td>Praneet Asthana</td>
                </tr>
              <tr>
                <td>
                  <a href="https://www.facebook.com/utsavnarayan" target="_blank">
                    <img src="assets/images/credits/utsav.jpg" />
                  </a>
                </td>
              </tr>
              <tr>
                <td>Utsav Narayan Singh</td>
              </tr>
                <tr>
                    <td>
                          <a href="https://www.facebook.com/rishabh.kesarwani.927" target="_blank"><img src="assets/images/credits/rishabh.jpg" /></a></td>
                </tr>
                <tr>
                    <td>Rishabh Kesarwani</td>
                </tr>
               
            </table>

        </div>

    </div>
       <script type="text/javascript">
        var i = 1;
        
        $(document).ready(function () {

					
            $("#banner").click(function downer() {
                $("#slidedowner").css("position", "relative");
                $("#slidedowner").animate({ top: '-10px' }, 1000);
            });
            switcher();
            $("#slidedowner").css("position", "relative");
            $("#slidedowner").animate({ top: '-10px' }, 4000);
            $("#mapper").click(function downer() {
                $("#credits").css("visibility", "visible");
                $("#credits2").css("visibility", "visible");
            });

        });

        function switcher() {
            i = i % 3;
            $("#backdiv").css("-webkit-transition", "linear 4s");
            $("#backdiv").css("background-image", "url(assets/images/" + i++ + ".jpg)");
            $("#backdiv").css("-webkit-transition", "linear 4s");


            setTimeout(switcher, 4000);
        }
		
        
    </script>

	</body>
</html>