<!-- on va créer un element comme ça on a juste à le call dans le layout -->
<div class="navbar-wrapper">
	  <div class="container">
		<nav class="navbar navbar-inverse navbar-static-top">
		  <div class="container">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <li><?= $this->Html->link("Site collaboratif", "/", array('class'=>'navbar-brand')); ?></li>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
			  <ul class="nav navbar-nav navbar-right">
				<li><a href="#about"><?php echo __("Articles"); ?></a></li>
				<li><?php echo $this->Html->link(__("Tchat"), array('controller'=>'tchat', 'action'=>'index', 'admin'=>false)); ?></li> 
				<li><?php echo $this->Html->link(__("Contact"), '/contact'); ?></li>
				<?php if ($this->Session->read('Auth.User.id')): ?>
					<li><?= $this->Html->link(__("Mon compte"), array('controller'=>'users', 'action'=>'account', 'admin'=>false)); ?></li>
					<li><?= $this->Html->link(__("Se déconnecter"), array('controller'=>'users', 'action'=>'logout', 'admin'=>false)); ?></li>
				<?php else: ?>
					<li><?= $this->Html->link(__("Se connecter"), array('controller'=>'users', 'action'=>'login')); ?></li>
				<?php endif ?>
				<li>
					<button class="btnLang" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    <?php echo __("Langue"); ?>
						<span class="caret"></span>
					</button>
				  <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
				  	<li><a href="#"><img src="/img/internationalisation/flag_icons/png/fr.png"></img></a></li>
				    <li><a href="#"><img src="/img/internationalisation/flag_icons/png/gb.png"></img></a></li>
					<li><a href="#"><img src="/img/internationalisation/flag_icons/png/es.png"></img></a></li>
					<li><a href="#"><img src="/img/internationalisation/flag_icons/png/de.png"></img></a></li>
					<li><a href="#"><img src="/img/internationalisation/flag_icons/png/dz.png"></img></a></li>
					<li><a href="#"><img src="/img/internationalisation/flag_icons/png/jp.png"></img></a></li>
				  </ul>
				</li>
			  </ul>
			</div>
		  </div>
		</nav>
	  </div>
	</div>