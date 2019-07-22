<?php
	passthru("php7.3 /home/jobberf/www/jobber/bin/console cocorico:bookings:alertExpiring --env=prod");
	error_log(date("[Y-m-d H:i:s]")."\t[INFO]\t[CRON]\tcocorico:bookings:alertExpiring \n", 3, "/home/jobberf/www/jobber/var/logs/cron.log");  