<?php
/**
 * Takes care of document properties
 *
 * @author lordmatt
 */
class page {
    protected $data = [];
    public $useMD = false;
    protected $cachetime = 1; #43200; // 12 hours
    public $mediator;
    public $debug = false;
    protected $debug_log = [];


    public function __construct(string $file='home.php',bool $useMD=false) {
        $this->data['file']=$file;
        $this->useMD = $useMD;
        $this->data['title']='This Page Has No Name';
        $this->data['template']='first.php';
        $this->data['description'] = 'A document from Matt\'s Web Way - a disorderly collection of online documents.';
        $this->mediator = new mediator();
    }
    
    public function makepage(){
        global $PAGE;
        if(!($PAGE instanceof page)){
            $PAGE = new page();
        }
        require_once _THEME_PATH_.trim($this->data['template']);
        if($this->debug){
            echo "<!--";
            print_r($this->debug_log);
            echo "-->";
        }
    }
    
    public function setDocMetaData(array $meta):page{
        $this->data['meta']=$meta;
        return $this;
    }
    
    public function getDocMetaData(): mixed{
        if(isset($this->data['meta']) && is_array($this->data['meta'])){
            return $this->data['meta'];
        }
        return false;
    }
    
    public function getFlags(): array {
        $meta = $this->getDocMetaData();
        $noflags = [];
        if($meta === false){
            return $noflags;
        }
        if(!isset($meta['flags'])){
            return $noflags;            
        }
        return $meta['flags'];
    }
    
    public function debug_msg($title,$data){
        $this->debug_log[] = [$title,$data];
    }
    
    public function setCache($seconds=false){
        $seconds_to_cache = $seconds;
        if(false===$seconds){
            $seconds_to_cache = 60*60*12;
        }
        $this->cachetime = $seconds_to_cache;
    }
    
    public function send_cache_header(){
        $seconds_to_cache = $this->cachetime;
        $ts = gmdate("D, d M Y H:i:s", time() + $seconds_to_cache) . " GMT";
        header("Expires: $ts");
        header("Pragma: cache");
        header("Cache-Control: max-age=$seconds_to_cache");
    }

    
    public function useMD(){
        $this->useMD = true;
    }    
    public function usePHP(){
        $this->useMD = false;
    }
    
    public function setUseMD(bool $use=true){
        $this->useMD = $use;
    }
    
    public function __set(string $name, mixed $value): void {
        $this->data[$name]=$value;
    }
    
    public function __get(string $name): mixed {
        return $this->data[$name];
    }
    
    public function __isset(string $name): bool {
        return isset($this->data[$name]);
    }
    
    public function __unset(string $name): void {
        unset($this->data[$name]);
    }
    
    public function title($value){
        $this->data['title']=$value;
        return $this;
    }
    
    public function description($value){
        $this->data['description']=$value;
        return $this;
    }
    
    public static function link($file){
        $file = str_replace('.php', '', $file);
        $file = str_replace('.html', '', $file);
        $file = str_replace(_FILE_PATH_, '', $file);
        $link = '/'.$file;
        $link = str_replace('//', '/', $link);
        $link = _URL_PATH_.$file;
        echo $link;
    }
    
}
