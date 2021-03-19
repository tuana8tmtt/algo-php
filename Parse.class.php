<?php
class Parse{
    public $dataMd;
    public function parse($Path)
    {
        $contents = file_get_contents($Path);
        $Parsedown = new Parsedown();
        $Parsedown->setMarkupEscaped(true);
        $this->dataMd = $Parsedown->text($contents);
    }


}
?>