<?php

declare(strict_types=1);

namespace Saavn\Services;

use Saavn\Helpers\LinkHelper;

final class Mappers
{
	public static function mapArtistMap(?array $artist): ?array
	{
		if (!$artist) return null;
		return [
			'id' => $artist['id'] ?? null,
			'name' => $artist['name'] ?? null,
			'role' => $artist['role'] ?? null,
			'url' => $artist['perma_url'] ?? null,
			'image' => LinkHelper::createImageLinks($artist['image_url'] ?? null)
		];
	}

	public static function mapSong(array $song): array
	{
		$more = $song['more_info'] ?? [];
		$artistMap = $more['artistMap'] ?? [];
		return [
			'id' => $song['id'] ?? null,
			'name' => $song['title'] ?? null,
			'type' => $song['type'] ?? null,
			'year' => $song['year'] ?? null,
			'releaseDate' => $more['release_date'] ?? null,
			'duration' => isset($more['duration']) ? (int)$more['duration'] : null,
			'label' => $more['label'] ?? null,
			'explicitContent' => ($song['explicit_content'] ?? '0') === '1',
			'playCount' => isset($song['play_count']) ? (int)$song['play_count'] : null,
			'language' => $song['language'] ?? null,
			'hasLyrics' => ($more['has_lyrics'] ?? 'false') === 'true',
			'lyricsId' => $more['lyrics_id'] ?? null,
			'url' => $song['perma_url'] ?? null,
			'copyright' => $more['copyright_text'] ?? null,
			'album' => [
				'id' => $more['album_id'] ?? null,
				'name' => $more['album'] ?? null,
				'url' => $more['album_url'] ?? null,
			],
			'artists' => [
				'primary' => array_map([self::class, 'mapArtistMap'], $artistMap['primary_artists'] ?? []),
				'featured' => array_map([self::class, 'mapArtistMap'], $artistMap['featured_artists'] ?? []),
				'all' => array_map([self::class, 'mapArtistMap'], $artistMap['artists'] ?? []),
			],
			'image' => LinkHelper::createImageLinks($song['image'] ?? null),
			'downloadUrl' => LinkHelper::createDownloadLinks($more['encrypted_media_url'] ?? null),
		];
	}

	public static function mapAlbum(array $album): array
	{
		$more = $album['more_info'] ?? [];
		$artistMap = $more['artistMap'] ?? [];
		return [
			'id' => $album['id'] ?? null,
			'name' => $album['title'] ?? null,
			'description' => $album['header_desc'] ?? null,
			'type' => $album['type'] ?? null,
			'year' => isset($album['year']) ? (int)$album['year'] : null,
			'playCount' => isset($album['play_count']) ? (int)$album['play_count'] : null,
			'language' => $album['language'] ?? null,
			'explicitContent' => ($album['explicit_content'] ?? '0') === '1',
			'url' => $album['perma_url'] ?? null,
			'songCount' => isset($more['song_count']) ? (int)$more['song_count'] : null,
			'artists' => [
				'primary' => array_map([self::class, 'mapArtistMap'], $artistMap['primary_artists'] ?? []),
				'featured' => array_map([self::class, 'mapArtistMap'], $artistMap['featured_artists'] ?? []),
				'all' => array_map([self::class, 'mapArtistMap'], $artistMap['artists'] ?? []),
			],
			'image' => LinkHelper::createImageLinks($album['image'] ?? null),
			'songs' => isset($album['list']) && is_array($album['list']) ? array_map([self::class, 'mapSong'], $album['list']) : null,
		];
	}

	public static function mapPlaylist(array $playlist): array
	{
		$more = $playlist['more_info'] ?? [];
		return [
			'id' => $playlist['id'] ?? null,
			'name' => $playlist['title'] ?? null,
			'description' => $playlist['header_desc'] ?? null,
			'type' => $playlist['type'] ?? null,
			'year' => isset($playlist['year']) ? (int)$playlist['year'] : null,
			'playCount' => isset($playlist['play_count']) ? (int)$playlist['play_count'] : null,
			'language' => $playlist['language'] ?? null,
			'explicitContent' => ($playlist['explicit_content'] ?? '0') === '1',
			'url' => $playlist['perma_url'] ?? null,
			'songCount' => isset($playlist['list_count']) ? (int)$playlist['list_count'] : null,
			'artists' => isset($more['artists']) && is_array($more['artists']) ? array_map([self::class, 'mapArtistMap'], $more['artists']) : null,
			'image' => LinkHelper::createImageLinks($playlist['image'] ?? null),
			'songs' => isset($playlist['list']) && is_array($playlist['list']) ? array_map([self::class, 'mapSong'], $playlist['list']) : null,
		];
	}

	public static function mapArtist(array $artist): array
	{
		return [
			'id' => $artist['artistId'] ?? $artist['id'] ?? null,
			'name' => $artist['name'] ?? null,
			'url' => ($artist['urls']['overview'] ?? null) ?: ($artist['perma_url'] ?? null),
			'type' => $artist['type'] ?? null,
			'followerCount' => isset($artist['follower_count']) ? (int)$artist['follower_count'] : null,
			'fanCount' => $artist['fan_count'] ?? null,
			'isVerified' => $artist['isVerified'] ?? null,
			'dominantLanguage' => $artist['dominantLanguage'] ?? null,
			'dominantType' => $artist['dominantType'] ?? null,
			'bio' => isset($artist['bio']) ? json_decode($artist['bio'], true) : null,
			'dob' => $artist['dob'] ?? null,
			'fb' => $artist['fb'] ?? null,
			'twitter' => $artist['twitter'] ?? null,
			'wiki' => $artist['wiki'] ?? null,
			'availableLanguages' => $artist['availableLanguages'] ?? null,
			'isRadioPresent' => $artist['isRadioPresent'] ?? null,
			'image' => LinkHelper::createImageLinks($artist['image'] ?? null),
			'topSongs' => isset($artist['topSongs']) ? array_map([self::class, 'mapSong'], $artist['topSongs']) : null,
			'topAlbums' => isset($artist['topAlbums']) ? array_map([self::class, 'mapAlbum'], $artist['topAlbums']) : null,
			'singles' => isset($artist['singles']) ? array_map([self::class, 'mapSong'], $artist['singles']) : null,
			'similarArtists' => isset($artist['similarArtists']) && is_array($artist['similarArtists']) ? array_map(function ($a) {
				return [
					'id' => $a['id'] ?? null,
					'name' => $a['name'] ?? null,
					'url' => $a['perma_url'] ?? null,
					'image' => LinkHelper::createImageLinks($a['image_url'] ?? null),
					'languages' => isset($a['languages']) ? json_decode($a['languages'], true) : null,
					'wiki' => $a['wiki'] ?? null,
					'dob' => $a['dob'] ?? null,
					'fb' => $a['fb'] ?? null,
					'twitter' => $a['twitter'] ?? null,
					'isRadioPresent' => $a['isRadioPresent'] ?? null,
					'type' => $a['type'] ?? null,
					'dominantType' => $a['dominantType'] ?? null,
					'aka' => $a['aka'] ?? null,
					'bio' => isset($a['bio']) ? json_decode($a['bio'], true) : null,
					'similarArtists' => isset($a['similar']) ? json_decode($a['similar'], true) : null,
				];
			}, $artist['similarArtists']) : null,
		];
	}

	public static function mapSearchAll(array $data): array
	{
		$mapList = fn($list, $shape) => array_map($shape, $list ?? []);
		return [
			'topQuery' => [
				'results' => $mapList($data['topquery']['data'] ?? [], function ($item) {
					return [
						'id' => $item['id'] ?? null,
						'title' => $item['title'] ?? null,
						'image' => LinkHelper::createImageLinks($item['image'] ?? null),
						'album' => $item['more_info']['album'] ?? null,
						'url' => $item['perma_url'] ?? null,
						'type' => $item['type'] ?? null,
						'language' => $item['more_info']['language'] ?? null,
						'description' => $item['description'] ?? null,
						'primaryArtists' => $item['more_info']['primary_artists'] ?? null,
						'singers' => $item['more_info']['singers'] ?? null,
					];
				}),
				'position' => $data['topquery']['position'] ?? null,
			],
			'songs' => [
				'results' => $mapList($data['songs']['data'] ?? [], function ($song) {
					return [
						'id' => $song['id'] ?? null,
						'title' => $song['title'] ?? null,
						'image' => LinkHelper::createImageLinks($song['image'] ?? null),
						'album' => $song['more_info']['album'] ?? null,
						'url' => $song['perma_url'] ?? null,
						'type' => $song['type'] ?? null,
						'description' => $song['description'] ?? null,
						'primaryArtists' => $song['more_info']['primary_artists'] ?? null,
						'singers' => $song['more_info']['singers'] ?? null,
						'language' => $song['more_info']['language'] ?? null,
					];
				}),
				'position' => $data['songs']['position'] ?? null,
			],
			'albums' => [
				'results' => $mapList($data['albums']['data'] ?? [], function ($album) {
					return [
						'id' => $album['id'] ?? null,
						'title' => $album['title'] ?? null,
						'image' => LinkHelper::createImageLinks($album['image'] ?? null),
						'artist' => $album['more_info']['music'] ?? null,
						'url' => $album['perma_url'] ?? null,
						'type' => $album['type'] ?? null,
						'description' => $album['description'] ?? null,
						'year' => $album['more_info']['year'] ?? null,
						'songIds' => $album['more_info']['song_pids'] ?? null,
						'language' => $album['more_info']['language'] ?? null,
					];
				}),
				'position' => $data['albums']['position'] ?? null,
			],
			'artists' => [
				'results' => $mapList($data['artists']['data'] ?? [], function ($artist) {
					return [
						'id' => $artist['id'] ?? null,
						'title' => $artist['title'] ?? null,
						'image' => LinkHelper::createImageLinks($artist['image'] ?? null),
						'url' => $artist['perma_url'] ?? null,
						'type' => $artist['type'] ?? null,
						'description' => $artist['description'] ?? null,
						'language' => $artist['more_info']['language'] ?? null,
					];
				}),
				'position' => $data['artists']['position'] ?? null,
			],
			'playlists' => [
				'results' => $mapList($data['playlists']['data'] ?? [], function ($pl) {
					return [
						'id' => $pl['id'] ?? null,
						'title' => $pl['title'] ?? null,
						'image' => LinkHelper::createImageLinks($pl['image'] ?? null),
						'url' => $pl['perma_url'] ?? null,
						'type' => $pl['type'] ?? null,
						'description' => $pl['description'] ?? null,
						'language' => $pl['more_info']['language'] ?? null,
					];
				}),
				'position' => $data['playlists']['position'] ?? null,
			],
		];
	}
}
