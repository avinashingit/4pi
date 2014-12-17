<?php

	//-10 for password mismatch
	session_start();
	var password1=$_POST['passwordOne'];
	var password2=$_POST['passwordTwo'];
	if(password1!=password2)
		{	
			echo -10;
		}
	else
		{
			}
			?>	