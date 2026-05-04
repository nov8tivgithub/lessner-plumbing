<? echo $this->load->view('frontend/includes'); ?>
	<div class="fixheader">
	<? echo $this->load->view('frontend/header'); ?>
	<div class="clear"></div>
	</div>

	
	<div class="pnotfundwrap">
		
		<div class="midpnotfund">
        	<div class="leftpnot">
            	<p class="fornotfor">404</p>
                <p class="reqst">The requested resource could not be found</p>
                <a href="<? echo base_url(); ?>" class="gobkman">Go back to Home</a>
            </div>
            <div class="pic404">
            	<img src="<? echo base_url(); ?>/images/404.png" width="369" alt="404" />
            </div>
        <div class="clear"></div>
        </div>
		
	<div class="clear"></div>	
	</div>
	
<? echo $this->load->view('frontend/footer'); ?>