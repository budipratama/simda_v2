<!-- BEGIN CONTAINER -->
<div class="page-container">
	<?php 
	echo $this->load->view($sidebar['view'], $sidebar['dataset']);
	echo $this->load->view($content['view'], $content['dataset']);
	?>
</div>
<!-- END CONTAINER -->