<?php
	class Newsletter extends AppModel {
		var $name = 'Newsletter';
		var $hasOne ='Users'; // d'où le Newsletter->Users
		
		public $validate = array(

			'email'=>array(
				'email'=>array(
					'rule'=>'email',
					'message'=>"Cette adresse mail n'est pas valide"
				), // le mail doit être unique, pas de doublon
				'uniq' => array(
                	'rule' => 'isUnique',
                	'message'=>'Cette adresse mail est déjà utilisée'
            	)
			)
	    );
	}
?>