<ul>
		<div class="title">
	 	  <span class="indicator" style="background:#<?php echo $alert->hex1; ?>!important"></span>
	  	  <?php echo $alert->title; ?>
		</div>
 	       <p class="msg">
		  <?php echo $alert->copy; ?>
	       </p>
	<a href="/remove/<?php echo $alert->id; ?>" class="btn">Clear Alert</a>
</ul>