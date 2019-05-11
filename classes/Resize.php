<?php


class Resize
{

    public $image;
    public $image_type;

    public function __construct($filename)
    {
        if (!empty($filename)) {
            $this->load($filename);
        }
    }

    public function load($filename)
    {
        $image_info = getimagesize($filename);
        $this->image_type = $image_info[2];
        if ($this->image_type == IMAGETYPE_JPEG) {
            $this->image = imagecreatefromjpeg($filename);
        } elseif ($this->image_type == IMAGETYPE_GIF) {
            $this->image = imagecreatefromgif($filename);
        } elseif ($this->image_type == IMAGETYPE_PNG) {
            $this->image = imagecreatefrompng($filename);
        } else {
            throw new Exception("Не тот формат изображения (допустимые JPEG, PNG, GIF)");
        }
    }

    public function save($filename, $image_type = IMAGETYPE_JPEG, $compression = 75)
    {

        if ($image_type == IMAGETYPE_JPEG) {
            imagejpeg($this->image, $filename, $compression);
            imagedestroy($this->image);
        } elseif ($image_type == IMAGETYPE_GIF) {
            imagegif($this->image, $filename);
            imagedestroy($this->image);
        } elseif ($image_type == IMAGETYPE_PNG) {
            imagepng($this->image, $filename, $image_type);
            imagedestroy($this->image);
        }
    }

    public function getWidth()
    {
        return imagesx($this->image);
    }

    public function getHeight()
    {
        return imagesy($this->image);
    }


    public function resize($width, $height)
    {
        $new_image = imagecreatetruecolor($width, $height);

        imagecolortransparent($new_image, imagecolorallocate($new_image, 0, 0, 0));
        imagealphablending($new_image, false);
        imagesavealpha($new_image, true);

        imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
        $this->image = $new_image;

    }

}