<?php
	passthru("php7.3 /home/jobberf/www/jobber/bin/console cocorico:listings:alertUpdateCalendars --env=prod");
	error_log(date("[Y-m-d H:i:s]")."\t[INFO]\t[CRON]\tcocorico:listings:alertUpdateCalendars \n", 3, "/home/jobberf/www/jobber/var/logs/cron.log");  