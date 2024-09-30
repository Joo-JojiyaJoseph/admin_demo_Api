<?php

// Use the Artisan command to clear the configuration cache
$output = shell_exec('php artisan config:clear');

// Display the output of the Artisan command
echo "<pre>$output</pre>";
