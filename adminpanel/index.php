<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');


date_default_timezone_set('Europe/Helsinki');
header('Content-Type: text/html;charset=utf-8');
mb_internal_encoding('UTF-8');



// simple test for rest api

$userArray = array();
$boardArray = array();


$users = json_decode(file_get_contents('http://localhost:8001/api/users'));
echo '<h3>Users, boards and tickets</h3>';
echo '<ul>';
foreach ($users as $user) {
    
    $userArray[] = array('_id' => $user->_id, 'email' => $user->email);
    
    echo '
        <li>
            <form method="post" action="api/users/'.$user->_id.'">
                <input type="hidden" name="REQUEST_METHOD" value="delete">
                <input type="submit" value="Poista">
                <span>'.$user->email.'</span>
            </form>
            <ul>
        ';
        if (isset($user->boards)) {
            foreach ($user->boards as $board) {
                $boardArray[] = array('_id' => $board->_id, 'name' => (empty($board->name) ? '{null}' : $board->name));
                echo '
                    <li>
                        <form method="post" action="api/boards/'.$board->_id.'">
                            <input type="hidden" name="REQUEST_METHOD" value="delete">
                            <input type="submit" value="Poista">
                            <span>'.(empty($board->name) ? '{null}' : $board->name).'</span>
                        </form>
                        <ul>
                    ';
                        if (isset($user->tickets)) {
                            foreach ($board->tickets as $ticket) {
                                echo '
                                    <li>
                                    <form method="post" action="api/tickets/'.$ticket->_id.'">
                                        <input type="hidden" name="REQUEST_METHOD" value="delete">
                                        <input type="submit" value="Poista">
                                        <span>'.(empty($ticket->content) ? '{null}' : $ticket->content).'</span>
                                    </form>
                                    </li>
                                    ';
                            }
                        }
                echo '
                        </ul>
                    </li>
                    ';
            }
        }
    echo '
            </ul>
        </li>
        ';
}
echo '</ul>';



echo '
<h3>Add user</h3>
    <form method="post" action="api/users">
        <input type="hidden" name="REQUEST_METHOD" value="post">
        Email: <input type="email" name="email" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" value="Save">
    </form>
';


echo '
<h3>Add board to user</h3>
    <form method="post" action="api/boards">
        <input type="hidden" name="REQUEST_METHOD" value="post">
        User: 
            <select name="createdBy">';
foreach ($userArray as $user) {
echo '
                <option value="'.$user['_id'].'">'.$user['email'].'</option>';
    
}
echo'
            </select><br>
        Name: <input type="text" name="name" required><br>
        <input type="submit" value="Save">
    </form>
';


echo '
<h3>Add ticket to board</h3>
    <form method="post" action="api/tickets">
        <input type="hidden" name="REQUEST_METHOD" value="post">
        Board: 
            <select name="board">';
foreach ($boardArray as $board) {
echo '
                <option value="'.$board['_id'].'">'.$board['name'].'</option>';
    
}
echo'
            </select><br>
        Content: <input type="text" name="content" required><br>
        <input type="submit" value="Save">
    </form>
';
        

