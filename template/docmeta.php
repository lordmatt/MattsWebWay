<?php
$meta = $PAGE->getDocMetaData();

if((false!==$meta) && (is_array($meta)) ){
    ?>
        <hr />
        <h3 class="metadata"><span class="DocName"><strong><?php echo $PAGE->title; ?></strong></span>: Document meta</h3>
        <?php asList($meta); ?>
    <?php
}