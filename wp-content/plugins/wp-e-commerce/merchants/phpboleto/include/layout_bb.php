<?php
// +----------------------------------------------------------------------+
// | BoletoPhp - Versï¿½o Beta                                              |
// +----------------------------------------------------------------------+
// | Este arquivo estï¿½ disponï¿½vel sob a Licenï¿½a GPL disponï¿½vel pela Web   |
// | em http://pt.wikipedia.org/wiki/GNU_General_Public_License           |
// | Vocï¿½ deve ter recebido uma cï¿½pia da GNU Public License junto com     |
// | esse pacote; se nï¿½o, escreva para:                                   |
// |                                                                      |
// | Free Software Foundation, Inc.                                       |
// | 59 Temple Place - Suite 330                                          |
// | Boston, MA 02111-1307, USA.                                          |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Originado do Projeto BBBoletoFree que tiveram colaboraï¿½ï¿½es de Daniel |
// | William Schultz e Leandro Maniezo que por sua vez foi derivado do	  |
// | PHPBoleto de Joï¿½o Prado Maia e Pablo Martins F. Costa				  |
// | 																	  |
// | Se vc quer colaborar, nos ajude a desenvolver p/ os demais bancos :-)|
// | Acesse o site do Projeto BoletoPhp: www.boletophp.com.br             |
// +----------------------------------------------------------------------+

// +---------------------------------------------------------------------------------+
// | Equipe Coordenaï¿½ï¿½o Projeto BoletoPhp: <boletophp@boletophp.com.br>              |
// | Desenvolvimento Boleto Banco do Brasil: Daniel William Schultz / Leandro Maniezo|
// +---------------------------------------------------------------------------------+

function getBoletoHtml($dadosboleto)
{ 
	
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title><?php echo $dadosboleto["identificacao"]; ?></title>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<meta name="Generator" content="Projeto BoletoPHP - www.boletophp.com.br - Licen�a GPL" />
<style type="text/css">
<!--
.ti {font: 9px Arial, Helvetica, sans-serif}
-->
</style>
</HEAD>
<BODY>
<STYLE>

@media screen,print {

/* *** TIPOGRAFIA BASICA *** */

* {
	font-family: Arial;
	font-size: 12px;
	margin: 0;
	padding: 0;
}

.notice {
	color: red;
}


/* *** LINHAS GERAIS *** */

#container {
	width: 666px;
	margin: 0px auto;
	padding-bottom: 30px;
}

#instructions {
	margin: 0;
	padding: 0 0 20px 0;
}

#boleto {
	width: 666px;
	margin: 0;
	padding: 0;
}


/* *** CABECALHO *** */


#instr_header address {
	font-style: normal;
}

#instr_content {

}

#instr_content h2 {
	font-size: 12px;
	font-weight: bold;
}

#instr_content p {
	margin: 4px 0px;
}

#instr_content ol {
	margin: 5px 0;
}

#instr_content ol li {
	text-indent: 10px;
	margin: 2px 0px;
	list-style-position: inside;
}

#instr_content ol li p {
	padding-bottom: 4px;
}


/* *** BOLETO *** */

#boleto .cut {
	width: 666px;
	margin: 0px auto;
	border-bottom: 1px navy dashed;
}

#boleto .cut p {
	margin: 0 0 5px 0;
	padding: 0px;
	font-family: 'Arial Narrow';
	font-size: 9px;
	color: navy;
}

table.header {
	width: 666px;
	height: 38px;
	margin-top: 20px;
	margin-bottom: 10px;
	border-bottom: 2px navy solid;
	
}


table.header div.field_cod_banco {
	width: 46px;
	height: 19px;
  margin-left: 5px;
	padding-top: 3px;
	text-align: center;
	font-size: 14px;
	font-weight: bold;
	color: navy;
	border-right: 2px solid navy;
	border-left: 2px solid navy;
}

table.header td.linha_digitavel {
	width: 464px;
	text-align: right;
	font: bold 15px Arial; 
	color: navy
}

table.line {
	margin-bottom: 3px;
	padding-bottom: 1px;
	border-bottom: 1px black solid;
}
table.line0 {
	margin-bottom: 0px;
	padding-bottom: 0px;
	border-bottom: 0px black solid;
}

table.line tr.titulos td {
	height: 13px;
	font-family: 'Arial Narrow';
	font-size: 9px;
	color: navy;
	border-left: 5px #ffe000 solid;
	padding-left: 2px;
}

table.line0 tr.titulos0 td {
	height: 13px;
	font-family: 'Arial Narrow';
	font-size: 9px;
	color: navy;
	border-left: 5px #ffe000 solid;
	padding-left: 2px;
}

table.line tr.campos td {
	height: 12px;
	font-size: 10px;
	color: black;
	border-left: 5px #ffe000 solid;
	padding-left: 2px;
}

table.line0 tr.campos0 td {
	height: 12px;
	font-size: 10px;
	color: black;
	border-left: 5px #ffe000 solid;
	padding-left: 2px;
}
table.line td p {
	font-size: 10px;
}
table.line0 td p {
	font-size: 10px;
}


table.line tr.campos td.ag_cod_cedente,
table.line tr.campos td.nosso_numero,
table.line tr.campos td.valor_doc,
table.line tr.campos td.vencimento2,
table.line tr.campos td.ag_cod_cedente2,
table.line tr.campos td.nosso_numero2,
table.line tr.campos td.xvalor,
table.line tr.campos td.valor_doc2
{
	text-align: right;
}

table.line tr.campos td.especie,
table.line tr.campos td.qtd,
table.line tr.campos td.vencimento,
table.line tr.campos td.especie_doc,
table.line tr.campos td.aceite,
table.line tr.campos td.carteira,
table.line tr.campos td.especie2,
table.line tr.campos td.qtd2
{
	text-align: center;
}

table.line td.last_line {
	vertical-align: top;
	height: 25px;
}

table.line td.last_line table.line {
	margin-bottom: -5px;
	border: 0 white none;
}

td.last_line table.line td.instrucoes {
	border-left: 0 white none;
	padding-left: 5px;
	padding-bottom: 0;
	margin-bottom: 0;
	height: 20px;
	vertical-align: top;
}

table.line td.cedente {
	width: 298px;
}

table.line td.valor_cobrado2 {
	padding-bottom: 0;
	margin-bottom: 0;
}


table.line td.ag_cod_cedente {
	width: 126px;
}

table.line td.especie {
	width: 35px;
}

table.line td.qtd {
	width: 53px;
}

table.line td.nosso_numero {
	/* width: 120px; */
	width: 115px;
	padding-right: 5px;
}

table.line td.num_doc {
	width: 113px;
}

table.line td.contrato {
	width: 72px;
}

table.line td.cpf_cei_cnpj {
	width: 132px;
}

table.line td.vencimento {
	width: 134px;
}

table.line td.valor_doc {
	/* width: 180px; */
	width: 175px;
	padding-right: 5px;
}

table.line td.desconto {
	width: 113px;
}

table.line td.outras_deducoes {
	width: 112px;
}

table.line td.mora_multa {
	width: 113px;
}

table.line td.outros_acrescimos {
	width: 113px;
}

table.line td.valor_cobrado {
	/* width: 180px; */
	width: 175px;
	padding-right: 5px;
	background-color: #ffc ;
}

table.line td.sacado {
	width: 659px;
}

table.line td.local_pagto {
	width: 472px;
}

table.line td.vencimento2 {
	/* width: 180px; */
	width: 175px;
	padding-right: 5px;
	background-color: #ffc;
}

table.line td.cedente2 {
	width: 472px;
}

table.line td.ag_cod_cedente2 {
	/* width: 180px; */
	width: 175px;
	padding-right: 5px;
}

table.line td.data_doc {
	width: 93px;
}

table.line td.num_doc2 {
	width: 173px;
}

table.line td.especie_doc {
	width: 72px;
}

table.line td.aceite {
	width: 34px;
}

table.line td.data_process {
	width: 72px;
}

table.line td.nosso_numero2 {
	/* width: 180px; */
	width: 175px;
	padding-right: 5px;
}

table.line td.reservado {
	width: 93px;
	background-color: #ffc;
}

table.line td.carteira {
	width: 93px;
}

table.line td.especie2 {
	width: 53px;
}

table.line td.qtd2 {
	width: 133px;
}

table.line td.xvalor {
	/* width: 72px; */
	width: 67px;
	padding-right: 5px;
}

table.line td.valor_doc2 {
	/* width: 180px; */
	width: 175px;
	padding-right: 5px;
}
table.line td.instrucoes {
	width: 475px;
}

table.line td.desconto2 {
	/* width: 180px; */
	width: 175px;
	padding-right: 5px;
}

table.line td.outras_deducoes2 {
	/* width: 180px; */
	width: 175px;
	padding-right: 5px;
}

table.line td.mora_multa2 {
	/* width: 180px; */
	width: 175px;
	padding-right: 5px;
}

table.line td.outros_acrescimos2 {
	/* width: 180px; */
	width: 175px;
	padding-right: 5px;
}

table.line td.valor_cobrado2 {
	/* width: 180px; */
	width: 175px;
	padding-right: 5px;
	background-color: #ffc ;
}

table.line td.sacado2 {
	width: 659px;
}
table.line0 td.sacado2 {
	width: 659px;
}

table.line td.sacador_avalista {
	width: 607px;
}

div.footer0 {
	margin-bottom: 30px;
}

div.footer0 p {
	width: 200px;
	margin: 0;
	padding: 0;
	padding-left: 475px;
	font-family: 'Arial Narro';
	font-size: 9px;
	color: navy;
}

div.footer1 {
	margin-bottom: 30px;
}

div.footer1 p {
	width: 300px;
	margin: 0;
	padding: 0;
	padding-left: 450px;
	font-family: 'Arial Narro';
	font-size: 9px;
	color: navy;
}
div.barcode {
	width: 666px;
	margin-bottom: 20px;
}

}



@media print {

#instructions {
	height: 1px;
	visibility: hidden;
	overflow: hidden;
}

}

</STYLE>

</head>
<body>

<div id="container">

	<div id="instr_header">
		<h1>O pagamento deste boleto também poderá ser efetuado nos terminais de Auto-Atendimento BB</h1>
		<h2>Instruções:</h2>
		<p>1. Imprima em impressora jato de tinta (ink jet) ou laser em qualidade normal ou alta Não use modo econômico.
		      Por favor, configure a margens esquerda e direita para 17 mm</p>
   		<p>2. Utilize folha A4 (210 x 297 mm) ou Carta (216 x 279 mm) e margens mínimas à esquerda e à direita do formulário.</p>
   		<p>3. Corte na linha indicada. Não rasure, risque, fure ou dobre a região onde se encontra o código de barras.</p>
   		<p>Depois de ter impresso, <a href="<?php echo get_permalink(357); ?>">retorne a nossa loja</a>.</p> 
	</div>	<!-- id="instr_header" -->

	<div id="">
<!--
  Use no lugar do <div id=""> caso queira imprimir sem o logotipo e instruï¿½ï¿½es
  <div id="instructions">
 -->
		
	
	
	<div id="boleto">
		<div class="cut">
			<p>Corte na linha pontilhada</p>
		</div>
    		
		<table class="header" border=0 cellspacing="0" cellpadding="0">
		<tbody>
		<tr>
			<td width=150><IMG SRC="<?php echo WP_PLUGIN_URL."/wp-shopping-cart/merchants/phpboleto/"; ?>imagens/logobb.jpg"></td>
			<td width=50>
        <div class="field_cod_banco"><?php echo $dadosboleto["codigo_banco_com_dv"]?></div>
			</td>
			<td class="linha_digitavel"><?php echo $dadosboleto["linha_digitavel"]?></td>
		</tr>
		</tbody>
		</table>

		<table class="line" cellspacing="0" cellpadding="0">
		<tbody>
		<tr class="titulos">
			<td class="cedente">Cedente</TD>
			<td class="ag_cod_cedente">Ag&ecirc;ncia / C&oacute;digo do Cedente</td>
			<td class="especie">Esp&eacute;cie</TD>
			<td class="qtd">Quantidade</TD>
			<td class="nosso_numero">Nosso n&uacute;mero</td>
		</tr>

		<tr class="campos">
			<td class="cedente"><?php echo $dadosboleto["cedente"]; ?>&nbsp;</td>
			<td class="ag_cod_cedente"><?php echo $dadosboleto["agencia_codigo"]?> &nbsp;</td>
			<td class="especie"><?php echo $dadosboleto["especie"]?>&nbsp;</td>
			<TD class="qtd"><?php echo $dadosboleto["quantidade"]?>&nbsp;</td>
			<TD class="nosso_numero"><?php echo $dadosboleto["nosso_numero"]?>&nbsp;</td>
		</tr>
		</tbody>
		</table>

		<table class="line" cellspacing="0" cellPadding="0">
		<tbody>
		<tr class="titulos">
			<td class="num_doc">N&uacute;mero do documento</td>
			<td class="contrato">Contrato</TD>
			<td class="cpf_cei_cnpj">CPF/CEI/CNPJ</TD>
			<td class="vencmento">Vencimento</TD>
			<td class="valor_doc">Valor documento</TD>
		</tr>
		<tr class="campos">
			<td class="num_doc"><?php echo $dadosboleto["numero_documento"]?></td>
			<td class="contrato"><?php echo $dadosboleto["contrato"]?></td>
			<td class="cpf_cei_cnpj"><?php echo $dadosboleto["cpf_cnpj"]?></td>
			<td class="vencimento"><?php echo $dadosboleto["data_vencimento"]?></td>
			<td class="valor_doc"><?php echo $dadosboleto["valor_boleto"]?></td>
		</tr>
      </tbody>
      </table>

		<table class="line" cellspacing="0" cellPadding="0">
		<tbody>
		<tr class="titulos">
			<td class="desconto">(-) Desconto / Abatimento</td>
			<td class="outras_deducoes">(-) Outras dedu&ccedil;&otilde;es</td>
			<td class="mora_multa">(+) Mora / Multa</td>
			<td class="outros_acrescimos">(+) Outros acr&eacute;scimos</td>
			<td class="valor_cobrado">(=) Valor cobrado</td>
		</tr>
		<tr class="campos">
			<td class="desconto">&nbsp;</td>
			<td class="outras_deducoes">&nbsp;</td>
			<td class="mora_multa">&nbsp;</td>
			<td class="outros_acrescimos">&nbsp;</td>
			<td class="valor_cobrado">&nbsp;</td>
		</tr>
		</tbody>
		</table>

      
		<table class="line" cellspacing="0" cellpadding="0">
		<tbody>
		<tr class="titulos">
			<td class="sacado">Sacado</td>
		</tr>
		<tr class="campos">
			<td class="sacado"><?php echo $dadosboleto["sacado"]?></td>
		</tr>
		</tbody>
		</table>
		
		<div class="footer0">
			<p>Autentica&ccedil;&atilde;o mec&acirc;nica/Recibo do Sacado</p>
		</div>
		
		<div class="cut">
			<p>Corte na linha pontilhada</p>
		</div>


		<table class="header" border=0 cellspacing="0" cellpadding="0">
		<tbody>
		<tr>
			<td width=150><IMG SRC="<?php echo WP_PLUGIN_URL."/wp-shopping-cart/merchants/phpboleto/"; ?>imagens/logobb.jpg"></td>
			<td width=50>
        <div class="field_cod_banco"><?php echo $dadosboleto["codigo_banco_com_dv"]?></div>
			</td>
			<td class="linha_digitavel"><?php echo $dadosboleto["linha_digitavel"]?></td>
		</tr>
		</tbody>
		</table>

		<table class="line" cellspacing="0" cellpadding="0">
		<tbody>
		<tr class="titulos">
			<td class="local_pagto">Local de pagamento</td>
			<td class="vencimento2">Vencimento</td>
		</tr>
		<tr class="campos">
			<td class="local_pagto">QUALQUER BANCO AT&Eacute; O VENCIMENTO</td>
			<td class="vencimento2"><?php echo $dadosboleto["data_vencimento"]?></td>
		</tr>
		</tbody>
		</table>
		
		<table class="line" cellspacing="0" cellpadding="0">
		<tbody>
		<tr class="titulos">
			<td class="cedente2">Cedente</td>
			<td class="ag_cod_cedente2">Ag&ecirc;ncia/C&oacute;digo cedente</td>
		</tr>
		<tr class="campos">
			<td class="cedente2"><?php echo $dadosboleto["cedente"]?></td>
			<td class="ag_cod_cedente2"><?php echo $dadosboleto["agencia_codigo"]?></td>
		</tr>
		</tbody>
		</table>

		<table class="line" cellspacing="0" cellpadding="0">
		<tbody>
		<tr class="titulos">
			<td class="data_doc">Data do documento</td>
			<td class="num_doc2">No. documento</td>
			<td class="especie_doc">Esp&eacute;cie doc.</td>
			<td class="aceite">Aceite</td>
			<td class="data_process">Data process.</td>
			<td class="nosso_numero2">Nosso n&uacute;mero</td>
		</tr>
		<tr class="campos">
			<td class="data_doc"><?php echo $dadosboleto["data_documento"]?></td>
			<td class="num_doc2"><?php echo $dadosboleto["numero_documento"]?></td>
			<td class="especie_doc"><?php echo $dadosboleto["especie_doc"]?></td>
			<td class="aceite"><?php echo $dadosboleto["aceite"]?></td>
			<td class="data_process"><?php echo $dadosboleto["data_processamento"]?></td>
			<td class="nosso_numero2"><?php echo $dadosboleto["nosso_numero"]?></td>
		</tr>
		</tbody>
		</table>

		<table class="line" cellspacing="0" cellPadding="0">
		<tbody>
		<tr class="titulos">
			<td class="reservado">Uso do  banco</td>
			<td class="carteira">Carteira</td>
			<td class="especie2">Esp&eacute;cie</td>
			<td class="qtd2">Quantidade</td>
			<td class="xvalor">x Valor</td>
			<td class="valor_doc2">(=) Valor documento</td>
		</tr>
		<tr class="campos">
			<td class="reservado">&nbsp;</td>
			<td class="carteira"><?php echo $dadosboleto["carteira"]?> <?php echo isset($dadosboleto["variacao_carteira"]) ? $dadosboleto["variacao_carteira"] : '&nbsp;' ?></td>
			<td class="especie2"><?php echo $dadosboleto["especie"]?></td>
			<td class="qtd2"><?php echo $dadosboleto["quantidade"]?></td>
			<td class="xvalor"><?php echo $dadosboleto["valor_unitario"]?></td>
			<td class="valor_doc2"><?php echo $dadosboleto["valor_boleto"]?></td>
		</tr>
		</tbody>
		</table>
		<table class="line" cellspacing="0" cellpadding="0">
		<tbody>
		<tr><td class="last_line" rowspan="6">
			<table class="line" cellspacing="0" cellpadding="0">
			<tbody>
			<tr class="titulos">
				<td class="instrucoes">
						Instru&ccedil;&otilde;es (Texto de responsabilidade do cedente)
				</td>
			</tr>
			<tr class="campos">
				<td class="instrucoes" rowspan="5">
					<p><?php echo $dadosboleto["demonstrativo1"]; ?></p>		
					
					<p><?php echo $dadosboleto["demonstrativo3"]; ?></p>
					<p><?php echo $dadosboleto["instrucoes1"]; ?></p>
					<p><?php echo $dadosboleto["instrucoes2"]; ?></p>
					<p><?php echo $dadosboleto["instrucoes3"]; ?></p>
					<p><?php echo $dadosboleto["instrucoes4"]; ?></p>
				</td>
			</tr>
			</tbody>
			</table>
		</td></tr>
		<tr><td>
			<table class="line" cellspacing="0" cellpadding="0">
			<tbody>
			<tr class="titulos">
				<td class="desconto2">(-) Desconto / Abatimento</td>
			</tr>
			<tr class="campos">
				<td class="desconto2">&nbsp;</td>
			</tr>
			</tbody>
			</table>
		</td></tr>
		<tr><td>
			<table class="line" cellspacing="0" cellpadding="0">
			<tbody>
			<tr class="titulos">
				<td class="outras_deducoes2">(-) Outras dedu&ccedil;&otilde;es</td>
			</tr>
			<tr class="campos">
				<td class="outras_deducoes2">&nbsp;</td>
			</tr>
			</tbody>
			</table>
		</td></tr>
		<tr><td>
			<table class="line" cellspacing="0" cellpadding="0">
			<tbody>
			<tr class="titulos">
				<td class="mora_multa2">(+) Mora / Multa</td>
			</tr>
			<tr class="campos">
				<td class="mora_multa2">&nbsp;</td>
			</tr>
			</tbody>
			</table>
		</td></tr>
		<tr><td>
			<table class="line" cellspacing="0" cellpadding="0">
			<tbody>
			<tr class="titulos">
				<td class="outros_acrescimos2">(+) Outros Acr&eacute;scimos</td>
			</tr>
			<tr class="campos">
				<td class="outros_acrescimos2">&nbsp;</td>
			</tr>
			</tbody>
			</table>
		</td></tr>
		<tr><td class="last_line">
			<table class="line" cellspacing="0" cellpadding="0">
			<tbody>
			<tr class="titulos">
				<td class="valor_cobrado2">(=) Valor cobrado</td>
			</tr>
			<tr class="campos">
				<td class="valor_cobrado2">&nbsp;</td>
			</tr>
			</tbody>
			</table>
		</td></tr>
		</tbody>
		</table>
		<table class="line0" cellspacing="0" cellPadding="0">
		<tbody>
		<tr class="titulos0">
			<td class="sacado2">Sacado</td>
		</tr>
		<tr class="campos0">
			<td class="sacado2">
				<p><?php echo $dadosboleto["sacado"]?></p>
				<p><?php echo $dadosboleto["endereco1"]?></p>
				<p><?php echo $dadosboleto["endereco2"]?></p>
			</td>
		</tr>
		</tbody>
		</table>		
		<table class="line" cellspacing="0" cellpadding="0">
		<tbody>
		<tr class="titulos">
			<td class="sacador_avalista" colspan="2">Sacador/Avalista</td>
		</tr>
		<tr class="campos">
			<td class="sacador_avalista">&nbsp;</td>
			<td class="cod_baixa">C&oacute;d. baixa</td>
		</tr>
		</tbody>
		</table>		
		<div class="footer1">
			<p>Autentica&ccedil;&atilde;o mec&acirc;nica/Ficha de Compensa&ccedil;&atilde;o</p>
		</div>
		<div class="barcode">
		<p><?php fbarcode($dadosboleto["codigo_barras"]); ?></p>
		</div>
        <div class="cut">
		<p>Corte na linha pontilhada</p>
		</div>
		</div>
</div>

</body>

</html>
<?php } ?>