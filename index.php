<?php
require_once 'classes/Attack.php';
require_once 'classes/Types/Fire.php';
require_once 'classes/Types/Water.php';
require_once 'classes/Battle.php';

// Create attacks
$flamethrower = new Attack(10, 15, 2, 30);
$hydroPump = new Attack(12, 18, 1.8, 25);

// Create Pokémon
$charizard = new Fire('Charizard', 'images/FirePokemon.jpeg', 100, $flamethrower);
$blastoise = new Water('Blastoise', 'images/WaterPokemon.jpeg', 120, $hydroPump);

// Start battle
$battle = new Battle($charizard, $blastoise);
$result = $battle->fight();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pokémon Battle</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        .round { background-color: #e6f7ff; font-weight: bold; }
        .special { background-color: #fff2cc; }
        .winner { font-weight: bold; color: green; margin-top: 20px; }
        .pokemon-info { display: flex; margin-bottom: 20px; }
        .pokemon-info div { margin-right: 20px; text-align: center; }
        .pokemon-info img { width: 100px; height: 100px; }
    </style>
</head>
<body>
    <h1>Pokémon Battle</h1>
    
    <div class="pokemon-info">
        <div>
            <img src="<?= $charizard->getImage() ?>" alt="<?= $charizard->getName() ?>">
            <p><?= $charizard->getName() ?> (<?= $charizard->getType() ?>)</p>
            <p>HP: <?= $charizard->getCurrentHp() ?>/<?= $charizard->getMaxHp() ?></p>
        </div>
        <div>
            <img src="<?= $blastoise->getImage() ?>" alt="<?= $blastoise->getName() ?>">
            <p><?= $blastoise->getName() ?> (<?= $blastoise->getType() ?>)</p>
            <p>HP: <?= $blastoise->getCurrentHp() ?>/<?= $blastoise->getMaxHp() ?></p>
        </div>
    </div>
    
    <h2>Battle Log</h2>
    <table>
        <tr>
            <th>Round</th>
            <th>Action</th>
            <th>Damage</th>
            <th>Remaining HP</th>
        </tr>
        <?php foreach ($result['log'] as $entry): ?>
            <?php if ($entry['type'] == 'round'): ?>
                <tr class="round">
                    <td><?= $entry['number'] ?></td>
                    <td colspan="3">Round <?= $entry['number'] ?> begins</td>
                </tr>
            <?php else: ?>
                <?php $attack = $entry['data']; ?>
                <tr class="<?= $attack['is_special'] ? 'special' : '' ?>">
                    <td></td>
                    <td><?= $attack['attacker'] ?> attacks <?= $attack['target'] ?></td>
                    <td><?= $attack['damage'] ?></td>
                    <td><?= $attack['target_hp'] ?></td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </table>
    
    <div class="winner">
        <?= $result['winner']->getName() ?> wins the battle!
    </div>
</body>
</html>