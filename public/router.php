<?php
header('Content-Type: application/json');

require_once './classes/ORM.php';
require_once './classes/User.php';
require_once './classes/Room.php';
require_once './classes/Message.php';
session_start();

if (!isset($_SESSION['orm']) || $_SESSION['orm'] == null) {
    $_SESSION['orm'] = new ORM();
    $_SESSION['idusermanager'] = 0;
    $_SESSION['idroommanager'] = 0;
    $_SESSION['idmessagemanager'] = 0;
}
$orm = $_SESSION['orm'];
$usercounter = $_SESSION['idusermanager'];
$roomcounter = $_SESSION['idroommanager'];
$messagecounter = $_SESSION['idmessagemanager'];

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$response = ['success' => false, 'data' => null];

$param = strstr($uri, "?");
$param = substr($param, 1);

switch ($uri) {
    case '/':
        $response['success'] = true;
        $response['data'] = 'Welcome to the API';
        break;
    case '/users':
        if ($method == 'GET') {
            $response['data'] = $orm->getUsers();
            $response['success'] = true;
        }
        break;
    case '/rooms':
        if ($method == 'GET') {
            $response['data'] = $orm->getRooms();
            $response['success'] = true;
        }
        break;
    case '/messages?' . $param:
        if ($method == 'GET') {
            if (isset($_GET['room_id'])) {
                $room_id = $_GET['room_id'];
                $response['data'] = $orm->getMessagesByRoomId($room_id);
                $response['success'] = true;
            } else {
                $response['data'] = "Missing room_id parameter";
                $response['success'] = false;
            }
        }
        break;
    case '/createuser':
        if ($method == 'POST') {
            $username = $_POST['username'];
            $user = new User($username, $usercounter);
            $response['data'] = $orm->addUser($user);
            $response['success'] = true;
            $_SESSION['idusermanager'] = $usercounter + 1;
        }
        break;
    case '/createroom':
        if ($method == 'POST') {
            $room_name = $_POST['room_name'];
            $room = new Room($room_name, $roomcounter);
            $response['data'] = $orm->addRoom($room);
            $response['success'] = true;
            $_SESSION['idroommanager'] = $roomcounter + 1;
        }
        break;
    case '/post-message':
        if ($method == 'POST') {
            $user_id = $_POST['user_id'];
            $room_id = $_POST['room_id'];
            $content = $_POST['content'];

            $message = new Message($user_id, $room_id, $content, $messagecounter);
            $response['data'] = $orm->addMessage($message);
            $response['success'] = true;
            $_SESSION['idmessagemanager'] = $messagecounter + 1;
        }
        break;
    case '/disconnect':
        if ($method == 'GET') {
            session_destroy();
            $response['success'] = true;
            $response['data'] = 'Disconnected';
        }
        break;
    default:
        $response['success'] = false;
        $response['data'] = 'Invalid endpoint';
        break;
}

echo json_encode($response);