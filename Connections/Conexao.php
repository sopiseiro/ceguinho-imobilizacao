<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_Conexao = "localhost";
$database_Conexao = "curso";
$username_Conexao = "root";
$password_Conexao = "896323";
$Conexao = mysql_pconnect($hostname_Conexao, $username_Conexao, $password_Conexao) or trigger_error(mysql_error(),E_USER_ERROR); 
?>