<?php
/**
 * Mediates callbacks and negotiations
 *
 * @author lordmatt
 */
class mediator {
    private $register = [];
    
    public function register($event,$callable){
        $this->register[$event][] = $callable;
    }
    
    public function event($what){
        if(!isset($this->register[$what])){
            return;
        }
        foreach($this->register[$what] as $action){
            if(is_callable($action));
            call_user_func($action);
        }
    }
    
    public function filter($what,&$data){
        if(!isset($this->register[$what])){
            return;
        }
        foreach($this->register[$what] as $action){
            if(is_callable($action));
            call_user_func_array($action,[&$data]);
        }
    } 
}