<?php
class MarkDownFIle
{
    public $dataMd;
    public function __construct($Path)
    {
        $contents = file_get_contents($Path);
        $Parsedown = new Parsedown();
        $Parsedown->setMarkupEscaped(true);
        $this->dataMd = $Parsedown->text($contents);
    }
}
?>