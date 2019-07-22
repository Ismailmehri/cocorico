<?php
	passthru("php7.3 /home/jobberf/www/jobber/bin/console cocorico:bookings:expire --env=prod");
	error_log(date("[Y-m-d H:i:s]")."\t[INFO]\t[CRON]\tcocorico:bookings:expire \n", 3, "/home/jobberf/www/jobber/var/logs/cron.log");  