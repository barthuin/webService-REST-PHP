<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;

// cli-config.php
require_once "bootstrap.php";

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);
?>