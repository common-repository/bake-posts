<?php
/**
 * Plugin Name: Bake posts
 * Plugin URI: http://wordpress.org/plugins/bake-posts/
 * Description: Plugin to display Posts on selected Categories,Tags and Recent posts.
 * Version: 2.2
 * Author: wpnaga
 * Author URI: http://profiles.wordpress.org/wpnaga/
 * License: GPL2
 */


class bakePost{
	public $term 			= "";
	public $to_show 		= "";
	public $limit 			= "";
	public $featured_image 	= "";
	public $task 			= "";
	public $keyword 		= "";
	public $author 			= "";
	public $pub_date 		= "";
	public $show_cat 		= "";
	public $bakecharlimit 	= "";

	public function __construct($task,$atts){
		extract($atts);
		$this->term 			= isset($term)?$term:'id';
		$this->to_show 			= $excerpt;
		$this->limit 			= $limit;
		$this->featured_image 	= $featured_image;
		$this->task 			= $task;
		$this->keyword			= "";
		if($task == '2'){
			$this->keyword 		= $category;
		}
		else if($task == '3'){
			$this->keyword 		= $tag_id;
		}
		
		$this->author 			= isset($author)?$author:'yes';
		$this->pub_date 		= isset($pub_date)?$pub_date:'yes';
		$this->show_cat 		= isset($show_cat)?$show_cat:'yes';
		$this->bakecharlimit 	= isset($bakecharlimit)?$bakecharlimit:'150';
		 			
		add_filter('excerpt_more', array( $this,'bakepost_excerpt_more'));
	}

	public function bake_me(){
		switch($this->task){
			case 1: //Recent
				$the_query = new WP_Query( 'showposts='.$this->limit ); 
				break;
			case 2: // Category
				$the_query = ($this->term == "slug")?new WP_Query( 'category_name='.$this->keyword.'&posts_per_page='.$this->limit ):new WP_Query( 'cat='.$this->keyword.'&posts_per_page='.$this->limit );
				break;
			case 3: // Tags
				$the_query = ($this->term == "slug")?new WP_Query( 'tag='.$this->keyword.'&posts_per_page='.$this->limit ):new WP_Query( 'tag_id='.$this->keyword.'&posts_per_page='.$this->limit );
				break;
		}
		return $this->get_posts($the_query);
	}

	public function get_posts($the_query){
		$to_show = $this->get_to_show($this->to_show);
		if ( $the_query->have_posts() ) {
			$output ='<ul style="list-style-type:none;line-height:24px;" id="bake_post_recent">';
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				$output .='<li><a href="'.get_the_permalink().'"><b>' . get_the_title() . '</b></a><p>';
				if($this->author == "yes"){
					$aut_text = '<a href="'.get_author_posts_url( get_the_author_meta("ID"),get_the_author_meta("user_nicename")).'">'.get_the_author().'</a>';
					$output .= '<small><img src="'.plugins_url('images/author.png', __FILE__).'">&nbsp;'.$aut_text.'</small>&nbsp;&nbsp;';
				}  
				if($this->pub_date == "yes"){
					$output .= '<small><img src="'.plugins_url('images/time.png', __FILE__).'">&nbsp;'.get_the_date().'</small>&nbsp;&nbsp;';
				}
				if($this->show_cat == "yes"){
					$cats = get_the_category(); $cat_text = '';
					foreach($cats as $val){
						$cat_text .= '<a href="' . esc_url( get_category_link( $val->term_id ) ) . '">' . esc_html( $val->name ) . '</a>,';
					}
					$cat_text = rtrim($cat_text,',');
					$output .= '<small><img src="'.plugins_url('images/category.png', __FILE__).'">&nbsp;'.$cat_text.'</small>&nbsp;&nbsp;';
				}
				$output .='</p>';
				$output .='<p>';
				if($this->featured_image == "yes")
					$output .= get_the_post_thumbnail(get_the_ID(),array(80,80),array('align'=>"right",'style'=>"margin-right:10px;"));
				if($to_show != null){
					$desc = $to_show();
					if($this->to_show == "yes") //excerpt
						$desc = substr(strip_tags($desc), 0, $this->bakecharlimit).'<br><a href="'. get_permalink().'"> Read More</a>';
					$output .= $desc;
				}
				$output .='</p></li>';
			}
			$output .='</ul>';
		} else {
			$output ='No posts available.';
		}
		return $output;
	}

	public function get_to_show($to_show){
		if($to_show == "title")
			return null;
		else if($to_show == "yes")
			return 'get_the_excerpt';
		else if($to_show == "no")
			return 'get_the_content';
	}
	
	public function bakepost_excerpt_more() {
		return '..';
	}
	
}

add_shortcode("bake-post-category", "bake_post_category"); 
add_shortcode("bake-post-tags", "bake_post_tags"); 
add_shortcode("bake-post-recent", "bake_post_recent"); 

add_filter( 'widget_text', 'do_shortcode');

function bake_post_recent($atts){
	if(empty($atts)){
		$output ="Please set parameters in shortcode";
	}
	else{
		$baker = new bakePost(1,$atts);
		$output = $baker->bake_me();
	}
	wp_reset_postdata();
	return $output;
}
	
function bake_post_category($atts){
	if(empty($atts)){
		$output ="Please set parameters in shortcode";
	}
	else{
		$baker = new bakePost(2,$atts);
		$output = $baker->bake_me();
	}
	wp_reset_postdata();
	return $output;
}

function bake_post_tags($atts){
	if(empty($atts)){
		$output ="Please set parameters in shortcode";
	}
	else{
		$baker = new bakePost(3,$atts);
		$output = $baker->bake_me();
	}
	wp_reset_postdata();
	return $output;
}

include ('settings.php');

?>