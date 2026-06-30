<?php

$matches = [];
$content = file_get_contents(_FILE_PATH_ . $PAGE->file);
$headerRegex = '/^---([\s\S]*?)---/';
preg_match($headerRegex, $content, $matches);
if(count($matches)>0){
    $content = str_replace($matches[0], '', $content);
    $YAML = new Spyc();
    $yamlAR = $YAML->load($matches[0]);
    #var_dump($yamlAR);
    if(isset($yamlAR['title'])){
        $PAGE->title = $yamlAR['title'];
    }
    if(isset($yamlAR['description'])){
        $PAGE->description = $yamlAR['description'];
    }
    if(isset($yamlAR['meta'])&& is_array($yamlAR['meta'])){
        $PAGE->setDocMetaData($yamlAR['meta']);
    }
    if(isset($yamlAR['author'])){
        $PAGE->author = $yamlAR['author'];
    }
}
#var_dump($matches);
$Parsedown = new Parsedown();
echo $Parsedown->text($content);