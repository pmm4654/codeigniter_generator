<div style="text-align:center; width:100%; position:relative; display:inline-block;">
<h1>Welcome <?php echo $user->first_name.' '.$user->last_name; ?></h1>
	<p>Email: <?php echo $user->email; ?></p>
	<p>Phone: <?php echo $user->phone; ?></p>
</div>
<div class="col-xs-6 col-xs-offset-3 col-sm-4 col-sm-offset-4">
   <a class="btn btn-lg btn-success btn-block" role="button" href="<?php echo base_url(); ?>users/updateinfo">Update Info</a>
</div>
<div class="col-xs-12" style="height:15px;"></div>
<div class="col-xs-12 text-center"> - or - </div>
<div class="col-xs-12" style="height:15px;"></div>
<div class="col-xs-6 col-xs-offset-3 col-sm-4 col-sm-offset-4">
	<a class="btn btn-lg btn-primary btn-block" role="button" href="<?php echo base_url(); ?>users/logout">Log Out</a>
</div>