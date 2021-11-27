<?php
function task1($strings = [], $to_return = false)
{
    if ($to_return === true) {
        return '<p>' . implode(', ', $strings) . '</p>';
    }

    echo '<p>' . implode('</p></p>', $strings) . '</p>';
}

function task2(string $action = '+', int|float ... $args) //int|float только в РНР 8
{
    $result = 0;
    $output = implode(' ' . $action . ' ', $args);

    if ($action == '*' || $action == '/') {
        $result = 1;
    }

    switch ($action) {
        case '+':
            foreach ($args as $item) {
                $result += $item;
            }
            break;
        case '*':
            foreach ($args as $item) {
                $result *= $item;
            }
            break;
        case '-':
            foreach ($args as $item) {
                $result -= $item;
            }
            break;
        case '/':
            foreach ($args as $item) {
                $result /= $item;
            }
            break;
        default:
            return 'Ошибка: указан неправильный оператор.';
    }

    return $output . ' = ' . $result;
}

function task3(int $arg1, int $arg2)
{
    if ($arg1 < 1 || $arg2 < 1) {
        return "Ошибка: оба числа должны быть больше нуля.";
    }

    $output = '<table>';
    for ($i = 0; $i <= $arg1; $i++) {
        $output .= '<tr>';
        for ($j = 0; $j <= $arg2; $j++) {
            if ($i == 0 && $j == 0) {
                $output .= '<td></td>';
            } elseif ($i == 0 && $j > 0) {
                $output .= '<td>' . $j . '</td>';
            } elseif ( $i > 0 && $j == 0) {
                $output .= '<td>' . $i . '</td>';
            } else {
                $output .= '<td>';
                $output .= ($i * $j) % 2 ? '[' . $i * $j . ']' : '(' . $i * $j . ')';
                $output .= '</td>';
            }
        }
        $output .= '</tr>';
    }
    $output .= '</table>';

    echo $output;
}

function task4()
{
    echo "Сегодня " . date("d.m.Y H:m") . "\n";
    echo "24.02.2016 00:00:00 в UNIX: " . strtotime("24.02.2016 00:00:00");
}

function task5()
{
    echo str_replace("К","","Карл у Клары украл Кораллы");
    echo str_replace("Две","Три","Две бутылки лимонада");
}

function task6_create_file(string $file_name)
{
    $fp = fopen($file_name, "w");
    fwrite($fp, "Hello again!");
    fclose($fp);
}

function task6_read_file(string $file_name)
{
    $fp = fopen($file_name, "r");
    $str = fread($fp, filesize($file_name));
    fclose($fp);

    return $str;
}