<?php declare(strict_types=1);

namespace FastBillSdk\Invoice;

use FastBillSdk\Api\ApiClient;
use FastBillSdk\Common\XmlService;
use FastBillSdk\Item\ItemEntity;
use FastBillSdk\Item\ItemValidator;

error_reporting(E_ALL);
ini_set('display_errors', 'on');

require_once __DIR__ . '/../credentials.php';
require_once __DIR__ . '/../../vendor/autoload.php';

$fastBillClient = new ApiClient($username, $apiKey);

$invoiceService = new InvoiceService(
    $fastBillClient,
    new XmlService(),
    new InvoiceValidator(new ItemValidator())
);

$invoiceEntity = new InvoiceEntity();
$invoiceEntity->customerId = 123;
$invoiceEntity->projectId = 456;
$invoiceItem = new ItemEntity();
$invoiceItem->description = 'FastBill SDK';
$invoiceItem->unitPrice = 1337;
$invoiceItem->vatPercent = 19;
$invoiceEntity->items[] = $invoiceItem;
$invoiceEntity->items[] = $invoiceItem;

$result = $invoiceService->createInvoice($invoiceEntity);

ini_set('xdebug.var_display_max_depth', '5');
ini_set('xdebug.var_display_max_children', '256');
ini_set('xdebug.var_display_max_data', '1024');
echo '<pre>';
var_dump($result);
echo '</pre>';
die();
