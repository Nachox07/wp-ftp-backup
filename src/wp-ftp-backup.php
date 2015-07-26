<?php
/*
* WP-FTP-Backup
* By Nacho González-Garilleti Ruiz - http://github.com/nachox07
* 18/07/2015
* v.1.0
*/

/* Restriction to execute command php ./wp-ftp-backup.php up */

if($_SERVER['argv']['1'] == "up")
{
	$ftp_server = "127.0.0.1";
	$ftp_user = "MyUser";
	$ftp_pass = "MyPassword";

	$dt = date('Y/m');

	$path = opendir('/wp-content/uploads/'.$dt);

	$connect = ftp_connect($ftp_server) or die ("Connection error");
	$result = ftp_login($connect, $ftp_user, $ftp_pass);

	/* Passive mode */

	ftp_pasv($connect, true);

	/* Upload start*/

	if($result)
	{
		echo "Login success\n";

		$dir = ftp_rawlist($connect, './'.$dt);

		$today = date('Y/m/d');

		echo "Uploading files...\n";

		/* We create necessary folders at beginning of the month and year */

		if(date("m/d") == "01/01")
		{
			if(ftp_mkdir($connect, date("Y")))
			{
				echo "Year directory ".date("Y")." was created successfully\n";
			}
		}

		if(date("d") == "01")
		{
			if(ftp_mkdir($connect, $dt))
			{
				echo "Month directory ".$dt." was created successfully\n";
			}
		}

		while (false !== ($entry = readdir($path)))
		{
			if(date('Y/m/d', filectime('../wp-content/uploads/'.$dt.'/'.$entry)) == $today)
			{
				if(ftp_put($connect, './'.$dt.'/'.$entry, '../wp-content/uploads/'.$dt.'/'.$entry, FTP_ASCII))
				{
	    			echo $entry." uploaded\n";
				}
			}
		}
	}
	
	ftp_close($connect);
}

?>
