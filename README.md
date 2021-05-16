# MediaProbe

MediaProbe leverages `ffprobe` and `ffmpeg` to extract info from media files.

## System requirements

* PHP 8.0
* `ffmpeg` binaries installed

In order for this to work, the `ffprobe` and `ffmpeg` binaries need to be in your path, or aliased. 

On macOS, you may need to run: `brew install ffmpeg`. On Linux, your package manager should contain `ffmpeg`. On Ubuntu, for example, you should run `apt install ffmpeg`.

## Usage

My primary intended usage here is to extract information from MP3 files, but since `ffprobe` is used much more is possible.

Here's some example usage:

### Retrieve metadata

This only works if the file can be processed by `ffprobe`, but this parser supports *many* formats.

```php
use NicoVerbruggen\MediaProbe\MediaProbe;

$path = "./path/to/my/file.mp3";
$probe = new MediaProbe($path);

$tags = $probe->getMediaInfo()->format->tags;

return [
    'artist' => $tags->artist,
    'album' => $tags->album,
    'title' => $tags->title,
];
```

### Extract cover

This only works if there's a cover present.

```php
use NicoVerbruggen\MediaProbe\MediaProbe;

$path = "./path/to/my/file.mp3";
$probe = new MediaProbe($path);

$destination = "./path/to/cover.jpg";
$probe->extractCover($destination);
```