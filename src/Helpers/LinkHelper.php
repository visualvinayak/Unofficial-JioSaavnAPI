<?php

declare(strict_types=1);

namespace Saavn\Helpers;

final class LinkHelper
{
	public static function createImageLinks(?string $link): array
	{
		if (!$link) return [];
		$qualities = ['50x50', '150x150', '500x500'];
		$qualityRegex = '/150x150|50x50/';
		$protocolRegex = '/^http:\/\//';
		$httpsLink = preg_replace($protocolRegex, 'https://', $link);
		$result = [];
		foreach ($qualities as $q) {
			$result[] = [
				'quality' => $q,
				'url' => preg_replace($qualityRegex, $q, $httpsLink)
			];
		}
		return $result;
	}

	public static function createDownloadLinks(?string $encryptedMediaUrl): array
	{
		if (!$encryptedMediaUrl) return [];
		$qualities = [
			['_12', '12kbps'],
			['_48', '48kbps'],
			['_96', '96kbps'],
			['_160', '160kbps'],
			['_320', '320kbps'],
		];
		$key = '38346591';
		$decoded = base64_decode($encryptedMediaUrl, true);
		if ($decoded === false) return [];

		// DES-ECB with raw data + zero padding; then remove PKCS#7 padding manually
		$decrypted = openssl_decrypt($decoded, 'DES-ECB', $key, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING);
		if ($decrypted === false) return [];

		$len = strlen($decrypted);
		if ($len > 0) {
			$pad = ord($decrypted[$len - 1]);
			if ($pad > 0 && $pad <= 16) {
				$decrypted = substr($decrypted, 0, $len - $pad);
			}
		}

		$links = [];
		foreach ($qualities as [$id, $bitrate]) {
			$links[] = [
				'quality' => $bitrate,
				'url' => str_replace('_96', $id, $decrypted)
			];
		}
		return $links;
	}
}
