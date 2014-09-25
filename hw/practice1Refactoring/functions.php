<?php
// functions.php
 
function buildArrayUsersFromFile()
{
    $db = fopen('db.txt', 'r');
 
    $users = array();
    while($str = fgets($db))
    {
        $arr = explode(';', $str);
 
        $userName = trim($arr[0]);
        $value = trim($arr[1]);
 
        if (!isset($users[$userName])) {
            $users[$userName] = array('total' => $value);
            $users[$userName]['nValues'] = 1;
        } else {
            $users[$userName]['total'] += (int) $value;
            ++$users[$userName]['nValues'];
        }
    }
 
    fclose($db);
 
    return $users;
}
 
 
/**
 * $sortBy valid values:
 *  1 - sort by average
 *  2 - sort by total score
 */
function sortUsers(&$users, $sortBy=1)
{
    $key = ($sortBy == 1) ? 'averageValue' : 'total';
 
    foreach($users as &$userData) {
        $sortAux[] = $userData[$key];
    }
 
    array_multisort($sortAux, SORT_DESC, $users);
 
    return true;
}
 
 
function setAverageValues(&$users)
{
    foreach($users as &$userData) {
        $userData['averageValue'] = $userData['total'] / $userData['nValues'];
    }
 
    return true;
}
 
 
function buildUserTableHtml($users)
{
    $str = '<table cellspacing="10"><tr><td>Name</td><td>Total</td><td>Average value</td></tr>';
 
    foreach($users as $userName => $userData) {
        $str .= '<tr><td>' . $userName . '</td>' .
                '<td>' . $userData['total'] . '</td>' .
                '<td>' . $userData['averageValue'] . '</td></tr>';
    }
 
    $str .= '</table>';
 
    return $str;
}
 
 
function buildFormSortHtml()
{
    $str = 'Sort By:';
    $str .= '<form action="index.php" method=GET>' .
            '<input type="checkbox" onClick="this.form.submit()" name="sort" value="1" />Average score<br>' .
            '<input type="checkbox" onClick="this.form.submit()" name="sort" value="2" />Total score' .
            '</form>';
 
    return $str;
}