# JioSaavn PHP API

A PHP implementation that mirrors the endpoints of the TypeScript JioSaavn API in this repo.

## Requirements
- PHP >= 8.0
- Composer
- Web server (Apache with .htaccess or PHP built-in server)

## Install
```
cd php-api
composer install
```

## Run (built-in server)
```
php -S 0.0.0.0:8080 -t public
```

## Endpoints (prefix: /api)
- GET `/api/search?query=believer`
- GET `/api/search/songs?query=believer&page=0&limit=10`
- GET `/api/search/albums?query=blurryface&page=0&limit=10`
- GET `/api/search/artists?query=adele&page=0&limit=10`
- GET `/api/search/playlists?query=chill&page=0&limit=10`
- GET `/api/songs?ids=3IoDK8qI,4IoDK8qI`
- GET `/api/songs?link=https://www.jiosaavn.com/song/houdini/OgwhbhtDRwM`
- GET `/api/songs/{id}`
- GET `/api/albums?id=12345`
- GET `/api/albums?link=https://www.jiosaavn.com/album/foo/ITIyo-GDr7A_`
- GET `/api/artists?id=123&page=0&songCount=10&albumCount=10&sortBy=popularity&sortOrder=asc`
- GET `/api/artists?link=https://www.jiosaavn.com/artist/bar/xyz&page=0&songCount=10&albumCount=10&sortBy=popularity&sortOrder=asc`
- GET `/api/artists/songs?id=123&page=0&size=10&sortBy=popularity&sortOrder=asc`
- GET `/api/artists/albums?id=123&page=0&size=10&sortBy=popularity&sortOrder=asc`
- GET `/api/playlists?id=82914609&page=0&limit=10`
- GET `/api/playlists?link=https://www.jiosaavn.com/featured/its-indie-english/AMoxtXyKHoU_&page=0&limit=10`

Responses are JSON and closely follow the TS API output from JioSaavn upstream.
