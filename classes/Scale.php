<?php


class Scale extends Resize
{
    public function __construct($filename)
    {
        parent::__construct($filename);
    }

    public function scale($scale)
    {
        $width = $this->getWidth() * $scale / 100;
        $height = $this->getHeight() * $scale / 100;
        $this->resize($width, $height);
    }
}