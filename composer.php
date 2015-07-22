function  Dips_shuffle_comments( $comments , $post_id ){
	$visite = array();
	$mycomment  = array();
	$newcomment = array();
	foreach($comments as $comment){
		$mycomment[ $comment->comment_ID ] = $comment;
	}
	foreach( $mycomment as $comment ){
		if ( ! in_array( $comment->comment_ID, $visite ) ) {
			if ( 0 !== $comment->comment_parent ){
				$newcomment[] = $mycomment[ $comment->comment_parent ];
				unset( $mycomment[ $comment->comment_parent ] );
			}
			$newcomment[] = $comment;
			unset( $mycomment[ $comment->comment_ID ] );
		}
	}
	return $newcomment;
}

add_filter( 'comments_array' , array( $this, 'Dips_shuffle_comments' ) , 10, 2 );