<?php

declare(strict_types=1);

namespace Saavn\Helpers;

final class JioSaavnClient
{
	private const BASE_URL = 'https://www.jiosaavn.com/api.php';
	private const DEFAULT_PARAMS = [
		'__call' => '',
		'_format' => 'json',
		'_marker' => '0',
		'api_version' => '4',
		'ctx' => 'web6dot0'
	];

	private static array $userAgents = [
		'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36',
		'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.2 Safari/605.1.15',
		'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36',
		'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:124.0) Gecko/20100101 Firefox/124.0'
	];

	public static function get(string $endpoint, array $params, ?string $context = null): array
	{
		$defaults = self::DEFAULT_PARAMS;
		if ($context === 'android') {
			$defaults['ctx'] = 'android';
		}
		$query = array_merge($defaults, ['__call' => $endpoint], $params);
		$url = self::BASE_URL . '?' . http_build_query($query);

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Content-Type: application/json',
			'User-Agent: ' . self::$userAgents[array_rand(self::$userAgents)]
		]);

		$response = curl_exec($ch);
		if ($response === false) {
			$error = curl_error($ch);
			curl_close($ch);
			throw new \RuntimeException('Failed to fetch from JioSaavn: ' . $error, 502);
		}

		$httpCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		$data = json_decode($response, true);
		if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
			throw new \RuntimeException('Invalid JSON from JioSaavn', 502);
		}

		if ($httpCode < 200 || $httpCode >= 300) {
			throw new \RuntimeException('JioSaavn returned status ' . $httpCode, $httpCode);
		}

		return $data ?? [];
	}
}
