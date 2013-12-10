<?php
namespace modules\meme\models;

use core\classTables\MemeBase;
use core\classTables\TextAreas;
use \Imagick;
use \ImagickPixel;
use \ImagickDraw;

class MemeModel
{
    public $pictures;
    public $inputs;

    private $img;
    private $textAreas;
    private $font;
    private $fontColor = '#FFF';
    private $strokeColor = '#000';
    private $strokeWidth = 1;
    private $draw;
    private $fontPixel;
    private $strokePixel;

    //Getting images info from DB
    public function getBasePictures()
    {
        $pics = new MemeBase();
        $selected = $pics->selectPrepare();
        $queryResult = $selected->selectColumns(array('base_picture',
            'COUNT(text_areas.id) as fields'))->join('LEFT','text_areas','id','meme_id')
            ->group('base_picture')->fetchAll();
        $this->pictures = $this->getPicturesOuput($queryResult);
        $this->inputs = $this->getInputsOutput($queryResult);
    }

    //Getting images HTML output
    private function getPicturesOuput($pics)
    {
        $output = '';
        for ($i = 0; $i < count($pics); $i++) {
            $pic = str_replace('/orig/', '/thumb/', $pics[$i]['base_picture']);
            preg_match('/(?<=\/)\w+(?=\.)/', $pic, $matches);
            $match = $matches[0];
            $output .= "<img src='" . $pic . "' class='thumb' inputs='" . $pics[$i]['fields'] .
                "' alt='" . $match . "'>";
        }
        return $output;
    }

    //Getting inputs HTML output
    private function getInputsOutput($pics)
    {
        $output = '';
        $inputsCount = $this->getMaxInputs($pics);
        for ($i = 1; $i <= $inputsCount; $i++) {
            $output .= "<input type='text' id='" . $i . "' value='".$i."' class='initial'>";
        }

        return $output;
    }

    //Max inputs for images
    private function getMaxInputs($pics)
    {
        $max = 0;
        for ($i = 0; $i < count($pics); $i++) {
            $max = max($max, $pics[$i]['fields']);
        }

        return $max;
    }

    public function createMeme($path, $text)
    {
        $textAreas = new TextAreas();
        $selected = $textAreas->selectPrepare();
        $coords = $selected->selectColumns(array('start_x', 'start_y', 'end_x', 'end_y', 'color'))
            ->join('LEFT','meme_base','meme_id', 'id')->where(array('base_picture = ' => "$path"))->fetchAll();
        for ($i = 0; $i < count($text); $i++)
        {
            $areas[$i] = array($text[$i], $coords[$i]['start_x'], $coords[$i]['start_y'],
                $coords[$i]['end_x'], $coords[$i]['end_y'],);
        }
        if ($coords[0]['color'] == 2) {
            $this->fontColor = '#000';
            $this->strokeColor = '#FFF';
        }
        $this->font = DIR_PUBLIC . 'fonts/russo.ttf';

        $this->img = new imagick(DIR.$path);
        $this->textAreas = $areas;
        $this->getDraw();
        $this->getMeme();
    }

    private function getDraw()
    {
        $this->strokePixel = new imagickPixel();
        $this->strokePixel->setColor($this->strokeColor);
        $this->fontPixel = new imagickPixel();
        $this->fontPixel->setColor($this->fontColor);
        $this->draw = new imagickDraw();
        $this->draw->setfont($this->font);
        $this->draw->setstrokecolor($this->strokePixel);
        $this->draw->setStrokeWidth($this->strokeWidth * 2);
        $this->draw->setStrokeAntialias(true);
        $this->draw->setTextAntialias(true);
        $this->draw->setGravity(Imagick::GRAVITY_NORTH);
    }

    private function getMeme()
    {
        if (!is_array($this->textAreas[0])) {
            $this->textAreas[0] = trim($this->textAreas[0]);
            $this->textAreas[0] = preg_replace('/ {2,}/', ' ', $this->textAreas[0]);
            $this->printText($this->textAreas);
        } else {
            for ($i = 0; $i < count($this->textAreas); $i++) {
                $this->textAreas[$i][0] = trim($this->textAreas[$i][0]);
                $this->textAreas[$i][0] = preg_replace('/ {2,}/', ' ', $this->textAreas[$i][0]);
                if ($this->textAreas[$i][0] != '') {
                    $this->printText($this->textAreas[$i]);
                }
            }
        }

        file_put_contents(DIR_PUBLIC.'images/memes/1/test.jpg', $this->img);

    }

    private function getYShift($textHeight, $area)
    {
        return $area[2] + ($area[4] - $area[2] - $textHeight) / 2;
    }

    private function printText($textArea)
    {
        $size = $textArea[4] - $textArea[2] - 3;
        $maxWidth = $textArea[3] - $textArea[1];
        $maxHeight = $textArea[4] - $textArea[2];
        $wrapCount = 2;
        $tmpStr = 'Х';
        $initialText = $textArea[0];
        while (1) {
            $this->draw->setfontsize($size);
            $metrics = $this->img->queryfontmetrics($this->draw, $textArea[0]);
            $tmpMetrics = $this->img->queryfontmetrics($this->draw, $tmpStr);
            if ($metrics['textWidth'] > $maxWidth) {
                if ($metrics['textHeight'] + $tmpMetrics['textHeight'] < $maxHeight) {
                    $wrapLenght = intval(strlen($initialText) * 1.2 / $wrapCount);
                    $textArea[0] = wordwrap($initialText, $wrapLenght, "\n", true);
                    $wrapCount++;
                } else {
                    $size--;
                }
            } else {
                $this->getStrokedText(($textArea[1] + $textArea[3]) / 2 - $this->img->getimagewidth() / 2,
                    $this->getYShift($metrics['textHeight'], $textArea), $textArea[0]);
                break;
            }
        }
    }

    private function getStrokedText($x, $y, $text)
    {
        $this->draw->setfillcolor($this->strokePixel);
        $this->draw->setstrokealpha(1);
        $this->img->annotateImage($this->draw, $x, $y, 0, $text);
        $this->draw->setfillcolor($this->fontPixel);
        $this->draw->setstrokealpha(0);
        $this->img->annotateImage($this->draw, $x, $y, 0, $text);
    }
}