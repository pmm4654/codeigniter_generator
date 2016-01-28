<div style="text-align:center; width:100%; position:relative; display:inline-block;">
	<?php 
    $attributes['class'] = 'form-signin';
    echo form_open($form_location, $attributes); 
    ?>
        <h2 class="form-signin-heading">Log In</h2>
        <div class="col-xs-12" style="height:25px;"></div>
        <div id="infoMessage"><?php echo $this->session->flashdata('message'); ?></div>
        <div class="col-xs-12 col-xs-offset-0 col-sm-4 col-sm-offset-2">
        	<!--<label for="inputEmail" class="">Email</label>-->
            <label><?php echo lang('login_identity_label', 'identity');?></label>
            <?php echo form_input($identity); ?>
        </div>
        <div class="col-xs-12 col-sm-4">
        	<!--<label for="inputPassword" class="">Password</label>-->
            <label for><?php echo lang('login_password_label', 'password');?></label>
            <?php echo form_input($password); ?>
        </div>
        <div class="col-xs-12" style="margin:15px 0px;">
	        <div class="checkbox">
	          <label>
                    <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
                    <?php echo lang('login_remember_label', 'remember');?>
	          </label>
	        </div>
	    </div>
        <div class="col-xs-6 col-xs-offset-3 col-sm-4 col-sm-offset-4">
        	<button class="btn btn-lg btn-success btn-block" type="submit">Log In</button>
        </div>
    <?php echo form_close(); ?>

    <div class="col-xs-12" style="height:15px;"></div>
    <div class="col-xs-12"> - or - </div>
    <div class="col-xs-12" style="height:15px;"></div>
    <div class="col-xs-6 col-xs-offset-3 col-sm-4 col-sm-offset-4">
    	<a class="btn btn-lg btn-primary btn-block" role="button" href="<?php echo base_url(); ?>users/signup">Sign Up</a>
    </div>
</div>