<?php $count = 0?>
<?php echo $this->Html->script('jquery-1.12.0.min'); ?>
<?php
$this->Paginator->options(array(
	'update' => '#content',
	'evalScripts' => true
));
?>
<div class="col-xs-12">

<?php foreach ($articles as $a): ?>
	<div class="col-lg-4">
        <?php echo $this->Html->image('/img/categories/'.$a['Post']['categories_id'].'.jpg', array('height'=>140, 'width'=>140, 'class'=>'img-circle')); ?>
	    <?php echo "<h2>".$a['Post']['title']."</h2>"; ?>
	    <?php echo "<p>".$this->Text->truncate($a['Post']['contenu'], 200, array('ellipsis'=>'...', 'exact'=>false))."</p>"; ?>
	    <?php echo "<p>".$this->Html->link('En savoir plus', array('action'=>'voir', $a['Post']['id']), array('class'=>'btn btn-default', 'role'=>'button'))."</p>" ?>
	</div>
<?php endforeach ?>
</div>
<div class="span12" style="text-align:center;">
	<?php
	if($count < 2)
	echo $this->Paginator->numbers(array(
		'before'=>'<ul class="">',
		'separator'=>' / ',
		'currentClass'=>'active',
		'tag'=>'',
		'after'=>'</ul>'
		));
	$count++;?>
</div>
<?php echo $this->Js->writeBuffer(); ?>
