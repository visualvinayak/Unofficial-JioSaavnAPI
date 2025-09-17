<?php

declare(strict_types=1);

namespace Saavn\Controllers;

use Saavn\Helpers\JioSaavnClient;
use Saavn\Helpers\Response;
use Saavn\Services\Mappers;

final class ArtistController
{
	public function getByIdOrLink(): void
	{
		$id = isset($_GET['id']) ? trim((string)$_GET['id']) : null;
		$link = isset($_GET['link']) ? trim((string)$_GET['link']) : null;
		$page = (int)($_GET['page'] ?? 0);
		$sortBy = (string)($_GET['sortBy'] ?? 'popularity');
		$sortOrder = (string)($_GET['sortOrder'] ?? 'asc');
		$songCount = (int)($_GET['songCount'] ?? 10);
		$albumCount = (int)($_GET['albumCount'] ?? 10);

		$params = [
			'n_song' => $songCount,
			'n_album' => $albumCount,
			'page' => $page,
			'sort_order' => $sortOrder,
			'category' => $sortBy
		];

		if ($id === null && $link === null) {
			Response::json(['success' => false, 'message' => 'Either artist ID or link is required'], 400);
			return;
		}

		if ($link !== null) {
			$token = $this->extractArtistToken($link);
			$data = JioSaavnClient::get('webapi.get', $params + ['token' => $token, 'type' => 'artist']);
			if (!$data) {
				Response::json(['success' => false, 'message' => 'artist not found'], 404);
				return;
			}
			$mapped = Mappers::mapArtist($data);
			Response::json(['success' => true, 'data' => $mapped]);
			return;
		}

		$data = JioSaavnClient::get('artist.getArtistPageDetails', $params + ['artistId' => $id]);
		if (!$data) {
			Response::json(['success' => false, 'message' => 'artist not found'], 404);
			return;
		}
		$mapped = Mappers::mapArtist($data);
		Response::json(['success' => true, 'data' => $mapped]);
	}

	public function getSongs(): void
	{
		$artistId = (string)($_GET['id'] ?? '');
		$page = (int)($_GET['page'] ?? 0);
		$sortOrder = (string)($_GET['sortOrder'] ?? 'asc');
		$category = (string)($_GET['sortBy'] ?? 'popularity');
		$size = (int)($_GET['size'] ?? 10);
		if ($artistId === '') {
			Response::json(['success' => false, 'message' => 'id is required'], 400);
			return;
		}
		$params = ['artistId' => $artistId, 'n' => $size, 'p' => $page, 'sort_order' => $sortOrder, 'category' => $category];
		$data = JioSaavnClient::get('artist.getArtistMoreSong', $params);
		$results = array_map([Mappers::class, 'mapSong'], $data['songs'] ?? []);
		Response::json(['success' => true, 'data' => [
			'total' => $data['total'] ?? null,
			'start' => $data['start'] ?? null,
			'results' => $results,
		]]);
	}

	public function getAlbums(): void
	{
		$artistId = (string)($_GET['id'] ?? '');
		$page = (int)($_GET['page'] ?? 0);
		$sortOrder = (string)($_GET['sortOrder'] ?? 'asc');
		$category = (string)($_GET['sortBy'] ?? 'popularity');
		$size = (int)($_GET['size'] ?? 10);
		if ($artistId === '') {
			Response::json(['success' => false, 'message' => 'id is required'], 400);
			return;
		}
		$params = ['artistId' => $artistId, 'n' => $size, 'p' => $page, 'sort_order' => $sortOrder, 'category' => $category];
		$data = JioSaavnClient::get('artist.getArtistMoreAlbum', $params);
		$results = array_map([Mappers::class, 'mapAlbum'], $data['albums'] ?? []);
		Response::json(['success' => true, 'data' => [
			'total' => $data['total'] ?? null,
			'start' => $data['start'] ?? null,
			'results' => $results,
		]]);
	}

	private function extractArtistToken(string $linkOrToken): string
	{
		if (preg_match('#(jiosaavn|saavn)\.com/artist/[^/]+/([^/]+)$#', $linkOrToken, $m)) {
			return $m[2];
		}
		return $linkOrToken;
	}
}
