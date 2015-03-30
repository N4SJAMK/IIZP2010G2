<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('max_execution_time', 0);
ini_set('memory_limit', '1024M');

// USE EXAMPLE
// testdata.php?users=50&boards=15&tickets=32

// default password for every user is testdata1234


// settings
$userCount          = filter_input(INPUT_GET, 'users', FILTER_VALIDATE_INT);
$maxBoardsPerUser   = filter_input(INPUT_GET, 'boards', FILTER_VALIDATE_INT);
$maxTicketsPerBoard = filter_input(INPUT_GET, 'tickets', FILTER_VALIDATE_INT, array('options' => array('min_range' => 0)));

$userCount          = !is_int($userCount)          ? 50 : $userCount;
$maxBoardsPerUser   = !is_int($maxBoardsPerUser)   ? 15 : $maxBoardsPerUser;
$maxTicketsPerBoard = !is_int($maxTicketsPerBoard) ? 32 : $maxTicketsPerBoard;
$maxTicketsPerBoard = ($maxTicketsPerBoard > 64)   ? 64 : $maxTicketsPerBoard;
$maxTicketsPerBoard2 = $maxTicketsPerBoard;


$usersCreated = 0;
$boardsCreated = 0;
$ticketsCreated = 0;

// random data from arrays
$userToken = array (null, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjU1MTA0YjQ5MGQ4OTFlMjEwN2EwZDM0ZiIsInR5cGUiOiJ1c2VyIiwidXNlcm5hbWUiOiJlbWFpbF8xQHRlc3RkYXRhLmZpIiwiaWF0IjoxNDI3MTMxMjEwfQ.wXO2MvrZe6E9Uo65HbU7-MerULmTXi_TkUB9itO3S14');
$ticketColor = array ('#eb584a', '#4f819a', '#724a7f', '#dcc75b');



// open mongo and collections
$mongo = new MongoClient();
$db = $mongo->selectDB('teamboard-dev');
$userCollection = $db->selectCollection('users');
$boardCollection = $db->selectCollection('boards');
$ticketCollection = $db->selectCollection('tickets');

// clear collections
$userCollection->remove();
$boardCollection->remove();
$ticketCollection->remove();


$ticketBool = ($maxTicketsPerBoard < 32);

if (!$ticketBool) {
	$maxTicketsPerBoard = 64 - $maxTicketsPerBoard;
}

$users = array();
$boards = array();
$tickets = array();

// create users
for ($x = 1; $x <= $userCount; $x++) {
    
    $users[$x] = array (
        '_id'      => new MongoId(),
        'email'    => 'email_'.$x.'@testdata.fi',
        'password' => '$2a$10$.EcKBd5tkSm1bswXQ1KNMOGtk1L7OKaqAv0k9ALh4HjEsJe21m.4i',
        'token'    => $userToken[array_rand($userToken, 1)]
    );
    $usersCreated++;
    
    
    
    // create boards for user
    $boardCount = mt_rand(0, $maxBoardsPerUser);
    for ($y = 1; $y <= $boardCount; $y++) {
    
        $boards[$x.'-'.$y] = array (
            '_id'        => new MongoId(),
            'accessCode' => null,
            'background' => 'none',
            'createdBy'  => $users[$x]['_id'],
            'name'       => 'user_'.$x.'-board_'.$y,
            'size'       => array('height' => 8, 'width' => 8)
        );
        $boardsCreated++;
		
        
        // vector for ticket positions
        $freePositions = array();
        for ($pos_x = 0; $pos_x < 8; $pos_x++) {
            $freePositions[$pos_x] = array();
            for ($pos_y = 0; $pos_y < 8; $pos_y++) {
                $freePositions[$pos_x][$pos_y] = !$ticketBool;
            }
        }
		
        //create tickets for board
        for ($z = 1; $z <= $maxTicketsPerBoard; $z++) {
            
            $rand_x = array_rand($freePositions, 1);
            $rand_y = array_rand($freePositions[$rand_x], 1);
            
            // if position is free
            if ($freePositions[$rand_x][$rand_y] == $ticketBool) {
                $freePositions[$rand_x][$rand_y] = !$ticketBool;
            }
        }
		
        for ($pos_x = 0, $z = 0; $pos_x < 8; $pos_x++, $z++) {
            for ($pos_y = 0; $pos_y < 8; $pos_y++, $z++) {
				if ($freePositions[$pos_x][$pos_y]) {
					$tickets[] = array (
						'_id' => new MongoId(),
						'board' => $boards[$x.'-'.$y]['_id'],
						'position' => array('z' => 0, 'x' => $pos_x*192, 'y' => $pos_y*108),
						'color' => $ticketColor[array_rand($ticketColor, 1)],
						'content' => 'user_'.$x.'-board_'.$y.'-ticket_'.$z
					);
					$ticketsCreated++;
				}
            }
        }
		
		
    }
}

$userCollection->batchInsert($users);
$boardCollection->batchInsert($boards);
$ticketCollection->batchInsert($tickets);


echo '<strong>Settings</strong><br>';
echo 'Users: '.$userCount.'<br>';
echo 'Max boards per user: '.$maxBoardsPerUser.'<br>';
echo 'Max tickets per board: '.$maxTicketsPerBoard2.'<br><br>';

echo '<strong>Created</strong><br>';
echo 'Users: '.$usersCreated.'<br>';
echo 'Boards: '.$boardsCreated.'<br>';
echo 'Tickets: '.$ticketsCreated.'<br><br>';




