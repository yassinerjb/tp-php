<?php
require_once 'classes/Pokemon.php';

class Water extends Pokemon {
    public function __construct($name, $image, $hp, Attack $attack) {
        parent::__construct($name, $image, $hp, $attack);
        $this->type = 'Water';
    }
    
    protected function calculateDamage($damage, Pokemon $target) {
        switch ($target->getType()) {
            case 'Fire': return $damage * 2;
            case 'Water':
            case 'Grass': return $damage * 0.5;
            default: return $damage;
        }
    }
}