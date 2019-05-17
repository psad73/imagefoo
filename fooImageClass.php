<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of fiClass
 *
 * @author Paweł Sadowski <pawel.sadowski@qbe-art.com>
 */
class FooImage
{

    protected $width = 100;
    protected $height = 100;
    protected $type = 99;
    private $im;

    public function __construct($width = false, $height = false, $type = false)
    {
        $this->width = $width ? $width : $this->width;
        $this->height = $height ? $height : $this->height;
        $this->type = $type ? $type : $this->type;

        $this->im = imagecreatetruecolor($width, $height);


        switch ($type) {
            case 1:
                $this->imageTypeRectange($this->im);
                break;
            case 99:
            default:
                $this->imageTypeRandom($this->im);
        }
    }

    public function display()
    {
        header('Content-Type: image/jpeg');
        imagejpeg($this->im, NULL, 92);
    }

    /**
     *
     * @param type $im
     * @return type
     */
    public function imageTypeRectange(&$im)
    {
        $red = imagecolorallocate($im, 255, 0, 0);
        $dGray = imagecolorallocate($im, 33, 33, 33);
        $lGray = imagecolorallocate($im, 156, 156, 156);
        imagefill($im, 1, 1, $dGray);
        for ($i = 0; $i < 5; $i++) {
            imageline($im, $i, $i, $this->width - $i, $i, $lGray);
            imageline($im, $this->width - $i, $i, $this->width - $i, $this->height - $i, $lGray);
            imageline($im, $i, $i, $i, $this->height - $i, $lGray);
            imageline($im, $i, $this->height - $i, $this->width - $i, $this->height - $i, $lGray);
        }
        imageline($im, 0, 0, $this->width, $this->height, $lGray);
        imageline($im, $this->width, 0, 0, $this->height, $lGray);
        $this->writeDimensions($im, $this->width, $this->height);
        return $im;
    }
    /**
     *
     * @param type $im
     * @return type
     */
    public function imageTypeRandom(&$im)
    {
        $red = imagecolorallocate($im, 255, 0, 0);
        $dGray = imagecolorallocate($im, 33, 33, 33);
        $lGray = imagecolorallocate($im, 156, 156, 156);
        imagefill($im, 1, 1, $dGray);
        for ($i = 0; $i < 5; $i++) {
            imageline($im, $i, $i, $this->width - $i, $i, $lGray);
            imageline($im, $this->width - $i, $i, $this->width - $i, $this->height - $i, $lGray);
            imageline($im, $i, $i, $i, $this->height - $i, $lGray);
            imageline($im, $i, $this->height - $i, $this->width - $i, $this->height - $i, $lGray);
        }
        for ($i = 1; $i < 10; $i++) {

        }
        $this->writeDimensions($im, $this->width, $this->height);
        return $im;
    }

    public function writeDimensions(&$im, $width, $height)
    {
        $font_file = "fonts/sixty/SIXTY.TTF";
        $red = imagecolorallocate($im, 255, 0, 0);
        $fontSizeY = round($height / 10);
        $fontSizeX = round($width / 10);
        $fontSize = min($fontSizeX, $fontSizeY);
        $text = $width . ' x ' . $height;
        $angle = atan($height / $width) * 180 / pi();
        $bbox = imagettfbbox($fontSize, $angle, $font_file, $text);
        $x = $bbox[0] + (imagesx($im) / 2) - ($bbox[4] / 2);
        $y = $bbox[1] + (imagesy($im) / 2) - ($bbox[5] / 2) - 20;
        imagefttext($im, $fontSize, $angle, $x, $y, $red, $font_file, $text);
        return $im;
    }

}
