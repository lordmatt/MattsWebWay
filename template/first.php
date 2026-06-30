<?php
/**
 * This is the template for content
 */
ob_start();
if($PAGE->useMD){
    require_once(_THEME_PATH_.'md.php');
}else{
    require _FILE_PATH_ . $PAGE->file;
}
$content = ob_get_contents();
$PAGE->mediator->filter('post_content_filter',$content);
ob_end_clean();


# Cache stuff
$PAGE->send_cache_header();

$default_excluder_path = str_replace('https:', '', _URL_PATH_);
$default_excluder_path = str_replace('https', '', $default_excluder_path);


?><!DOCTYPE html>
<html>
    <head>
        <link rel="icon" type="image/x-icon" href="<?php echo _URL_PATH_; ?>webway.jpg">
        <title><?php echo $PAGE->title; ?></title>
        <meta name="description" content="<?php echo $PAGE->description; ?>">
        <meta property="og:title" content="<?php echo $PAGE->title; ?>" />
        <meta property="og:description" content="<?php echo $PAGE->description; ?>" />
        <?php require_once(_THEME_PATH_.'documentauthorhead.php'); ?> 
        <?php require_once(_THEME_PATH_.'keywords.php'); ?> 
        <meta name="twitter:creator" content="@lordmatt">
        <meta name="twitter:title" content="<?php echo $PAGE->title; ?>" />
        <meta name="twitter:description" content="<?php echo $PAGE->description; ?>" />
        <meta name="robots" content="index,follow" />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body {
                margin:40px auto;
                max-width: 650px;
                font-size:18px;
                line-height: 1.6;
                color:#444;
                padding: 1px 10px;
                font-family: Garamond, serif;
            }

            h1,h2,h3,h4,h5,h6 {
                line-height:1.2;
            }
            h2,h3,h4,h5,h6 {
                margin-bottom:-4px;
                padding-top:8px;
            }
            .bigger, .bigger a{
                text-decoration: none;
                font-size:42px;
            }
            a[target=_blank]:after {
                content: ' ↗️';
            }
            a {
                color:#24995E;
                text-decoration: none;
                border-bottom: 1px dotted #24995E;
            }
            a[href]:not(:where(
              /* exclude hash only links */
              [href^="#"],
              /* exclude javascript only links */
              [href^="javascript:" i],  
              /* exclude relative but not double slash only links */
              [href^="/"]:not([href^="//"]),
              /* domains to exclude */
              /* [href*="//stackoverflow.com"], */
              /* subdomains to exclude */
              [href*="<?php echo $default_excluder_path; ?>"],
            )):after {
              content: ' ↗️';
            }
        </style>
        <!-- with thanks to https://stackoverflow.com/questions/5379752/css-style-external-links -->
        <?php 
        
        if(isset($PAGE->head)){
            echo $PAGE->head;
        }
        
        ?>
    </head>
    <body>
        <main>
            <h1><?php echo $PAGE->title; ?></h1>
            <h5 style='margin-top:-12px;'><?php echo $PAGE->description; ?></h5>
            <?php echo $content; ?>
            <?php require_once(_THEME_PATH_.'docmeta.php'); ?>
            
        </main>
        <footer>
            <div class="bigger">
                <a href="<?php echo _URL_PATH_; ?>">↩️</a>
                <?php 
                        
                $actual_link = $_SERVER['REQUEST_URI'];
                $actual_link = str_replace(_URL_PATH_,'',$actual_link); 
                $actual_link = str_replace('///','/',$actual_link);
                $noqs = explode('?', $actual_link);               
                $actual_link = (string)$noqs[0];
                
                $bits = explode('/',$actual_link);
                foreach($bits as $n=>$b){
                    if(''==trim($b)){
                        unset($bits[$n]);
                    }
                }
                $bits = array_values($bits);
                $n = count($bits)-1;
                #print_r($bits);
                if(($n>=0) && trim($bits[$n])==''){
                    unset($bits[$n]);
                    $n--;
                }
                $n=count($bits)-1; // reset
                if($n>0 && trim($bits[$n])!='/'): 
                    $upone = str_replace($bits[$n],'',$actual_link);
                    $upone = str_replace('//','/',_URL_PATH_.$upone);
                    if(0==$n){
                        $upone='';
                    }
                    ?>
                    <a href="<?php
                    $upone = str_replace('https:/','https://',$upone);
                    echo $upone;
                    ?>">⬆️️</a>
                <?php endif; ?>
            </div>
        </footer>
    </body>
</html>