jQuery(document).ready(function() {
	var count=jQuery('#slideEvents #events .event').length;
	var c=1;
	var left=0;
	var timer=null;
	var eventWidth=jQuery('#slideEvents #events .event').width()+4;
	jQuery('.slideCircles #0').addClass("active");

	jQuery('.slideCircle').click(function(){
		left=-eventWidth*jQuery(this).attr('id');
		jQuery('#slideEvents #events').animate({"left":left});
		jQuery('.slideCircles .active').removeClass("active");
		jQuery(this).addClass("active");
		c=parseInt(jQuery(this).attr('id'))+1;
		if(c>count-1)
			c=0;
		clearInterval(timer);
		timer=window.setInterval("jQuery('.slideCircle#"+c+"').trigger('click')",5000);

	});
	
	var w=jQuery('.bottomBar .name').width();
	var h=jQuery('.bottomBar .name').height();
	
	w=(jQuery('.bottomBar').width()-w)/2;
	h=(jQuery('.bottomBar').height()-h)/2;
	
	jQuery('.bottomBar .name').css("margin",h+"px "+w+"px");
	h=jQuery('.bottomBar .place').height();
	var m=jQuery('.bottomBar .place').css('margin');
	m=parseInt(m)*2;
	jQuery('.bottomBar .place').css('bottom',h+m+"px");
	jQuery('.bottomBar .date').css('bottom',h+m+"px");
	
	timer=window.setInterval("jQuery('.slideCircle#"+c+"').trigger('click')",5000);

});