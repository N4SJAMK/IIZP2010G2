<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');


date_default_timezone_set('Europe/Helsinki');
header('Content-Type: text/html;charset=utf-8');
mb_internal_encoding('UTF-8');



// simple test for rest api



$users = json_decode(file_get_contents('http://localhost:8001/api/users'));
echo '<h3>Users, boards and tickets</h3>';
echo '<ul>';
foreach ($users as $user) {
    echo '
        <li>
            <form method="post" action="api/users/'.$user->_id.'">
                <input type="hidden" name="REQUEST_METHOD" value="delete">
                <input type="submit" value="Poista">
                <span>'.$user->email.'</span>
            </form>
            <ul>
        ';
        foreach ($user->__boards as $board) {
            echo '
                <li>
                    <form method="post" action="api/boards/'.$board->_id.'">
                        <input type="hidden" name="REQUEST_METHOD" value="delete">
                        <input type="submit" value="Poista">
                        <span>'.(empty($board->name) ? '{null}' : $board->name).'</span>
                    </form>
                    <ul>
                ';
                    foreach ($board->__tickets as $ticket) {
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
            echo '
                    </ul>
                </li>
                ';
        }
    echo '
            </ul>
        </li>
        ';
}
echo '</ul>';


