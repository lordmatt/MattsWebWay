<?php

class relme {
    
    public function __construct(){
        Global $PAGE;
        if(!isset($PAGE) || !is_object($PAGE)){
            return;
        }
        $PAGE->mediator->register('post_content_filter',[$this,'relme_filter_on_flag']);
        $PAGE->debug_msg('relme','start');
    }
    
    public function relme_filter_on_flag(&$content){
        Global $PAGE;
        if(!isset($PAGE) || !is_object($PAGE)){
            return; // init error detected
        }
        $PAGE->debug_msg('relme','filter');
        $flags = $PAGE->getFlags();
        if(count($flags)<1){
            $PAGE->debug_msg('relme','noflags');
            return;
        }
        foreach($flags as $flag){
            if($flag=='relMeList'){
                $content = str_replace('<li><a ','<li><a rel="me" ',$content);
                $PAGE->debug_msg('relme','filtered');
            }
        }
        
    }
    
    
}