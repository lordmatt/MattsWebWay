<?php
/**
 * Allows a class to use abstract data
 *
 * @author lordmatt
 */
abstract class abs_data {
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
}
