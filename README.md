# Unofficial JioSaavn API (PHP)

<div align="center">
  <h1>Unofficial JioSaavn API (PHP)</h1>
  <p><em>A powerful, unofficial API wrapper for JioSaavn built with PHP</em></p>
  
  <img src="https://img.shields.io/badge/PHP-7.4%2B-blue.svg" alt="PHP Version">
  <img src="https://img.shields.io/badge/License-MIT-green.svg" alt="License">
  <img src="https://img.shields.io/github/stars/yourusername/jiosaavn-api-php?style=social" alt="GitHub Stars">
  <img src="https://img.shields.io/github/issues/yourusername/jiosaavn-api-php" alt="GitHub Issues">
</div>

---

## About

<div style="background-color: #f8f9fa; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
  <p>This project is an <strong>unofficial API wrapper</strong> for JioSaavn, a popular music streaming service in India. Built with PHP, this API allows developers to interact with JioSaavn's platform programmatically to search for songs, albums, artists, and playlists.</p>
  
  <p><strong>Important:</strong> This project is created for <strong>educational purposes only</strong> and is not affiliated with, endorsed by, or connected to JioSaavn in any way. Users are responsible for complying with JioSaavn's terms of service and applicable laws when using this API.</p>
</div>

---

## Features

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin: 20px 0;">
  <div style="background-color: #f1f3f5; padding: 15px; border-radius: 8px; text-align: center; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
    <div style="font-size: 24px; margin-bottom: 10px;">🔍</div>
    <h3>Search</h3>
    <p>Search for songs, albums, artists, and playlists</p>
  </div>
  
  <div style="background-color: #f1f3f5; padding: 15px; border-radius: 8px; text-align: center; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
    <div style="font-size: 24px; margin-bottom: 10px;">🎵</div>
    <h3>Songs</h3>
    <p>Get detailed information about songs</p>
  </div>
  
  <div style="background-color: #f1f3f5; padding: 15px; border-radius: 8px; text-align: center; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
    <div style="font-size: 24px; margin-bottom: 10px;">💿</div>
    <h3>Albums</h3>
    <p>Fetch album details and track listings</p>
  </div>
  
  <div style="background-color: #f1f3f5; padding: 15px; border-radius: 8px; text-align: center; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
    <div style="font-size: 24px; margin-bottom: 10px;">🎤</div>
    <h3>Artists</h3>
    <p>Retrieve artist information and discography</p>
  </div>
  
  <div style="background-color: #f1f3f5; padding: 15px; border-radius: 8px; text-align: center; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
    <div style="font-size: 24px; margin-bottom: 10px;">📋</div>
    <h3>Playlists</h3>
    <p>Access curated playlists and their contents</p>
  </div>
</div>

---

## Installation

<div style="background-color: #f8f9fa; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
  <p>To get started with the Unofficial JioSaavn API (PHP), follow these steps:</p>
  
  <h4>1. Clone the repository</h4>
  <pre style="background-color: #282c34; color: #abb2bf; padding: 15px; border-radius: 5px; overflow-x: auto;"><code>git clone https://github.com/yourusername/jiosaavn-api-php.git
cd jiosaavn-api-php</code></pre>
  
  <h4>2. Start the PHP server</h4>
  <pre style="background-color: #282c34; color: #abb2bf; padding: 15px; border-radius: 5px; overflow-x: auto;"><code>php -S localhost:8000</code></pre>
  
  <p>Now you can access the API at <code>http://localhost:8000</code></p>
</div>

---

## Endpoints

<div style="background-color: #f8f9fa; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
  <table style="width: 100%; border-collapse: collapse;">
    <thead>
      <tr style="background-color: #e9ecef;">
        <th style="padding: 12px; text-align: left; border-bottom: 1px solid #dee2e6;">Endpoint</th>
        <th style="padding: 12px; text-align: left; border-bottom: 1px solid #dee2e6;">Method</th>
        <th style="padding: 12px; text-align: left; border-bottom: 1px solid #dee2e6;">Description</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="padding: 12px; border-bottom: 1px solid #dee2e6;"><code>/api/search?query={query}</code></td>
        <td style="padding: 12px; border-bottom: 1px solid #dee2e6;">GET</td>
        <td style="padding: 12px; border-bottom: 1px solid #dee2e6;">Search for songs, albums, artists, and playlists</td>
      </tr>
      <tr>
        <td style="padding: 12px; border-bottom: 1px solid #dee2e6;"><code>/api/song?id={id}</code></td>
        <td style="padding: 12px; border-bottom: 1px solid #dee2e6;">GET</td>
        <td style="padding: 12px; border-bottom: 1px solid #dee2e6;">Get song details by ID</td>
      </tr>
      <tr>
        <td style="padding: 12px; border-bottom: 1px solid #dee2e6;"><code>/api/album?id={id}</code></td>
        <td style="padding: 12px; border-bottom: 1px solid #dee2e6;">GET</td>
        <td style="padding: 12px; border-bottom: 1px solid #dee2e6;">Get album details by ID</td>
      </tr>
      <tr>
        <td style="padding: 12px; border-bottom: 1px solid #dee2e6;"><code>/api/artist?id={id}</code></td>
        <td style="padding: 12px; border-bottom: 1px solid #dee2e6;">GET</td>
        <td style="padding: 12px; border-bottom: 1px solid #dee2e6;">Get artist details by ID</td>
      </tr>
      <tr>
        <td style="padding: 12px; border-bottom: 1px solid #dee2e6;"><code>/api/playlist?id={id}</code></td>
        <td style="padding: 12px; border-bottom: 1px solid #dee2e6;">GET</td>
        <td style="padding: 12px; border-bottom: 1px solid #dee2e6;">Get playlist details by ID</td>
      </tr>
      <tr>
        <td style="padding: 12px; border-bottom: 1px solid #dee2e6;"><code>/api/lyrics?id={id}</code></td>
        <td style="padding: 12px; border-bottom: 1px solid #dee2e6;">GET</td>
        <td style="padding: 12px; border-bottom: 1px solid #dee2e6;">Get song lyrics by ID</td>
      </tr>
    </tbody>
  </table>
</div>

---

## Example JSON Response

<div style="background-color: #f8f9fa; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
  <p>Here's an example response from the <code>/api/song</code> endpoint:</p>
  
  <pre style="background-color: #282c34; color: #abb2bf; padding: 15px; border-radius: 5px; overflow-x: auto;"><code>{
  "status": "success",
  "data": {
    "id": "IqLQwhsT",
    "title": "Senorita",
    "album": "Senorita",
    "year": "2019",
    "release_date": "2019-07-05",
    "duration": 191,
    "label": "Sony Music",
    "primary_artists": "Shawn Mendes, Camila Cabello",
    "featured_artists": "",
    "artists": [
      {
        "id": "259295",
        "name": "Shawn Mendes",
        "url": "https://www.jiosaavn.com/artist/shawn-mendes-albums/UqI7b-7B,",
        "image": "https://c.saavncdn.com/artists/Shawn_Mendes.jpg"
      },
      {
        "id": "255095",
        "name": "Camila Cabello",
        "url": "https://www.jiosaavn.com/artist/camila-cabello-albums/4xZq1-7B,",
        "image": "https://c.saavncdn.com/artists/Camila_Cabello.jpg"
      }
    ],
    "image": "https://c.saavncdn.com/967/Senorita-English-2019-20190705024013-500x500.jpg",
    "url": "https://aac.saavncdn.com/967/967f5e8e3a5d2a5d5c3d5c3d5c3d5c3d.mp4",
    "encrypted_media_url": "https://aac.saavncdn.com/967/967f5e8e3a5d2a5d5c3d5c3d5c3d5c3d.mp4",
    "play_count": "123456789",
    "language": "english"
  }
}</code></pre>
</div>

---

## Documentation

<details style="background-color: #f8f9fa; padding: 15px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 20px;">
  <summary style="font-weight: bold; cursor: pointer;">API Documentation</summary>
  <div style="margin-top: 15px;">
    <h4>Search Endpoint</h4>
    <p>The search endpoint allows you to search for songs, albums, artists, and playlists.</p>
    
    <h5>Request</h5>
    <pre style="background-color: #282c34; color: #abb2bf; padding: 15px; border-radius: 5px; overflow-x: auto;"><code>GET /api/search?query={query}</code></pre>
    
    <h5>Parameters</h5>
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 15px;">
      <thead>
        <tr style="background-color: #e9ecef;">
          <th style="padding: 8px; text-align: left; border-bottom: 1px solid #dee2e6;">Parameter</th>
          <th style="padding: 8px; text-align: left; border-bottom: 1px solid #dee2e6;">Type</th>
          <th style="padding: 8px; text-align: left; border-bottom: 1px solid #dee2e6;">Required</th>
          <th style="padding: 8px; text-align: left; border-bottom: 1px solid #dee2e6;">Description</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">query</td>
          <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">string</td>
          <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">Yes</td>
          <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">The search query</td>
        </tr>
        <tr>
          <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">limit</td>
          <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">integer</td>
          <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">No</td>
          <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">Number of results to return (default: 10, max: 50)</td>
        </tr>
        <tr>
          <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">page</td>
          <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">integer</td>
          <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">No</td>
          <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">Page number for pagination (default: 1)</td>
        </tr>
      </tbody>
    </table>
    
    <h4>Song Details Endpoint</h4>
    <p>Get detailed information about a specific song.</p>
    
    <h5>Request</h5>
    <pre style="background-color: #282c34; color: #abb2bf; padding: 15px; border-radius: 5px; overflow-x: auto;"><code>GET /api/song?id={id}</code></pre>
    
    <h5>Parameters</h5>
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 15px;">
      <thead>
        <tr style="background-color: #e9ecef;">
          <th style="padding: 8px; text-align: left; border-bottom: 1px solid #dee2e6;">Parameter</th>
          <th style="padding: 8px; text-align: left; border-bottom: 1px solid #dee2e6;">Type</th>
          <th style="padding: 8px; text-align: left; border-bottom: 1px solid #dee2e6;">Required</th>
          <th style="padding: 8px; text-align: left; border-bottom: 1px solid #dee2e6;">Description</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">id</td>
          <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">string</td>
          <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">Yes</td>
          <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">The song ID</td>
        </tr>
      </tbody>
    </table>
    
    <h4>Album Details Endpoint</h4>
    <p>Get detailed information about a specific album, including its track listing.</p>
    
    <h5>Request</h5>
    <pre style="background-color: #282c34; color: #abb2bf; padding: 15px; border-radius: 5px; overflow-x: auto;"><code>GET /api/album?id={id}</code></pre>
    
    <h5>Parameters</h5>
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 15px;">
      <thead>
        <tr style="background-color: #e9ecef;">
          <th style="padding: 8px; text-align: left; border-bottom: 1px solid #dee2e6;">Parameter</th>
          <th style="padding: 8px; text-align: left; border-bottom: 1px solid #dee2e6;">Type</th>
          <th style="padding: 8px; text-align: left; border-bottom: 1px solid #dee2e6;">Required</th>
          <th style="padding: 8px; text-align: left; border-bottom: 1px solid #dee2e6;">Description</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">id</td>
          <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">string</td>
          <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">Yes</td>
          <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">The album ID</td>
        </tr>
      </tbody>
    </table>
    
    <h4>Artist Details Endpoint</h4>
    <p>Get detailed information about a specific artist, including their top songs and albums.</p>
    
    <h5>Request</h5>
    <pre style="background-color: #282c34; color: #abb2bf; padding: 15px; border-radius: 5px; overflow-x: auto;"><code>GET /api/artist?id={id}</code></pre>
    
    <h5>Parameters</h5>
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 15px;">
      <thead>
        <tr style="background-color: #e9ecef;">
          <th style="padding: 8px; text-align: left; border-bottom: 1px solid #dee2e6;">Parameter</th>
          <th style="padding: 8px; text-align: left; border-bottom: 1px solid #dee2e6;">Type</th>
          <th style="padding: 8px; text-align: left; border-bottom: 1px solid #dee2e6;">Required</th>
          <th style="padding: 8px; text-align: left; border-bottom: 1px solid #dee2e6;">Description</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">id</td>
          <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">string</td>
          <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">Yes</td>
          <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">The artist ID</td>
        </tr>
        <tr>
          <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">page</td>
          <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">integer</td>
          <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">No</td>
          <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">Page number for pagination (default: 1)</td>
        </tr>
        <tr>
          <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">cat</td>
          <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">string</td>
          <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">No</td>
          <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">Category to fetch (song, album, or playlist)</td>
        </tr>
      </tbody>
    </table>
    
    <h4>Playlist Details Endpoint</h4>
    <p>Get detailed information about a specific playlist, including its track listing.</p>
    
    <h5>Request</h5>
    <pre style="background-color: #282c34; color: #abb2bf; padding: 15px; border-radius: 5px; overflow-x: auto;"><code>GET /api/playlist?id={id}</code></pre>
    
    <h5>Parameters</h5>
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 15px;">
      <thead>
        <tr style="background-color: #e9ecef;">
          <th style="padding: 8px; text-align: left; border-bottom: 1px solid #dee2e6;">Parameter</th>
          <th style="padding: 8px; text-align: left; border-bottom: 1px solid #dee2e6;">Type</th>
          <th style="padding: 8px; text-align: left; border-bottom: 1px solid #dee2e6;">Required</th>
          <th style="padding: 8px; text-align: left; border-bottom: 1px solid #dee2e6;">Description</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">id</td>
          <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">string</td>
          <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">Yes</td>
          <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">The playlist ID</td>
        </tr>
      </tbody>
    </table>
    
    <h4>Lyrics Endpoint</h4>
    <p>Get lyrics for a specific song.</p>
    
    <h5>Request</h5>
    <pre style="background-color: #282c34; color: #abb2bf; padding: 15px; border-radius: 5px; overflow-x: auto;"><code>GET /api/lyrics?id={id}</code></pre>
    
    <h5>Parameters</h5>
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 15px;">
      <thead>
        <tr style="background-color: #e9ecef;">
          <th style="padding: 8px; text-align: left; border-bottom: 1px solid #dee2e6;">Parameter</th>
          <th style="padding: 8px; text-align: left; border-bottom: 1px solid #dee2e6;">Type</th>
          <th style="padding: 8px; text-align: left; border-bottom: 1px solid #dee2e6;">Required</th>
          <th style="padding: 8px; text-align: left; border-bottom: 1px solid #dee2e6;">Description</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">id</td>
          <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">string</td>
          <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">Yes</td>
          <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">The song ID</td>
        </tr>
      </tbody>
    </table>
  </div>
</details>

---

## Disclaimer

<div style="background-color: #fff3cd; border-left: 4px solid #ffc107; padding: 15px; border-radius: 4px; margin: 20px 0;">
  <p><strong>⚠️ Important Disclaimer</strong></p>
  <p>This project is an <strong>unofficial API wrapper</strong> and is not affiliated with, endorsed by, or connected to JioSaavn in any way. This project is created for <strong>educational purposes only</strong>.</p>
  
  <p>By using this API, you agree to the following:</p>
  <ul>
    <li>You will use this API responsibly and in compliance with JioSaavn's terms of service.</li>
    <li>You will not use this API for commercial purposes without proper authorization.</li>
    <li>You will not use this API to distribute copyrighted material without permission.</li>
    <li>The developers of this API are not responsible for any misuse or illegal activities conducted with this tool.</li>
  </ul>
  
  <p>This API may stop working at any time if JioSaavn changes their internal API structure.</p>
</div>

---

## License and Credits

<div style="background-color: #f8f9fa; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
  <h4>License</h4>
  <p>This project is licensed under the MIT License. See the <a href="LICENSE">LICENSE</a> file for details.</p>
  
  <h4>Credits</h4>
  <p>This project was inspired by the need for an easy-to-use PHP wrapper for JioSaavn's services. Special thanks to all contributors who have helped improve this project.</p>
  
  <h4>Contributing</h4>
  <p>Contributions are welcome! Please feel free to submit a pull request or open an issue if you find any bugs or have suggestions for improvements.</p>
</div>
