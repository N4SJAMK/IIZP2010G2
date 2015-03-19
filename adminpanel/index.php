<?php

// simple test for rest api



echo '<h3>All users:</h3>';
echo file_get_contents('http://localhost:8001/api/users');



echo '<h3>All boards:</h3>';
echo file_get_contents('http://localhost:8001/api/boards');



echo '<h3>All tickets:</h3>';
echo file_get_contents('http://localhost:8001/api/tickets');




