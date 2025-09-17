<?php

declare(strict_types=1);

namespace Saavn\Controllers;

use Saavn\Helpers\JioSaavnClient;
use Saavn\Helpers\Response;
use Saavn\Services\Mappers;

final class SongController
{
	public function getByIdsOrLink(): void
	{
		$ids = isset($_GET['ids']) ? trim((string)$_GET['ids']) : null;
		$link = isset($_GET['link']) ? trim((string)$_GET['link']) : null;

		if ($ids === null && $link === null) {
			Response::json(['success' => false, 'message' => 'Either song IDs or link is required'], 400);
			return;
		}

		if ($link !== null) {
			$token = $this->extractSongToken($link);
			$data = JioSaavnClient::get('webapi.get', ['token' => $token, 'type' => 'song']);
			$songs = $data['songs'] ?? [];
			if (!$songs) {
				Response::json(['success' => false, 'message' => 'song not found'], 404);
				return;
			}

			// Enrich with song.getDetails to ensure encrypted_media_url is available
			$idsList = array_values(array_filter(array_map(fn($s) => $s['id'] ?? null, $songs)));
			if ($idsList) {
				$details = JioSaavnClient::get('song.getDetails', ['pids' => implode(',', $idsList)]);
				if (!empty($details['songs'])) {
					$songs = $details['songs'];
				}
			}

			$mapped = array_map([Mappers::class, 'mapSong'], $songs);
			Response::json(['success' => true, 'data' => $mapped]);
			return;
		}

		$data = JioSaavnClient::get('song.getDetails', ['pids' => $ids]);
		$songs = $data['songs'] ?? [];
		if (!$songs) {
			Response::json(['success' => false, 'message' => 'song not found'], 404);
			return;
		}
		$mapped = array_map([Mappers::class, 'mapSong'], $songs);
		Response::json(['success' => true, 'data' => $mapped]);
	}

	public function getById(string $id): void
	{
		$data = JioSaavnClient::get('song.getDetails', ['pids' => $id]);
		$songs = $data['songs'] ?? [];
		if (!$songs) {
			Response::json(['success' => false, 'message' => 'song not found'], 404);
			return;
		}
		$mapped = array_map([Mappers::class, 'mapSong'], $songs);
		Response::json(['success' => true, 'data' => $mapped]);
	}

	public function getSuggestions(string $id): void
	{
		$limit = (int)($_GET['limit'] ?? 10);
		$stationId = $this->createSongStation($id);
		$data = JioSaavnClient::get('webradio.getSong', ['stationid' => $stationId, 'k' => $limit], 'android');
		if (!$data) {
			Response::json(['success' => false, 'message' => 'no suggestions found for the given song'], 404);
			return;
		}
		unset($data['stationid']);
		$suggestions = [];
		foreach ($data as $entry) {
			if (isset($entry['song'])) {
				$suggestions[] = Mappers::mapSong($entry['song']);
			}
		}
		$suggestions = array_slice($suggestions, 0, $limit);
		Response::json(['success' => true, 'data' => $suggestions]);
	}

	private function createSongStation(string $songId): string
	{
		$encoded = json_encode([rawurlencode($songId)], JSON_UNESCAPED_SLASHES);
		$data = JioSaavnClient::get('webradio.createEntityStation', [
			'entity_id' => $encoded,
			'entity_type' => 'queue',
		], 'android');
		$station = $data['stationid'] ?? null;
		if (!$station) {
			throw new \RuntimeException('could not create station', 500);
		}
		return $station;
	}

	private function extractSongToken(string $linkOrToken): string
	{
		if (preg_match('#jiosaavn\.com/song/[^/]+/([^/]+)$#', $linkOrToken, $m)) {
			return $m[1];
		}
		return $linkOrToken;
	}
}
