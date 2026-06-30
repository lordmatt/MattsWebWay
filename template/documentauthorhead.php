<?php
if(isset($PAGE->meta['author'])){
    ?><meta name="author" content="<?php echo $PAGE->meta['author']; ?>"><?php
}elseif(isset($PAGE->author)){
    ?><meta name="author" content="<?php echo $PAGE->author; ?>"><?php
}else{
    ?><meta name="author" content="<?php echo _DEFAULT_AUTHOR; ?>"><?php
}
?>