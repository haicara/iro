<h2 class="heading">COMMENT</h2>
<?php if(have_comments()): ?>
<ol class="commets-list">
<?php wp_list_comments('avatar_size=48'); ?>
</ol>
<?php endif; ?>
<?php $args = array(
    'title_reply' => 'コメントを書く',
    'label_submit' => '送信する',
    'comment_notes_before' => '<p>メールアドレスが公開されることはありません。</p>',
    'comment_notes_after'  => '<p>内容をご確認の上、送信してください。</p>',
    'fields' => array(
            'author' => '<p class="comment-form-author">' .
                        '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' placeholder="名前" /></p>',
            'email'  => '<p class="comment-form-email">' .
                        '<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . 'placeholder="メールアドレス" /></p>',
            'url'    => '',
            ),
    'comment_field' => '<p class="comment-form-comment">' . '<textarea id="comment" name="comment" cols="50" rows="6" aria-required="true"' . $aria_req . ' placeholder="本文" /></textarea></p>',
    );
comment_form( $args ); ?>