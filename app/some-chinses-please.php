<?php
function scp_comment_post( $incoming_comment ) {
    $pattern = '/[一-龥]/u';
    // 禁止全英文评论
    if(!preg_match($pattern, $incoming_comment['comment_content'])) {
         fail(__( "错误:您的评论中必须包含汉字!" ));
    }
    return( $incoming_comment );
}
add_filter('preprocess_comment', 'scp_comment_post');
