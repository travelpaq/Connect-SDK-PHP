<?php

require "vendor/autoload.php";

use TravelPAQ\PackagesAPI\PackagesAPI;



$tp = new PackagesAPI('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpIjoiNTAifQ.35LFiBOikbD0zQxSlXKe6_t2jltNxQc3FZm5cMGKssA');
echo $tp->getPackageList([]);