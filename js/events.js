jQuery(document).ready(function() {
    var w=jQuery(".event .image").width();
    if(!w)
    	 w=jQuery(".event_vert .image").width();
    jQuery(".event_vert .image").height(w);
});