<?php
if(!isset($keywords)){
    $keywords = '';
}
if(isset($PAGE->keywords)){
    if(is_array($PAGE->keywords)){
        $keywords .= implode(', ', $PAGE->keywords);
    }else{
        $keywords .= $PAGE->keywords;
    }
}
if(isset($PAGE->meta['keywords'])){
    if(is_array($PAGE->meta['keywords'])){
        $keywords .= implode(', ', $PAGE->meta['keywords']);
    }else{
        $keywords .= $PAGE->meta['keywords'];
    }
}

if(''!=trim($keywords)){
    ?> <meta name="keywords" content="<?php echo(trim($keywords)); ?>"><?php
}
