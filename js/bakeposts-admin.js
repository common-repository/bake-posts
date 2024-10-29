jQuery(document).ready(function($){
	$("#bakeposts-form").submit(function(){
		var type 		= $('#baketype').val(); 
		var limit 		= $('#bakelimit').val();
		var excerpt 	= $(".bakeexcerpt:checked").val();
		var featured 	= $("#bakeimage:checked").val();
		var author 		= $("#bakeisauthor:checked").val();
		var show_cat 	= $("#bakeiscategory:checked").val();
		var date 		= $("#bakeisdate:checked").val();
		var char_limit 	= $('#bakecharlimit').val();
		var shortcode 	= '';
		switch(type){
			case 'recent':
				shortcode += '[bake-post-recent ';
				break;
			case 'category':
				shortcode += '[bake-post-category ';
				break;
			case 'tags':
				shortcode += '[bake-post-tags ';
				break;	
		}
		
		//shortcode += 'term="id" ';
	
		shortcode += 'limit='+limit+' ';
		
		shortcode += 'excerpt="'+excerpt+'" ';
		
		shortcode += append_value('featured_image',featured);
		shortcode += append_value('author',author);
		shortcode += append_value('show_cat',show_cat);
		shortcode += append_value('pub_date',date);
		
		if(limit == '' || limit <= 0){
			$("#error_msg").text('Please enter a valid post limit').css("color","red").fadeIn();
			return false;
		}
		
		if(excerpt == "yes"){ 
			if(char_limit == '' || char_limit <= 0){
				$("#error_msg").text('Please enter a valid excerpt character limit').css("color","red").fadeIn();
				return false;
			}
		}
		
		
		switch(type){
			case 'category':
				shortcode += 'category="';
				var count = $('#category_list').find('input[type=checkbox]:checked').length;
				if(count == 0){
					$("#error_msg").text('Please select a category').css("color","red").fadeIn();
					return false;
				}
				var i=1;
				$('#category_list input[type=checkbox]:checked').each(function(){
					shortcode += $(this).val();
					if(i<count)
						shortcode += ',';
					else
						shortcode += '"';	
					i++;	
				})
				break;
			case 'tags':
				shortcode += 'tag_id="';
				var count = $('#tags_list').find('input[type=checkbox]:checked').length;
				if(count == 0){
					$("#error_msg").text('Please select a tag').css("color","red").fadeIn();
					return false;
				}
				var i=1;
				$('#tags_list input[type=checkbox]:checked').each(function(){
					shortcode += $(this).val();
					if(i<count)
						shortcode += ',';
					else
						shortcode += '"';
					i++;	
				})
				break;
			default:
				break;
		}
		
		if(excerpt == "yes"){ 
			shortcode += 'char_limit="'+char_limit+'" ';
		}	
		
		shortcode += ']';
		/****   Result   *****/
		$("#shortcode").text(shortcode);
		$("#shortcode").focus();
		$("#shortcode").select();
		
		$("#error_msg").text('Copy and paste the shortcode in posts,pages or text widgets.').css("color","green").fadeIn();
		return false; // Do not submit form;
	});
	
	$("#baketype").change(function(){
		var type = $("#baketype").val();
		switch(type){
			case 'category':
				$('#tags_list').addClass('hide');
				$('#category_list').removeClass('hide');
				break;
			case 'tags':
				$('#category_list').addClass('hide');
				$('#tags_list').removeClass('hide');
				break;
			default:
				$('#category_list').addClass('hide');
				$('#tags_list').addClass('hide');
		}
	});
	
	$(".bakeexcerpt").change(function(){
		var excerpt = $(this).val();
		if(excerpt == "yes"){
			$("#bakecharcontain").removeClass('hide');
		}
		else{
			$("#bakecharcontain").addClass('hide');
		}		
	});
	
	/* $('#bakeimage').click(function(){
		$('.sizebox').fadeToggle("slow");
	}); */
});

function append_value(type,value){
	code = type+'="no" ';
	if(value == "yes"){
		code = type+'="yes" ';
	}
	return code;
}