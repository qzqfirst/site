<?php
$this->load->helper('form');
echo form_open('admin/do_login');
echo "User: " . form_input('user') . "<br />\n";
echo "Pass: " . form_password('pass') . "<br />\n";
echo form_submit('submit', 'Log in');
echo form_close();
?>