<?php
// FlashData Messages
if ($this->session->flashdata('error')){    
    echo '<p class="error">'.$this->session->flashdata('error').'</p>';
}
if ($this->session->flashdata('success')){    
    echo '<p class="success">'.$this->session->flashdata('success').'</p>';
}
// Validation Errors
echo validation_errors(); 