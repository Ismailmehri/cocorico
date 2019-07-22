<?php
	passthru("php7.3 /home/jobberf/www/jobber/bin/console cocorico:bookings:alertImminent --env=prod");
	error_log(date("[Y-m-d H:i:s]")."\t[INFO]\t[CRON]\tcocorico:bookings:alertImminent \n", 3, "/home/jobberf/www/jobber/var/logs/cron.log");  