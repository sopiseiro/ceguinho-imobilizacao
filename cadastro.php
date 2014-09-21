<?php require_once('Connections/Conexao.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO usuario (nome, data_nascimento, rg, cpf, endereco, bairro, cidade, uf, cep, telefone, celular, email, senha) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['nome'], "text"),
                       GetSQLValueString($_POST['data_nascimento'], "date"),
                       GetSQLValueString($_POST['rg'], "text"),
                       GetSQLValueString($_POST['cpf'], "text"),
                       GetSQLValueString($_POST['endereco'], "text"),
                       GetSQLValueString($_POST['bairro'], "text"),
                       GetSQLValueString($_POST['cidade'], "text"),
                       GetSQLValueString($_POST['uf'], "text"),
                       GetSQLValueString($_POST['cep'], "text"),
                       GetSQLValueString($_POST['telefone'], "text"),
                       GetSQLValueString($_POST['celular'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['senha'], "int"));

  mysql_select_db($database_Conexao, $Conexao);
  $Result1 = mysql_query($insertSQL, $Conexao) or die(mysql_error());

  $insertGoTo = "cadastro.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js"></script>
<script type="text/javascript">

$(document).ready( function() {
	$("#form1").validate({
		// Define as regras
		rules:{
			nome:{
				required: true, minlength: 5
			},
			rg:{
				required: true
			},
			cpf:{
				required: true
			},
			endereco:{
				required: true
			},
			email:{
				required: true, email: true
			},
			data_nascimento:{
				required: true
			},
			senha:{
				required: true, rangelength: [6,12]
			},
			senha2:{
				required: true, equalTo:"#senha"
			}
			
			
		},
		messages:{
			nome:{
				required: "Digite o seu nome",
				minlength: "O seu nome deve conter, no mínimo, 5 caracteres"
			},
			email:{
				required: "Digite o seu e-mail para contato",
				email: "Digite um e-mail válido"
			},
			data_nascimento:{
				required: "Digite sua data de nascimento",
			},
			senha:{
				required: "Digite uma senha com no minimo de 6 e máximo 12", 
				rangelength: "Minimo de 6 digitos"
			},
			senha2:{
				required: "Repita a senha", 
				equalTo:"Deve ser a mesma da senha acima"
			}
		}
	});
});


</script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cadastro Pessoal</title>
</head>

<body>
<hr />
<h1>Cadastro de Usuários </h1>
<hr />
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nome:</td>
      <td><input type="text" name="nome" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Data Nascimento:</td>
      <td><input type="text" name="data_nascimento" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">RG:</td>
      <td><input type="text" name="rg" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">CPF:</td>
      <td><input type="text" name="cpf" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Endereço:</td>
      <td><input type="text" name="endereco" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Bairro:</td>
      <td><input type="text" name="bairro" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Cidade:</td>
      <td><input type="text" name="cidade" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">UF:</td>
      <td><input type="text" name="uf" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Cep:</td>
      <td><input type="text" name="cep" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Telefone:</td>
      <td><input type="text" name="telefone" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Celular:</td>
      <td><input type="text" name="celular" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Email:</td>
      <td><input type="text" name="email" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Senha:</td>
      <td><input type="text" name="senha" id="senha" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Confirme a senha::</td>
      <td><input type="text" name="senha2" id="senha2" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><input type="checkbox" name="contrato" /> </td>
      <td>Aceito os termos e condições do site.</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Cadastrar" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
</body>
</html>