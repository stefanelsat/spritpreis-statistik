<?php
$pythoncmd = 'python /home/pi/Development/projects/weather_htu21d/measure.py 2>&1';
$output = shell_exec($pythoncmd);
print json_encode($output);
