<?php

if (\file_exists(__DIR__ . '/../../../PrestaShop/tests-legacy')) {
    require_once __DIR__ . '/../../../PrestaShop/tests-legacy/bootstrap.php';
} else {
    require_once __DIR__ . '/../../../PrestaShop/tests/bootstrap.php';
}

require_once dirname(__DIR__) . '../../../PrestaShop/config/config.inc.php';
require_once dirname(__DIR__) . '../../../PrestaShop/config/defines_uri.inc.php';
require_once dirname(__DIR__) . '../../simlachat/bootstrap.php';
require_once __DIR__ . '/../../simlachat/simlachat.php';
require_once __DIR__ . '/../helpers/SimlachatTestCase.php';
require_once dirname(__DIR__) . '../../../PrestaShop/init.php';

$module = new Simlachat();
$module->install();
