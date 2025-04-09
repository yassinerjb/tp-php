<?php
class Battle {
    private $pokemon1;
    private $pokemon2;
    private $log = [];
    
    public function __construct(Pokemon $p1, Pokemon $p2) {
        $this->pokemon1 = $p1;
        $this->pokemon2 = $p2;
    }
    
    public function fight() {
        $round = 1;
        
        while (!$this->pokemon1->isFainted() && !$this->pokemon2->isFainted()) {
            $this->log[] = ['type' => 'round', 'number' => $round];
            
            // Pokemon 1 attacks
            $this->log[] = ['type' => 'attack', 'data' => $this->pokemon1->attack($this->pokemon2)];
            if ($this->pokemon2->isFainted()) break;
            
            // Pokemon 2 attacks
            $this->log[] = ['type' => 'attack', 'data' => $this->pokemon2->attack($this->pokemon1)];
            if ($this->pokemon1->isFainted()) break;
            
            $round++;
        }
        
        return [
            'log' => $this->log,
            'winner' => $this->pokemon1->isFainted() ? $this->pokemon2 : $this->pokemon1
        ];
    }
}