<div style="text-align:center; width:100%; position:relative; display:inline-block;">
<?php
    echo validation_errors();
    $attributes['class'] = 'form-signup';
    echo form_open($form_location, $attributes);
    echo $this->session->flashdata('message');
?>
        <h2 class="form-signin-heading">Sign Up</h2>
        <div class="col-xs-12" style="height:25px;"></div>
        <div class="col-xs-12 col-xs-offset-0 col-sm-3 col-sm-offset-2">
            <label for="inputFirstName" class="">First Name</label>
            <?php echo form_input($first_name); ?>            
        </div>
        <div class="col-xs-12 col-sm-3">
            <label for="inputLastName" class="">Last Name</label>
            <?php echo form_input($last_name); ?> 
        </div>
        <div class="col-xs-12" style="height:25px;"></div>
        <div class="col-xs-12 col-xs-offset-0 col-sm-4 col-sm-offset-2">
            <label for="inputEmail" class="">Email</label>
            <?php echo form_input($email); ?> 
        </div>
        <div class="col-xs-12 col-sm-4">
            <label for="inputPassword" class="">Password</label>
            <?php echo form_input($password); ?> 
        </div>
        <div class="col-xs-12" style="height:25px;"></div>
        <div class="col-xs-12" style="height:25px;"></div>
	    <div class="col-xs-6 col-xs-offset-3 col-sm-4 col-sm-offset-4">
        	<button class="btn btn-lg btn-primary btn-block" type="submit">Sign Up</button>
        </div>

    <?php echo form_close(); ?>

    <div class="col-xs-12" style="height:15px;"></div>
    <div class="col-xs-12"> - or - </div>
    <div class="col-xs-12" style="height:15px;"></div>
    <div class="col-xs-6 col-xs-offset-3 col-sm-4 col-sm-offset-4">
    	<a class="btn btn-lg btn-success btn-block" role="button" href="<?php echo base_url(); ?>users">Log In</a>
    </div>
</div>