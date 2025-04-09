<?php
require_once 'classes/Pokemon.php';

class GrassPokemon extends Pokemon {
    public function __construct(string $name, string $imageUrl, int $hp, Attack $attack) {
        parent::__construct($name, $imageUrl, $hp, $attack, 'Plante');
    }
    
    protected function calculateEffectiveDamage(float $damage, Pokemon $target): float {
        switch ($target->getType()) {
            case 'Eau':
                return $damage * 2;  // Super efficace contre Eau
            case 'Feu':
            case 'Plante':
                return $damage * 0.5;  // Peu efficace contre Feu/Plante
            default:
                return $damage;  // Normal contre autres types
        }
    }
}