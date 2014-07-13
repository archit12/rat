// $(document).ready(function() {
// $('.player').each(function(){
    // animateDiv($(this).attr('id'));
// });
// });

$('.player').on('mouseenter', function () {
	stopanimation($(this).attr('id'));
});

$('.player').on('mouseleave', function () {
	animateDiv($(this).attr('id'));
});


function makeNewPosition($container) {
    // Get viewport dimensions (remove the dimension of the div)
    //$container = ($container || $(window))
    var h = $container.height() ;
    var w = $container.width();

    var nh = Math.floor(Math.random() * h);
    var nw = Math.floor(Math.random() * w);

    return [nh, nw];

}
// can add dynamic speed for people
// function startPosition(id)
	// {
		// var div=$(id).parent();
		// var top=div.offset().top;
		// var left=div.offset().left;
		// var newleft=Math.floor(Math.random() * (y+30)*200);
		// return [newleft,top];
	// }
function animateDiv(id) {
    var $target = $('#'+id);
    var newq = makeNewPosition($target.parent());
    var oldq = $target.offset();
    var speed = calcSpeed([oldq.top, oldq.left], newq);
    console.log(speed);
    console.log(oldq.top+" "+oldq.left+" to "+newq);
    $($target).animate({
        top: newq[0],
        left: newq[1]
    }, speed, function() {
        animateDiv(id);
    });

};

function stopanimation(id) {
    var $target = $('#'+id);
    $($target).stop(true,false);

}

function calcSpeed(prev, next) {
	
    var x = Math.abs(prev[1] - next[1]);
    var y = Math.abs(prev[0] - next[0]);

    var greatest = x > y ? x : y;

    var speedModifier = 0.06;

    var speed = Math.ceil(greatest / speedModifier);

    return speed;

}