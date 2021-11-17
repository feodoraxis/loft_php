<?php
require 'config.php';

//1
echo "Меня зовут " . $name . "\n\n";
echo "Мне " . $age . " лет\n\n";
echo "\"!|/'\"\\\n\n";

//2
echo (ALL_PICTURES - PENCIL_PICTURES - FELT_PEN_PICTURES) . " рисунков выполнено красками. \n\n";

//3
if ($age >= 18 && $age <=65) {
    echo "Вам ещё работать и работать \n\n";
} elseif ($age > 65) {
    echo "Вам пора на пенсию";
} elseif ($age >= 1 && $age <= 17) {
    echo "Вам ещё рано работать \n\n";
} else {
    echo "Неизвестный возраст \n\n";
}

//4
switch ($day) {
    case 1:
    case 2:
    case 3:
    case 4:
    case 5:
        echo "Это рабочий день \n\n";
        break;
    case 6:
    case 7:
        echo "Это выходной день \n\n";
        break;

    default:
        echo "Неизвестный день \n\n";
        break;
}

//5
$cars = [
    'bmw' => $bmw,
    'toyota' => $toyota,
    'opel' => $opel,
];

foreach ($cars as $key => $car) {
    echo 'CAR ' . $key . "\n";
    echo $key . ' ' . $car['model'] . ' ' . $car['speed'] . ' ' . $car['doors'] . ' ' . $car['year'] . "\n";
}
echo "\n";

//6
echo '<table>';
for ($i = 0; $i <= 10; $i++) {
    echo '<tr>';
    for ($j = 0; $j <= 10; $j++) {
        if ($i == 0 && $j == 0) {
            echo '<td></td>';
        } elseif ($i == 0 && $j > 0) {
            echo '<td>' . $j . '</td>';
        } elseif ( $i > 0 && $j == 0) {
            echo '<td>' . $i . '</td>';
        } else {
            echo '<td>';
            echo ($i * $j) % 2 ? '[' . $i * $j . ']':'(' . $i * $j . ')';
            echo '</td>';
        }
    }
    echo '</tr>';
}
echo '</table>';