<?php
namespace modules\meme\models;

use core\classTables\MemeBase;
use core\classTables\TextAreas;
use core\classTables\Memes;
use core\classTables\Colors;
use core\Registry;
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
    private $fontColor = 'white';
    private $strokeColor = 'black';
    private $strokeWidth = 1;
    private $draw;
    private $fontPixel;
    private $strokePixel;
    private $memeBaseId;
    private $memeAlias;
    private $memeName;
    private $fileName;

    public function getMemeId()
    {
        $id = new Memes();
        $id = $id->selectPrepare();
        $id = $id->selectColumns(['id'])->where(['path = ' => str_replace(DIR_PUBLIC, '', $this->fileName)])->fetch();
        return $id['id'];
    }

    //Get images info from DB
    public function getBasePictures()
    {
        $pics = new MemeBase();
        $selected = $pics->selectPrepare();
        $queryResult = $selected->selectColumns(array('meme_base.id as id', 'base_picture',
            'COUNT(text_areas.id) as fields'))->join('LEFT', 'text_areas', 'id', 'meme_id')
            ->group('base_picture')->fetchAll();
        $this->pictures = $this->getPicturesOuput($queryResult);
        $this->inputs = $this->getInputsOutput($queryResult);
    }

    //Get images HTML output
    private function getPicturesOuput($pics)
    {
        $output = '';
        for ($i = 0; $i < count($pics); $i++) {
            $pic = str_replace('/orig/', '/thumb/', $pics[$i]['base_picture']);
            preg_match('/(?<=\/)\w+(?=\.)/', $pic, $matches);
            $match = $matches[0];
            $output .= "<img src='" . BASE_URL . $pic . "' class='thumb' data-inputs='" . $pics[$i]['fields'] .
                "' data-id='" . $pics[$i]['id'] . "'alt='" . $match . "'>";
        }
        return $output;
    }

    //Get inputs HTML output
    private function getInputsOutput($pics)
    {
        $output = '';
        $inputsCount = $this->getMaxInputs($pics);
        for ($i = 1; $i <= $inputsCount; $i++) {
            $output .= "<input type='text' id='" . $i . "' value='" . $i . "' class='initial'>";
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

    //Generating meme
    public function createMeme($name, $id, $text)
    {
        $textAreas = new TextAreas();
        $selected = $textAreas->selectPrepare();
        $coords = $selected->selectColumns(array('base_picture', 'alias', 'start_x', 'start_y', 'end_x', 'end_y', 'color'))
            ->join('LEFT', 'meme_base', 'meme_id', 'id')->where(array('meme_base.id = ' => $id))->fetchAll();

        $colors = new Colors();
        $selected = $colors->selectPrepare();
        $colors = $selected->selectColumns(['text', 'stroke'])->where(['id = '=>$coords[0]['color']])->fetchAll();

        for ($i = 0; $i < count($text); $i++) {
            $areas[$i] = array($text[$i], $coords[$i]['start_x'], $coords[$i]['start_y'],
                $coords[$i]['end_x'], $coords[$i]['end_y'],);
        }

        $this->fontColor = $colors[0]['text'];
        $this->strokeColor = $colors[0]['stroke'];


        $this->memeBaseId = $id;
        $this->memeAlias = $coords[0]['alias'];
        $this->memeName = $name;


        $this->font = DIR_PUBLIC . 'fonts/russo.ttf';

        $this->img = new imagick(DIR_PUBLIC . $coords[0]['base_picture']);
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

        $this->saveMeme();

    }

    private function saveMeme()
    {
        $dir = DIR_PUBLIC . 'images/memes/user_memes/' . Registry::getValue('user') . '/';

        $this->fileName = $dir . $this->memeAlias . '_' . time() . '.jpg';

        if (file_exists($dir)) {
            file_put_contents($this->fileName, $this->img);
        } else {
            mkdir($dir);
            file_put_contents($this->fileName, $this->img);
        }

        $memes = new Memes();
        $memes->insert(['name' => $this->memeName, 'path' => str_replace(DIR_PUBLIC, '', $this->fileName),
            'meme_base_id' => $this->memeBaseId, 'user_id' => Registry::getValue('user'),
            'date_create' => date('Y-m-d-h-m-s', time()), 'date_update' => date('Y-m-d-h-m-s', time()),
            'likes' => 0, 'dislikes' => 0]);

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

    public function getMemePath($id)
    {
        $meme = new Memes();
        $meme = $meme->selectPrepare();
        $meme = $meme->selectColumns(['path'])->where(['id = ' => $id])->fetch();

        return str_replace(DIR, '', $meme['path']);

    }

    public function getImage($id)
    {
        $img = new MemeBase();
        $img = $img->selectPrepare();
        $img = $img->selectColumns(array('base_picture', 'width', 'height', 'start_x', 'start_y', 'end_x', 'end_y'))
            ->join('LEFT', 'text_areas', 'id', 'meme_id')->where(array('meme_base.id = ' => $id))->fetchAll();
        return $img;
    }
}