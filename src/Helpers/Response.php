<?php

declare(strict_types=1);

namespace Saavn\Helpers;

final class Response
{
	public static function json(array $body, int $status = 200): void
	{
		http_response_code($status);
		echo json_encode($body, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
	}
}
