<?php
class Attack {
    private $minDamage;
    private $maxDamage;
    private $specialMultiplier;
    private $specialProbability;
    
    public function __construct($min, $max, $special, $prob) {
        $this->minDamage = $min;
        $this->maxDamage = $max;
        $this->specialMultiplier = $special;
        $this->specialProbability = $prob;
    }
    
    public function execute() {
        $isSpecial = rand(1, 100) <= $this->specialProbability;
        $damage = rand($this->minDamage, $this->maxDamage);
        $totalDamage = $isSpecial ? $damage * $this->specialMultiplier : $damage;
        
        return [
            'damage' => $totalDamage,
            'is_special' => $isSpecial
        ];
    }
}