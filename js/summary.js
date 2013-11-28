jQuery(document).ready(function() {
		
	var count=jQuery('#slideEvents #events .event').length;
	var c=1;
	var left=0;
	var timer=null;
	var eventWidth=jQuery('#slideEvents #events .event').width()+3;
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
	

	var h=jQuery('.bottomBar').height();
	
	//sposto la barra in basso
	var h2=jQuery('#slideEvents').height();
	jQuery('.bottomBar').css('top',(h2-h)+"px");
	
	//calcolo il margin per centrare data e luogo
	h2=jQuery('.bottomBar .place').height();
	var m=(h-h2)/2;
	
	//centro data e luogo nella barra
	jQuery('.bottomBar .place').css({'margin':m+'px 5px','bottom':h+'px'});
	jQuery('.bottomBar .date').css({'margin':m+'px 5px','bottom':h+'px'});
	
	//se ci sono pi eventi nella slide faccio partire il timer	
	if(count>1)
		timer=window.setInterval("jQuery('.slideCircle#"+c+"').trigger('click')",5000);

});