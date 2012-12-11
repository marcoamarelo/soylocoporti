<?php
// +----------------------------------------------------------------------+
// | BoletoPhp - Vers�o Beta                                              |
// +----------------------------------------------------------------------+
// | Este arquivo est� dispon�vel sob a Licen�a GPL dispon�vel pela Web   |
// | em http://pt.wikipedia.org/wiki/GNU_General_Public_License           |
// | Voc� deve ter recebido uma c�pia da GNU Public License junto com     |
// | esse pacote; se n�o, escreva para:                                   |
// |                                                                      |
// | Free Software Foundation, Inc.                                       |
// | 59 Temple Place - Suite 330                                          |
// | Boston, MA 02111-1307, USA.                                          |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Originado do Projeto BBBoletoFree que tiveram colabora��es de Daniel |
// | William Schultz e Leandro Maniezo que por sua vez foi derivado do	  |
// | PHPBoleto de Jo�o Prado Maia e Pablo Martins F. Costa				        |
// | 														                                   			  |
// | Se vc quer colaborar, nos ajude a desenvolver p/ os demais bancos :-)|
// | Acesse o site do Projeto BoletoPhp: www.boletophp.com.br             |
// +----------------------------------------------------------------------+

// +--------------------------------------------------------------------------------------------------------+
// | Equipe Coordena��o Projeto BoletoPhp: <boletophp@boletophp.com.br>              		             				|
// | Desenvolvimento Boleto Banco do Brasil: Daniel William Schultz / Leandro Maniezo / Rog�rio Dias Pereira|
// +--------------------------------------------------------------------------------------------------------+

// ------------------------- DADOS DIN�MICOS DO SEU CLIENTE PARA A GERA��O DO BOLETO (FIXO OU VIA GET) -------------------- //
// Os valores abaixo podem ser colocados manualmente ou ajustados p/ formul�rio c/ POST, GET ou de BD (MySql,Postgre,etc)	//

// DADOS DO BOLETO PARA O SEU CLIENTE

$dias_de_prazo_para_pagamento = 7;
$taxa_boleto = 5;
$data_venc = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006"; 

$dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto
$dadosboleto["data_documento"] = date("d/m/Y"); // Data de emiss�o do Boleto
$dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)

$dadosboleto["demonstrativo2"] = "";
$dadosboleto["demonstrativo3"] = "SOYLOCOPORTI - PELA INTEGRAÇÃO LATINO-AMERICANA";
$dadosboleto["instrucoes1"] = "- Sr. Caixa, cobrar multa de 2% ap&oacute;s o vencimento";
$dadosboleto["instrucoes2"] = "- Mora di&aacute;ria de 0,35%";
$dadosboleto["instrucoes3"] = "- Em caso de d&uacute;vidas entre em contato conosco: contato@soylocoporti.org.br";
$dadosboleto["instrucoes4"] = "&nbsp; Pela loja eletrônica do coletivo Soylocoporti.";

// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
$dadosboleto["quantidade"] = "";
$dadosboleto["valor_unitario"] = "";
$dadosboleto["aceite"] = "N";		
$dadosboleto["uso_banco"] = ""; 	
$dadosboleto["especie"] = "R$";
$dadosboleto["especie_doc"] = "DM";

// ---------------------- DADOS FIXOS DE CONFIGURA��O DO SEU BOLETO --------------- //

// DADOS DA SUA CONTA - BANCO DO BRASIL
$dadosboleto["agencia"] = "1518"; // Num da agencia, sem digito
$dadosboleto["conta"] = "18979"; 	// Num da conta, sem digito

// DADOS PERSONALIZADOS - BANCO DO BRASIL
$dadosboleto["convenio"] = "307847";  // Num do conv�nio - REGRA: 6 ou 7 ou 8 d�gitos
$dadosboleto["contrato"] = "105795"; // Num do seu contrato
$dadosboleto["carteira"] = "18";
$dadosboleto["variacao_carteira"] = "019";  // Varia��o da Carteira, com tra�o (opcional)

// TIPO DO BOLETO
$dadosboleto["formatacao_convenio"] = "6"; // REGRA: 8 p/ Conv�nio c/ 8 d�gitos, 7 p/ Conv�nio c/ 7 d�gitos, ou 6 se Conv�nio c/ 6 d�gitos
$dadosboleto["formatacao_nosso_numero"] = "1"; // REGRA: Usado apenas p/ Conv�nio c/ 6 d�gitos: informe 1 se for NossoN�mero de at� 5 d�gitos ou 2 para op��o de at� 17 d�gitos

/*
#################################################
DESENVOLVIDO PARA CARTEIRA 18 ---- 08007290123

- Carteira 18 com Convenio de 8 digitos
  Nosso n�mero: pode ser at� 9 d�gitos

- Carteira 18 com Convenio de 7 digitos
  Nosso n�mero: pode ser at� 10 d�gitos

- Carteira 18 com Convenio de 6 digitos
  Nosso n�mero:
  de 1 a 99999 para op��o de at� 5 d�gitos
  de 1 a 99999999999999999 para op��o de at� 17 d�gitos

#################################################
*/


// SEUS DADOS

$dadosboleto["identificacao"] = "SOYLOCOPORTI - PELA INTEGRAÇÃO LATINO-AMERICANA";
$dadosboleto["cpf_cnpj"] = "08.723.179/0001-17";
$dadosboleto["endereco"] = "RUA ITUPAVA, 1299 CJ 312";
$dadosboleto["cidade_uf"] = "CURITIBA-PR";
$dadosboleto["cedente"] = "SOYLOCOPORTI.";

// N�O ALTERAR!
include("include/funcoes_bb.php"); 
include("include/layout_bb.php");
?>
