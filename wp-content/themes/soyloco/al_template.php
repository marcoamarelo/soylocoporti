<?php
  global $user_ID, $user_identity, $user_login;
  get_currentuserinfo();
  if (!$user_ID) {
?>

<div id="al_loading" class="al_nodisplay">
	<h6>Carregando...</h6>
	<div style="height: 100%; text-align:center;">
	<img id="al_loadingImage" alt="Carregando..." src="<?php bloginfo( 'wpurl' ); ?>/wp-content/plugins/ajax-login/al_loading.gif"/>
	</div>
</div>

<div id="al_login" class="login">
    <form name="al_loginForm" onsubmit="return false;" id="al_loginForm" action="#" method="post">
		<div class="span-6"><label for="log"><?php _e('User') ?><br /></label><input onkeypress="return al_loginOnEnter(event);" type="text" name="log" id="log" value="" size="20" /></div>
    	<div class="span-6 last"><label for="pwd"><?php _e('Password') ?><br /></label><input onkeypress="return al_loginOnEnter(event);" type="password" name="pwd" id="pwd"  value="" size="20" /></div>
	    <input type="button" name="submit" value="<?php _e('Login'); ?>" tabindex="10" onclick="al_login();" class="button"/><label><input type="checkbox" name="rememberme" value="forever" /> Lembrar de mim</label>
	    <span id="al_loginMessage"></span>
	    <a href="/wp-signup.php" title="Faça parte">Associe-se</a> | <a href="javascript:al_showLostPassword();" title="Vacilei">Esqueci a senha</a>
    </form>
</div>

<div id="al_lostPassword" class="login al_nodisplay">
	<h6>Recuperar a senha / <a href="javascript:al_showLogin();">Login</a> / <a href="/wp-signup.php" title="Faça parte"">Cadastre-se</a></h6>	
    <form name="al_lostPasswordForm" onsubmit="return false;" id="al_lostPasswordForm" action="#" method="post">
		<div class="span-6"><label for="user_login"><?php _e('User') ?></label><br /><input onkeypress="return al_retrievePasswordOnEnter(event);" type="text" name="user_login" id="user_login" class="text" value="" size="20" /></div>
	    <div class="span-6 last"><label for="user_email"><?php _e('Email') ?></label><br /><input onkeypress="return al_retrievePasswordOnEnter(event);" type="text" name="user_email" id="user_email" class="text" value="" size="20" /></div>

	    <input type="button" name="submit" class="button" value="<?php _e('Retrieve'); ?>" onclick="al_retrievePassword();"/>
	    <span id="al_lostPasswordMessage">Uma mensagem de confirmação será enviada para o seu email.<br/></span>    
    </form>
</div>

<?php  } else {  ?>

<div class="login">
	<?php if ( function_exists('bp_loggedinuser_avatar_thumbnail') ) : ?>
		<?php bp_loggedinuser_avatar_thumbnail() ?>	
	<?php endif; ?>	
	<p>Olá, <big><strong><?php echo $user_identity; ?></strong>!</big></p>
	<ul>
		<li><a href="<?php bloginfo('url') ?>/wp-admin/" title="Acessar o painel de controle">Painel de controle</a></li>
		<li><a href="<?php bloginfo('url') ?>/wp-admin/post-new.php" title="Escrever um post">Escrever um post</a></li>
		<li><a href="/members/<?php echo $user_login; ?>/profile" title="Seu perfil">Seu perfil</a></li>
		<li><a href="/members/<?php echo $user_login; ?>/blogs" title="Seus blogs">Seus blogs</a></li>
		<li><a href="/members/<?php echo $user_login; ?>/profile" title="Seus amigos">Seus amigos</a></li>
		<li><a href="<?php echo wp_logout_url()."&redirect_to=".$_SERVER["REQUEST_URI"]; ?>" title="Sair do sistema">Logout</a></li>
	</ul>
</div>


<?php } ?>
