# wp-ftp-backup
Function that allows you to upload files inside Wordpress uploads folder to a FTP or CDN with a cron job

Usage: `php ./wp-ftp-backup.php up`

I recommend to use with a cron job which execute the script everyday at 23:59

You can also add the script output in a log with the following command: `php ./wp-ftp-backup.php up > log.txt`
