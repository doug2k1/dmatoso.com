<?php
require_once('bbcode.php');

if (isset($_POST['submit']))
{
	$code = $_POST['code'];
	$keywords_color = $_POST['keywords_color'];
	$comments_color = $_POST['comments_color'];
	$strings_color = $_POST['strings_color'];
	$digits_color = $_POST['digits_color'];
	
	if ($keywords_color != 'null')
	{
		$kw_start = "[$keywords_color]";
		$kw_end = "[/$keywords_color]";
	}
	else
	{
		$kw_start = '';
		$kw_end = '';
	}
	
	if ($comments_color != 'null')
	{
		$comm_start = "[$comments_color]";
		$comm_end = "[/$comments_color]";
	}
	else
	{
		$comm_start = '';
		$comm_end = '';
	}
	
	if ($strings_color != 'null')
	{
		$str_start = "[$strings_color]";
		$str_end = "[/$strings_color]";
	}
	else
	{
		$kw_start = '';
		$kw_end = '';
	}
	
	if ($digits_color != 'null')
	{
		$dig_start = "[$digits_color]";
		$dig_end = "[/$digits_color]";
	}
	else
	{
		$dig_start = '';
		$dig_end = '';
	}
	
	if (get_magic_quotes_gpc())
	{
		$code = stripslashes($code);
	}
	
	$new_code = Blitz2BB($code,
	"[code]", "[/code]",
	$kw_start, $kw_end,
	$comm_start, $comm_end,
	$str_start, $str_end,
	$dig_start, $dig_end);
	
	$html_code = Blitz2BB($code,
	"", "",
	"<span class=\"$keywords_color\">", "</span>",
	"<span class=\"$comments_color\">", "</span>",
	"<span class=\"$strings_color\">", "</span>",
	"<span class=\"$digits_color\">", "</span>");
	$html_code = nl2br($html_code);
	$html_code = str_replace("  ", "&nbsp;", $html_code);
	$html_code = str_replace("\t", "&nbsp;&nbsp;&nbsp;&nbsp;", $html_code);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BlitzBasic -&gt; BBCode</title>
<link href="default.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="main">
<h1>BlitzBasic -&gt; BBCode</h1>
<p>Esta ferramenta vai adicionar tags de cores no formato BBCode em códigos-fonte de BlitzBasic (Blitz3D).<br />
Atualmente reconhece todas as palavras-chave do Blitz3D 1.97. </p>
<p>Desenvolvido por <strong>Douglas "Eric Draven" Matoso</strong>.</p>
<h3>Conversor</h3>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<div id="form">
<h4>Cores</h4>
<div>
<label>Palavras-Chaves</label><select name="keywords_color">
	<option value="null">Normal</option>
	<option value="blue" selected="selected" class="blue">Azul</option>
	<option value="red" class="red">Vermelho</option>
	<option value="green" class="green">Verde</option>
	<option value="purple" class="purple">Roxo</option>
	<option value="brown" class="brown">Marrom</option>
	<option value="orange" class="orange">Laranja</option>
	<option value="yellow" class="yellow">Amarelo</option>
</select>
</div>
<div>
<label>Comentários</label><select name="comments_color">
	<option value="null">Normal</option>
	<option value="blue" class="blue">Azul</option>
	<option value="red" class="red">Vermelho</option>
	<option value="green" selected="selected" class="green">Verde</option>
	<option value="purple" class="purple">Roxo</option>
	<option value="brown" class="brown">Marrom</option>
	<option value="orange" class="orange">Laranja</option>
	<option value="yellow" class="yellow">Amarelo</option>
</select>
</div>
<div>
<label>Strings</label><select name="strings_color">
	<option value="null">Normal</option>
	<option value="blue" class="blue">Azul</option>
	<option value="red" selected="selected" class="red">Vermelho</option>
	<option value="green" class="green">Verde</option>
	<option value="purple" class="purple">Roxo</option>
	<option value="brown" class="brown">Marrom</option>
	<option value="orange" class="orange">Laranja</option>
	<option value="yellow" class="yellow">Amarelo</option>
</select>
</div>
<div>
<label>Números</label><select name="digits_color">
	<option value="null">Normal</option>
	<option value="blue" class="blue">Azul</option>
	<option value="red" class="red">Vermelho</option>
	<option value="green" class="green">Verde</option>
	<option value="purple" selected="selected" class="purple">Roxo</option>
	<option value="brown" class="brown">Marrom</option>
	<option value="orange" class="orange">Laranja</option>
	<option value="yellow" class="yellow">Amarelo</option>
</select>
</div>
<h4>Código</h4>
<h6>Cole seu código abaixo:</h6>
<div>
<textarea name="code" cols="60" rows="10" wrap="off">
<?php
if (isset($code))
	echo $code;
?>
</textarea>
</div>
<div class="submit">
<input type="submit" name="submit" value="&gt;&gt; Converter &gt;&gt;" />
</div>
<?php
if (isset($_POST['submit']))
{
?>
<h3>Resultado</h3>
<h6>Este é o código resultante. Copie e cole no seu post!</h6>
<div>
<textarea name="new_code" cols="60" rows="10" wrap="off"><?php echo $new_code; ?></textarea>
</div>
<h4>Visualização</h4>
<h6>Seu código vai aparecer assim no fórum:</h6>
<div id="code">
<?php echo $html_code; ?>
</div>
<?php
}
?>
</div>
</form>
</div>
</body>
</html>
