<div class="row" style="margin-top: 120px; border: 1px solid black;">

	<div class="col-md-4" style="height: 500px; border-right: 1px solid black;">

		<div class="user-infos" style="margin-top: 20px;">
			<?php if ($this->Session->read('Auth.User.avatar')): ?>
	        	<?= $this->Html->image($this->Session->read('Auth.User.avatari'), array('class'=>'preview-avatar')); ?>
	    	<?php endif ?>
			<b><?= $this->Session->read('Auth.User.username'); ?></b>
		</div>

		<ul class="nav nav-tabs" style="margin-top: 20px;">
			<li class="active"><a data-toggle="tab" href="#home">Utilisateurs connectés</a></li>
			<li><a data-toggle="tab" href="#menu1">Salles</a></li>
		</ul>

		<div class="tab-content">
			<div id="home" class="tab-pane fade in active">
				<table class="table table-striped">
				    <tbody>
				    	<tr>
				        	<td>
				        		<?php if ($this->Session->read('Auth.User.avatar')): ?>
					        		<?= $this->Html->image($this->Session->read('Auth.User.avatari'), array('class'=>'chat-avatar')); ?>
					    		<?php endif ?>
				        	</td>
				        	<td><?= $this->Session->read('Auth.User.username'); ?></td>
				      	</tr>
				    </tbody>
			    </table>
			</div>
			<div id="menu1" class="tab-pane fade">
				<table class="table table-striped">
				    <tbody>
				    	<tr>
				        	<td>Général</td>
				      	</tr>
				      	<tr>
				        	<td>Programmation en C</td>
				      	</tr>
				      	<tr>
				        	<td>Programmation en Java</td>
				      	</tr>
				    </tbody>
			    </table>
			</div>
		</div>
	</div>

	<div class="col-md-8" style="height: 500px;">
		<div style="text-align: center;">
			<h2>Général</h3>
			<hr>
		</div>
		<div class="chat-message" id="chat-message" style="background-color: #FFF; height: 70%;">
			
		</div>

		<?php echo $this->Form->create('Chats', array('url'=>array('controller'=>'Chats', 'action'=>''))); ?>
		<div class="input-group">
			<?php echo $this->Form->input('message', array('label'=>"",'id'=>'messsage', 'class'=>'form-control', 'placeholder'=>'Votre message', 'autocomplete'=>'off')); ?>
			<span class="input-group-btn">
				<?php echo $this->Form->button("Envoyer", array('class'=>'btn btn-default')); ?>
			</span>
		</div>
		<?php echo $this->Form->end(); ?>



	</div>
</div>
