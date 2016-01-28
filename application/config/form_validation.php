<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = 
array(
    	
'users/update' => array(
	    		array(
			        'field' => 'email',
			        'label' => 'Email Address',
			        'rules' => 'required|valid_email'
			    ),
			    array(
			        'field' => 'first_name',
			        'label' => 'First Name',
			        'rules' => 'required'
			    ),
			    array(
			        'field' => 'last_name',
			        'label' => 'Last Name',
			        'rules' => 'required'
			    ),
			    array(
			        'field' => 'handicap',
			        'label' => 'Handicap',
			        'rules' => 'decimal'
			    )
		),
'users/signup' => array(
	    		array(
			        'field' => 'email',
			        'label' => 'Email Address',
			        'rules' => 'required|valid_email'
			    ),
			    array(
			        'field' => 'first_name',
			        'label' => 'First Name',
			        'rules' => 'required'
			    ),
			    array(
			        'field' => 'last_name',
			        'label' => 'Last Name',
			        'rules' => 'required'
			    ),
			    array(
			        'field' => 'handicap',
			        'label' => 'Handicap',
			        'rules' => 'decimal'
			    )
		)	
	);