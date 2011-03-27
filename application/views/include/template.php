<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
<head profile="http://gmpg.org/xfn/11">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

</head>
<body>
<div id="container">
    <div id="content">
        <div class="interior">
        <!-- Place content below -->
	        <?php
	        // Page Title
	        echo '<h1>'.$title.'</h1>';
	        // FlashData Messages
	        if ($this->session->flashdata('error')){    
	        	echo '<p class="error">'.$this->session->flashdata('error').'</p>';
	    	}
	    	if ($this->session->flashdata('success')){    
	        	echo '<p class="success">'.$this->session->flashdata('success').'</p>';
	    	}
	    	// Validation Errors
	        echo validation_errors();
	        // Specific Template
			$this->load->view($main_content); 
			?>
        <!-- Place content above -->
        </div>
    </div>
</div>
</body>
</html>