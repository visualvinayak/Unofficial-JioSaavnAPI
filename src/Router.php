<?php

declare(strict_types=1);

namespace Saavn;

use Saavn\Controllers\SearchController;
use Saavn\Controllers\SongController;
use Saavn\Controllers\AlbumController;
use Saavn\Controllers\ArtistController;
use Saavn\Controllers\PlaylistController;
use Saavn\Helpers\Response;

final class Router
{
	public static function handle(): void
	{
		$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
		$uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);

		if ($uri === '/' || $uri === '/docs') {
			Response::json([
				'success' => true,
				'message' => 'JioSaavn PHP API',
				'docs' => 'https://saavn.dev/docs'
			]);
			return;
		}

		$apiPos = strpos($uri, '/api');
		if ($apiPos === false) {
			Response::json(['success' => false, 'message' => 'route not found, check docs at https://saavn.dev/docs'], 404);
			return;
		}

		$path = substr($uri, $apiPos + 4) ?: '/';

		switch (true) {
			case $method === 'GET' && $path === '/search':
				(new SearchController())->search();
				return;
			case $method === 'GET' && $path === '/search/songs':
				(new SearchController())->searchSongs();
				return;
			case $method === 'GET' && $path === '/search/albums':
				(new SearchController())->searchAlbums();
				return;
			case $method === 'GET' && $path === '/search/artists':
				(new SearchController())->searchArtists();
				return;
			case $method === 'GET' && $path === '/search/playlists':
				(new SearchController())->searchPlaylists();
				return;

			case $method === 'GET' && $path === '/songs':
				(new SongController())->getByIdsOrLink();
				return;
			case $method === 'GET' && preg_match('#^/songs/([^/]+)$#', $path, $m):
				(new SongController())->getById($m[1]);
				return;
			case $method === 'GET' && preg_match('#^/songs/([^/]+)/suggestions$#', $path, $m):
				(new SongController())->getSuggestions($m[1]);
				return;

			case $method === 'GET' && $path === '/albums':
				(new AlbumController())->getByIdOrLink();
				return;

			case $method === 'GET' && $path === '/artists':
				(new ArtistController())->getByIdOrLink();
				return;
			case $method === 'GET' && $path === '/artists/songs':
				(new ArtistController())->getSongs();
				return;
			case $method === 'GET' && $path === '/artists/albums':
				(new ArtistController())->getAlbums();
				return;

			case $method === 'GET' && $path === '/playlists':
				(new PlaylistController())->getByIdOrLink();
				return;

			default:
				Response::json(['success' => false, 'message' => 'route not found, check docs at https://saavn.dev/docs'], 404);
				return;
		}
	}
}
