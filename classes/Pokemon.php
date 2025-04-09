<?php
require_once 'Attack.php';

abstract class Pokemon {
    protected $name;
    protected $image;
    protected $maxHp;
    protected $currentHp;
    protected $attack;
    protected $type;
    
    public function __construct($name, $image, $hp, Attack $attack) {
        $this->name = $name;
        $this->image = $image;
        $this->maxHp = $hp;
        $this->currentHp = $hp;
        $this->attack = $attack;
    }
    
    public function attack(Pokemon $target) {
        $result = $this->attack->execute();
        $damage = $this->calculateDamage($result['damage'], $target);
        
        $target->takeDamage($damage);
        
        return [
            'attacker' => $this->name,
            'target' => $target->getName(),
            'damage' => $damage,
            'is_special' => $result['is_special'],
            'target_hp' => $target->getCurrentHp()
        ];
    }
    
    abstract protected function calculateDamage($damage, Pokemon $target);
    
    public function takeDamage($damage) {
        $this->currentHp = max(0, $this->currentHp - $damage);
    }
    
    public function isFainted() {
        return $this->currentHp <= 0;
    }
    
    // Getters
    public function getName() { return $this->name; }
    public function getImage() { return $this->image; }
    public function getCurrentHp() { return $this->currentHp; }
    public function getMaxHp() { return $this->maxHp; }
    public function getType() { return $this->type; }
}