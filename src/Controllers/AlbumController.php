<?php

declare(strict_types=1);

namespace Saavn\Controllers;

use Saavn\Helpers\JioSaavnClient;
use Saavn\Helpers\Response;
use Saavn\Services\Mappers;

final class AlbumController
{
	public function getByIdOrLink(): void
	{
		$id = isset($_GET['id']) ? trim((string)$_GET['id']) : null;
		$link = isset($_GET['link']) ? trim((string)$_GET['link']) : null;

		if ($id === null && $link === null) {
			Response::json(['success' => false, 'message' => 'Either album ID or link is required'], 400);
			return;
		}

		if ($link !== null) {
			$token = $this->extractAlbumToken($link);
			$data = JioSaavnClient::get('webapi.get', ['token' => $token, 'type' => 'album']);
			if (!$data) {
				Response::json(['success' => false, 'message' => 'album not found'], 404);
				return;
			}
			$mapped = Mappers::mapAlbum($data);
			Response::json(['success' => true, 'data' => $mapped]);
			return;
		}

		$data = JioSaavnClient::get('content.getAlbumDetails', ['albumid' => $id]);
		if (!$data) {
			Response::json(['success' => false, 'message' => 'album not found'], 404);
			return;
		}
		$mapped = Mappers::mapAlbum($data);
		Response::json(['success' => true, 'data' => $mapped]);
	}

	private function extractAlbumToken(string $linkOrToken): string
	{
		if (preg_match('#(jiosaavn|saavn)\.com/album/[^/]+/([^/]+)$#', $linkOrToken, $m)) {
			return $m[2];
		}
		return $linkOrToken;
	}
}
