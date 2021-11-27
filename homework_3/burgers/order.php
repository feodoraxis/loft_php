<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die();
}

try {
    $pdo = new PDO("mysql:host=localhost;dbname=burgers" , 'root' , 'root');
} catch (PDOException $err) {
    echo $err->getMessage();
    die();
}

$data = [
    'name' => $_POST['name'],
    'phone' => $_POST['phone'],
    'email' => $_POST['email'],
    'street' => $_POST['street'],
    'home' => intval($_POST['home']),
    'frame' => intval($_POST['part']),
    'apartment' => intval($_POST['appt']),
    'floor' => intval($_POST['floor']),
    'comment' => $_POST['comment'],
    'payment_method' => intval($_POST['payment']) == 1 ? 1 : 2,
    'no_recall' => $_POST['callback'] == 'on' ? 1 : 0,
];

$query = $pdo->prepare("SELECT `id` FROM `users` WHERE `email` = :users_email");
$query->execute([':users_email' => $data['email']]);
$result = $query->fetchAll(PDO::FETCH_ASSOC);

if (empty($result)) {

    $query = $pdo->prepare("INSERT INTO `users` (`name`, `email`, `phone`) VALUES ( :users_name, :user_email, :user_phone )");
    $query->execute([
        ':users_name' => $data['name'],
        ':user_email' => $data['email'],
        ':user_phone' => $data['phone']
    ]);
    $user_id = $pdo->lastInsertId();

} else {
    $user = reset($result);
    $user_id = $user['id'];
}

$sql = "INSERT INTO `orders` 
        (`user_id`, `street`, `home`, `frame`, `apartment`, `floor`, `comment`, `payment_method`, `no_recall`)
        VALUES ( :users_id, :street, :home, :frame, :apartment, :_floor, :comment, :payment_method, :no_recall )";
$query = $pdo->prepare($sql);
$query->execute([
   ':users_id' => $user_id,
   ':street' => $data['street'],
   ':home' => $data['home'],
   ':frame' => $data['frame'],
   ':apartment' => $data['apartment'],
   ':_floor' => $data['floor'],
   ':comment' => $data['comment'],
   ':payment_method' => $data['payment_method'],
   ':no_recall' => $data['no_recall'],
]);
$order_id = $pdo->lastInsertId();

$query = $pdo->prepare("SELECT count(*) as len FROM `orders` WHERE `user_id` = :users_id");
$query->execute([':users_id' => $user_id]);
$length_orders = reset($query->fetchAll(PDO::FETCH_ASSOC));

echo "Спасибо, ваш заказ будет доставлен по адресу: ул. " . $data['street'] . ", д." . $data['home'] . " корп." . $data['frame'] . " кв." . $data['apartment'] . " этаж." . $data['floor'] . '<br />';
echo 'Номер вашего заказа: #' . $order_id . '<br />';
echo "Это ваш " . $length_orders['len'] . '-й заказ!';