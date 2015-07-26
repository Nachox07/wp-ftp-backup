# wp-ftp-backup
Script that allows you to upload files inside Wordpress uploads folder to a FTP or CDN with a cron job. Basically this puts all the new files the day which the script is executed.

Usage: `php ./wp-ftp-backup.php up`

I recommend to use with a cron job which execute the script everyday at 23:59

You can also add the script output in a log with the following command:

`php ./wp-ftp-backup.php up > log.txt`
