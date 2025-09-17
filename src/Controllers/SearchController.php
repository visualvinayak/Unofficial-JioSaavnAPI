<?php

declare(strict_types=1);

namespace Saavn\Controllers;

use Saavn\Helpers\JioSaavnClient;
use Saavn\Helpers\Response;
use Saavn\Services\Mappers;

final class SearchController
{
	public function search(): void
	{
		$query = trim((string)($_GET['query'] ?? ''));
		if ($query === '') {
			Response::json(['success' => false, 'message' => 'query is required'], 400);
			return;
		}

		$data = JioSaavnClient::get('autocomplete.get', ['query' => $query]);
		$mapped = Mappers::mapSearchAll($data);
		Response::json(['success' => true, 'data' => $mapped]);
	}

	public function searchSongs(): void
	{
		$this->pagedSearch('search.getResults', fn($d) => [
			'total' => $d['total'] ?? 0,
			'start' => $d['start'] ?? 0,
			'results' => array_map([Mappers::class, 'mapSong'], $d['results'] ?? []),
		]);
	}

	public function searchAlbums(): void
	{
		$this->pagedSearch('search.getAlbumResults', fn($d) => [
			'total' => $d['total'] ?? 0,
			'start' => $d['start'] ?? 0,
			'results' => array_map([Mappers::class, 'mapAlbum'], $d['results'] ?? []),
		]);
	}

	public function searchArtists(): void
	{
		$this->pagedSearch('search.getArtistResults', fn($d) => [
			'total' => $d['total'] ?? 0,
			'start' => $d['start'] ?? 0,
			'results' => array_map([Mappers::class, 'mapArtist'], $d['results'] ?? []),
		]);
	}

	public function searchPlaylists(): void
	{
		$this->pagedSearch('search.getPlaylistResults', fn($d) => [
			'total' => $d['total'] ?? 0,
			'start' => $d['start'] ?? 0,
			'results' => array_map([Mappers::class, 'mapPlaylist'], $d['results'] ?? []),
		]);
	}

	private function pagedSearch(string $endpoint, callable $mapper): void
	{
		$query = trim((string)($_GET['query'] ?? ''));
		$page = (int)($_GET['page'] ?? 0);
		$limit = (int)($_GET['limit'] ?? 10);

		if ($query === '') {
			Response::json(['success' => false, 'message' => 'query is required'], 400);
			return;
		}

		$params = ['q' => $query, 'p' => $page, 'n' => $limit];
		$data = JioSaavnClient::get($endpoint, $params);
		$mapped = $mapper($data);
		if (isset($mapped['results']) && is_array($mapped['results'])) {
			$mapped['results'] = array_slice($mapped['results'], 0, $limit);
		}
		Response::json(['success' => true, 'data' => $mapped]);
	}
}
