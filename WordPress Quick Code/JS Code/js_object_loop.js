jQuery.each(cs_object.projects, function(index, val) {
	
	var projectHTML = '<div class="project-container"><img src="'+ val.image +'"><div class="project-content">';
	        projectHTML += '<h5 class="project-client"><a href="'+ val.permalinks +'">'+ val.client +'</a></h5><h3 class="project-title"><a href="'+ val.permalinks +'">'+ val.title +'</a></h3>';
	        projectHTML += '</div></div>';
	
	if(i == 1){
	    jQuery('#col1').append(projectHTML);
	}else if(i == 2){
	    jQuery('#col2').append(projectHTML);
	}else if(i == 3){
	    jQuery('#col3').append(projectHTML);
	    i = 0;
	}
     i++;
});