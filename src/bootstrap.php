<?php

declare(strict_types=1);

$vendorAutoload = __DIR__ . '/../vendor/autoload.php';
if (file_exists($vendorAutoload)) {
	require $vendorAutoload;
} else {
	// Fallback PSR-4 autoloader for Saavn\\ namespace when Composer isn't installed yet
	spl_autoload_register(function ($class) {
		$prefix = 'Saavn\\';
		$baseDir = __DIR__ . '/';
		$len = strlen($prefix);
		if (strncmp($prefix, $class, $len) !== 0) {
			return;
		}
		$relativeClass = substr($class, $len);
		$file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';
		if (file_exists($file)) {
			require $file;
		}
	});
}

use Saavn\Helpers\Response;

// Global JSON headers for all responses
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
	echo json_encode(['success' => true]);
	exit;
}

set_exception_handler(function (Throwable $e) {
	$code = method_exists($e, 'getCode') && $e->getCode() ? (int)$e->getCode() : 500;
	Response::json(['success' => false, 'message' => $e->getMessage()], $code ?: 500);
	exit;
});

set_error_handler(function ($severity, $message, $file, $line) {
	throw new ErrorException($message, 500, $severity, $file, $line);
});
