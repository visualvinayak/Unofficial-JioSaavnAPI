<?php

declare(strict_types=1);

namespace Saavn\Controllers;

use Saavn\Helpers\JioSaavnClient;
use Saavn\Helpers\Response;
use Saavn\Services\Mappers;

final class PlaylistController
{
	public function getByIdOrLink(): void
	{
		$id = isset($_GET['id']) ? trim((string)$_GET['id']) : null;
		$link = isset($_GET['link']) ? trim((string)$_GET['link']) : null;
		$page = (int)($_GET['page'] ?? 0);
		$limit = (int)($_GET['limit'] ?? 10);

		if ($id === null && $link === null) {
			Response::json(['success' => false, 'message' => 'Either playlist ID or link is required'], 400);
			return;
		}

		if ($link !== null) {
			$token = $this->extractPlaylistToken($link);
			$data = JioSaavnClient::get('webapi.get', ['token' => $token, 'type' => 'playlist', 'p' => $page, 'n' => $limit]);
			if (!$data) {
				Response::json(['success' => false, 'message' => 'playlist not found'], 404);
				return;
			}
			$mapped = Mappers::mapPlaylist($data);
			$mapped['songCount'] = isset($mapped['songs']) && is_array($mapped['songs']) ? count($mapped['songs']) : null;
			$mapped['songs'] = isset($mapped['songs']) && is_array($mapped['songs']) ? array_slice($mapped['songs'], 0, $limit) : null;
			Response::json(['success' => true, 'data' => $mapped]);
			return;
		}

		$data = JioSaavnClient::get('playlist.getDetails', ['listid' => $id, 'p' => $page, 'n' => $limit]);
		if (!$data) {
			Response::json(['success' => false, 'message' => 'playlist not found'], 404);
			return;
		}
		$mapped = Mappers::mapPlaylist($data);
		$mapped['songCount'] = isset($mapped['songs']) && is_array($mapped['songs']) ? count($mapped['songs']) : null;
		$mapped['songs'] = isset($mapped['songs']) && is_array($mapped['songs']) ? array_slice($mapped['songs'], 0, $limit) : null;
		Response::json(['success' => true, 'data' => $mapped]);
	}

	private function extractPlaylistToken(string $linkOrToken): string
	{
		if (preg_match('#(jiosaavn|saavn)\.(com)/((featured|s/playlist)/[^/]+/([^/]+))#', $linkOrToken, $m)) {
			return $m[5];
		}
		return $linkOrToken;
	}
}
