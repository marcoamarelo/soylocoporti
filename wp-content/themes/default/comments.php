<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
			?>

			<p class="nocomments">This post is password protected. Enter the password to view comments.</p>

			<?php
			return;
		}
	}

	/* This variable is for alternating comment background */
	$oddcomment = 'class="alt" ';
?>

<!-- You can start editing here. -->

<?php if ($comments) : ?>
	<h6 id="comments"><?php comments_number('Nenhum comentário', 'Um comentário', '% comentários' );?> em &#8220;<?php the_title(); ?>&#8221;</h6>

	<ol class="commentlist">

	<?php foreach ($comments as $comment) : ?>

		<li <?php echo $oddcomment; ?>id="comment-<?php comment_ID() ?>" class="comentarios clearfix">
			
			<?php comment_text() ?>
			
			<small class="commentmetadata">&mdash; <cite><?php comment_author_link() ?></cite> <a href="#comment-<?php comment_ID() ?>" title=""><?php comment_date('j/m/y') ?>, às <?php comment_time() ?></a> <?php edit_comment_link('editar','&nbsp;',''); ?> <?php if ($comment->comment_approved == '0') : ?><em>Seu comentário está aguardando moderação.</em><?php endif; ?></small>

		</li>

	<?php
		/* Changes every other comment to a different class */
		$oddcomment = ( empty( $oddcomment ) ) ? 'class="alt" ' : '';
	?>

	<?php endforeach; /* end for each comment */ ?>

	</ol>

 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments">Comments are closed.</p>

	<?php endif; ?>
<?php endif; ?>

<?php if ('open' == $post->comment_status) : ?>

<?php if(in_category('166')) : ?>
	<h6>Discuta sobre o tema.</h6>
<?php else: ?>
	<h6>Deixe um comentário</h6>
<?php endif; ?>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>

<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
<p><label for="comment">Mensagem</label><br/><textarea name="comment" id="comment" class="textbox" cols="20" rows="10" tabindex="4"></textarea></p>

<?php if ( $user_ID ) : ?>

<p>Registrado como <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Fazer logout dessa conta">Logout &raquo;</a></p>

<?php else : ?>

<p><label for="author">Nome <?php if ($req) echo "(obrigatório)"; ?></label><br/><input type="text" name="author" id="author" class="text" value="<?php echo $comment_author; ?>" size="22" tabindex="1" /></p>

<p><label for="email">Email (não será publicado) <?php if ($req) echo "(obrigatório)"; ?></label><br/><input type="text" name="email" id="email" class="text" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" /></p>

<p><label for="url">Site</label><br/><input type="text" name="url" id="url" class="text" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" /></p>

<?php endif; ?>

<!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->

<p><input name="submit" type="submit" id="submit" class="button" tabindex="5" value="Enviar comentário" />
<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
</p>
<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>
