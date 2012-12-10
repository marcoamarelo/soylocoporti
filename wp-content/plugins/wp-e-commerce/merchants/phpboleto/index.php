<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>Boleto - Ethymos</title>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
</head>
<body>
<form method="post" action="boleto_bb.php" name="boleto">
<div style="text-align: center;"></div>
<div style="text-align: center;">
<table
style="width: 100%; text-align: left; margin-left: auto; margin-right: auto;"
border="1" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td style="text-align: center;">Dias para pagamento</td>
<td  style="text-align: center;"><input name="dias_pag_http" />
</td>
</tr>
<tr>
<td style="text-align: center;">Valor</td>
<td style="text-align: center;"><input name="valor_http" /></td>
</tr>
<tr>
<td style="text-align: center;">Número do Documento</td>
<td style="text-align: center;"><input name="numero_doc_http" /></td>
</tr>
<tr>
<td style="text-align: center;">Nome do cliente</td>
<td style="text-align: center;"><input name="nome_do_cliente_http" /></td>
</tr>
<tr>
<td style="text-align: center;">Endereço do Cliente</td>
<td style="text-align: center;"><input name="end_do_cliente0_http" /></td>
</tr>
<tr>
<td style="text-align: center;">Endereço do Cliente - Cidade</td>
<td style="text-align: center;"><input name="end_do_cliente1_http" /></td>
</tr>
<tr>
<td style="text-align: center;">Endereço do Cliente - Estado</td>
<td style="text-align: center;"><input name="end_do_cliente2_http" /></td>
</tr>
<tr>
<td style="text-align: center;">Endereço do Cliente - CEP</td>
<td style="text-align: center;"><input name="end_do_cliente3_http" /></td>
</tr>
<tr>
<td style="text-align: center;">Dados do Cliente / Serviços</td>
<td style="text-align: center;"><input name="dados_do_cliente_servicos" /></td>
</tr>
</tbody>
</table>
<br />
</div>
<br />
<center><input name="submit" value="Gerar Boleto" type="submit" />
<input name="reset" value="Limpar tudo" type="reset" />
</center>
<form/>
</body>
</html>


