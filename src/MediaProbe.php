<?php

namespace NicoVerbruggen\MediaProbe;

class MediaProbe
{
    public function __construct(private $filePath) {
        if (!file_exists($this->filePath)) {
            throw new \Exception("The file at the specified path does not exist.");
        }
    }

    /**
     * Returns all media information provided by ffprobe.
     * @return \stdClass
     */
    public function getMediaInfo(): \stdClass
    {
        $output = [];
        exec("ffprobe -v quiet -print_format json=compact=1 -show_format {$this->filePath}", $output);
        return json_decode(implode($output));
    }

    /**
     * Attempts to extract the cover from a media file.
     * Returns `true` if FFMPEG succeeded in extracting the image.
     * @param string $destinationPath
     * @return bool
     */
    public function extractCover(string $destinationPath): bool
    {
        exec("ffmpeg -v quiet -i {$this->filePath} -an -vcodec copy {$destinationPath} -y",
            $o,
            $code
        );
        return ($code == 1);
    }
}