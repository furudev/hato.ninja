<?php

declare(strict_types=1);

$router->get('/api/', 'controllers/index.php', true);
$router->get('/api/contact', 'controllers/contact.php', true);
$router->get('/form', 'controllers/form.php');
