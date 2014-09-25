<?php
 
function can($user, $permission)
{
    $query = "SELECT permissions.name as permission_name " .
              "FROM users " .
              "INNER JOIN user_role ON users.id = user_role.user_fk " .
              "INNER JOIN roles ON roles.id = user_role.role_fk " .
              "INNER JOIN role_permission ON roles.id = role_permission.role_fk " .
              "INNER JOIN permissions ON permissions.id = role_permission.permission_fk " .
              "WHERE users.name = '%s'";
    $flushedQuery = sprintf($query, mysql_real_escape_string($user));
    $result = mysql_query($flushedQuery);
 
    if (!$result) {
        return false;
    }
 
    while($row = mysql_fetch_assoc($result)) {
        if ($row['permission_name'] === $permission) {
            return true;
        }
    }
 
    return false;
}
 
 
$connection = mysql_connect('localhost', 'root', 'wsad');
$db = mysql_select_db('my_db', $connection);
 
$user = 'John';
$permission = 'write-posts';
 
if (can($user, $permission)) {
    echo 'User ' . $user  . ' has permission ' . $permission;
} else {
    echo 'User ' . $user . ' hasn’t permission ' . $permission;
}