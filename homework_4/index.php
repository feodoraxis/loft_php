<?php
interface car_share
{
    public function mathPrice(); //Подсчёт стоимости услуги
    public function addSale(int $distance, int $time); //Добавление услуги
}

trait append_sales
{
    public function appendSale(int $sale_code, int $time = 0) //Время в минутах
    {
        switch($sale_code) {
            case 1:
                if ($time < 1) {
                    return "Ошибка: для этой услуги обязательно нужно указать время";
                }

                $this->sales_list['appends'][] = [
                    'sale_type' => 'gps',
                    'time' => $time,
                ];
                break;
            case 2:
                $this->sales_list['appends'][] = [
                    'sale_type' => 'driver'
                ];
                break;
        }
    }

    final protected function mathAppendSale() : array
    {
        if (!isset($this->sales_list['appends']) || empty($this->sales_list['appends'])) {
            return [];
        }

        $data = [];

        foreach ($this->sales_list['appends'] as $sale) {
            switch ($sale['sale_type']) {
                case 'gps':
                    $data[] = [
                        'sale_name' => 'GPS',
                        'total_price' => ceil($sale['time'] / 60) * 15,
                        'for_show' => ' 15 руб/час * ' . ceil($sale['time'] / 60) . ' час ',
                    ];
                    break;
                case 'driver' :
                    $data[] = [
                        'sale_name' => "Driver",
                        'total_price' => 100,
                        'for_show' => ' 100 руб ',
                    ];
                    break;
            }
        }

        return $data;
    }
}

abstract class tariffs implements car_share
{
    use append_sales;

    protected $price_distance;
    protected $price_time;

    protected $sales_list;
    protected $tariff_name;

    public function addSale(int $distance, int $time) //Время в минутах
    {
        $this->sales_list['defaults'][] = [
            'distance' => $distance,
            'time' => $time
        ];
    }

    public function mathPrice() : array
    {
        if (empty($this->sales_list)) {
            return ['result' => 'error', 'message' => 'Услуги не найдены'];
        }

        $data = ['result' => 'success', 'message' => 'Услуги найдены'];

        foreach($this->sales_list['defaults'] as $sale) {
            $data['sales'][] = [
                'sale_name' => 'default',
                'total_price' => $sale['distance'] * $this->price_distance + $sale['time'] * $this->price_time,
                'for_show' => $sale['distance'] . ' км * ' . $this->price_distance . ' руб/км + ' . $sale['time'] . ' мин * ' . $this->price_time . ' руб/мин ',
            ];
        }

        $data['sales'] = array_merge($data['sales'], $this->mathAppendSale());

        return $data;
    }

    final public function showPrice(bool $return = false)
    {
        $result = $this->mathPrice();
        $total = 0;

        if ($result['result'] == 'error') {
            if ($return === true) {
                return $result['message'];
            } else {
                echo $result['message'];
                exit;
            }
        }

        $output = "Тариф " . $this->tariff_name . '<br />';

        foreach ($result['sales'] as $sale) {
            if ($sale['sale_name'] !== 'default') {
                $output .= '- Доп. услуга ' . $sale['sale_name'] . '<br />';
            }
        }

        $output .= '<br>= ';
        foreach ($result['sales'] as $key => $sale) {
            $total += $sale['total_price'];

            $output .= $sale['for_show'];
            if ($result['sales'][ $key+1 ]) {
                $output .= ' + ';
            }
        }
        $output .= ' = ' . $total;

        if ($return === true) {
            return $output;
        }

        echo $output;
    }
}

class tariff_base extends tariffs
{
    protected $price_distance = 10;
    protected $price_time = 3;
    protected $tariff_name = "Базовый";
}

class tariff_student extends tariffs
{
    protected $price_distance = 4;
    protected $price_time = 1;
    protected $tariff_name = "Студенческий";
}

class tariff_hour extends tariffs
{
    protected $price_distance = 0;
    protected $price_time = 200; //За час
    protected $tariff_name = "Почасовой";

    public function mathPrice() : array
    {
        if (empty($this->sales_list)) {
            return ['result' => 'error', 'message' => 'Услуги не найдены'];
        }

        $data = ['result' => 'success', 'message' => 'Услуги найдены'];

        foreach($this->sales_list['defaults'] as $sale) {
            $time = ceil($sale['time'] / 60) ;
            $data['sales'][] = [
                'sale_name' => 'default',
                'total_price' => $time * $this->price_time,
                'for_show' => $sale['distance'] . ' км * 0 руб/км + ' . $sale['time'] . ' час * 200 руб/час ',
            ];
        }

        return array_merge($data['sales'], $this->mathAppendSale());
    }
}

$tariff = new tariff_base();
$tariff->addSale(3, 40);
$tariff->addSale(3, 40);
$tariff->addSale(3, 40);
$tariff->appendSale(1, 120);
$tariff->appendSale(2);
echo $tariff->showPrice(true);