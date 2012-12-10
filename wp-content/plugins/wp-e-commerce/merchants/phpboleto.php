<?php

$nzshpcrt_gateways[$num]['name'] = 'PHP Boleto';
$nzshpcrt_gateways[$num]['admin_name'] = 'PHP Boleto';
$nzshpcrt_gateways[$num]['internalname'] = 'phpboleto';
$nzshpcrt_gateways[$num]['function'] = 'gerar_boleto';
$nzshpcrt_gateways[$num]['form'] = "form_phpboleto";
$nzshpcrt_gateways[$num]['submit_function'] = "submit_phpboleto";

function gerar_boleto($seperator, $sessionid) 
{
    global $wpdb,$wpsc_cart;
    // Carregando os dados
        
    $opt = get_option('phpboleto-config');
     
	$id_pedido = $wpdb->get_var("SELECT ID FROM `".WPSC_TABLE_PURCHASE_LOGS."` WHERE sessionid='".$sessionid."' LIMIT 1");
	
	$wpsc_cart->calculate_total_price();

	$valor_cobrado = $wpsc_cart->total_price; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
	
	$valor_cobrado = str_replace(",", ".",$valor_cobrado);
	$valor_boleto=number_format($valor_cobrado + $opt['phpboleto_taxaboleto'], 2, ',', '');

	$data_vencimento = date("d/m/Y", time() + ($opt['phpboleto_diaspagamento'] * 86400));
	
    $produtos = array(); 

    $produtos_descricao = "";
    
    
    
    foreach($wpsc_cart->cart_items as $item) {
    	
    	$produto = $wpdb->get_row('SELECT name,price,weight FROM '.$wpdb->prefix.'wpsc_product_list WHERE id='.$item->product_id,ARRAY_A,0);
    	
    	$anexo_descricao = "";
    	
    	if ($item->product_variations != '')
    	{
			foreach ($item->product_variations as $var_id => $val_id )
			{
	    		
	    		$variacao_descricao = $wpdb->get_row('SELECT var.name as variacao,val.name as descricao FROM  '.$wpdb->prefix.'wpsc_product_variations var inner join '.$wpdb->prefix.'wpsc_variation_values val on (val.variation_id=var.id) where var.id='.$var_id.' AND val.id='.$val_id, ARRAY_A, 0);
				
	    		$anexo_descricao .= " - ".$variacao_descricao['variacao'].": ".$variacao_descricao['descricao'];
			}
    	}
		
		$produtos_descricao .= $produto['name'].$anexo_descricao."(".$item->quantity.")";    	    	
        
    }

    
    // DADOS DO BOLETO PARA CÓDIGO DE BARRAS
    $dadosboleto["nosso_numero"] = str_pad($id_pedido,13,'0',STR_PAD_LEFT);
	$dadosboleto["numero_documento"] = str_pad($id_pedido,13,'0',STR_PAD_LEFT);	// Num do pedido ou nosso numero
	$dadosboleto["data_vencimento"] = $data_vencimento; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
	$dadosboleto["data_documento"] = date("d/m/Y"); // Data de emissão do Boleto
	$dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
	$dadosboleto["valor_boleto"] = $valor_boleto; 	// Valor do Boleto - REGRA: Com vï¿½rgula e sempre com duas casas depois da virgula
	// FIM DADOS GERAIS DO BOLETO
	
	
	// DADOS DO SEU CLIENTE	
	$_cliente = $_POST["collected_data"];
    
	$dadosboleto["sacado"] = $_cliente[2] . " " . $_cliente[18];
	$dadosboleto["endereco1"] =  $_cliente[4]." ". $_cliente[22]." ". $_cliente[23];
	$dadosboleto["endereco2"] = "Cidade: ". $_cliente[5]." - Estado: ". $_cliente[25]." - CEP: ".preg_replace("/[^0-9]/","", $_cliente[26]);
	
	// FIM DOS DADOS DO CLIENTE
    
    $dadosboleto["identificacao"] = html_entity_decode($opt['phpboleto_identificacao']);
    $dadosboleto["cpf_cnpj"] = html_entity_decode($opt['phpboleto_cpfcnpj']);
    $dadosboleto["endereco"] = html_entity_decode($opt['phpboleto_endereco']);
    $dadosboleto["cidade_uf"] = html_entity_decode($opt['phpboleto_cidadeuf']);
    $dadosboleto["cedente"] = html_entity_decode($opt['phpboleto_cedente']);
    
    
	// INFORMACOES PARA O CLIENTE
	$dadosboleto["demonstrativo1"] = html_entity_decode($opt['phpboleto_demonstrativo1']);
	$dadosboleto["demonstrativo2"] = html_entity_decode($opt['phpboleto_demonstrativo2']);
	$dadosboleto["demonstrativo3"] = html_entity_decode($opt['phpboleto_demonstrativo3']);
	$dadosboleto["instrucoes1"] = html_entity_decode($opt['phpboleto_instrucoes1']);
	$dadosboleto["instrucoes2"] = html_entity_decode($opt['phpboleto_instrucoes2']);
	$dadosboleto["instrucoes3"] = html_entity_decode($opt['phpboleto_instrucoes3']);
	$dadosboleto["instrucoes4"] = html_entity_decode($opt['phpboleto_instrucoes4']);

	// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
	$dadosboleto["quantidade"] = "";
	$dadosboleto["valor_unitario"] = "";
	$dadosboleto["aceite"] = "";		
	$dadosboleto["uso_banco"] = ""; 	
	$dadosboleto["especie"] = "R$";
	$dadosboleto["especie_doc"] = "";


	// DADOS BANCO
	$dadosboleto["codigo_cedente"] = html_entity_decode($opt['phpboleto_codigocedente']); // Código do Cedente (Somente 7 digitos)
	$dadosboleto["carteira"] = html_entity_decode($opt['phpboleto_carteira']);   // Código da Carteira

    // INFORMACOES DOS PRODUTOS COMPRADOS
	$dadosboleto["demonstrativo3"] = $produtos_descricao;
	
	include_once(WP_PLUGIN_DIR."/wp-e-commerce/merchants/phpboleto/include/funcoes_".html_entity_decode($opt['phpboleto_banco']).".php");	
    include_once(WP_PLUGIN_DIR."/wp-e-commerce/merchants/phpboleto/include/layout_".html_entity_decode($opt['phpboleto_banco']).".php");
	
	file_put_contents(WP_PLUGIN_DIR."/wp-e-commerce/merchants/phpboleto/gerados/pedido_".$dadosboleto["nosso_numero"].".html", getBoletoHtml($dadosboleto,plugins_url("/wp-e-commerce/merchants/phpboleto")));
	
	$sql = "UPDATE ".WPSC_TABLE_PURCHASE_LOGS." SET transactid = '".$dadosboleto["nosso_numero"]."', processed=5, date = '".time()."'  WHERE sessionid = ".$sessionid." LIMIT 1";
	$wpdb->query($sql) ;
	
//	transaction_results($sessionid, false, $dadosboleto["nosso_numero"]);
	
	Header("Location: ".get_option("transact_url").$seperator."sessionid=".$sessionid."&transactid=".$dadosboleto["nosso_numero"]."&gateway=phpboleto");
	
	exit();
}

function submit_phpboleto() 
{
		
	foreach (array(	'phpboleto_banco',
					'phpboleto_diaspagamento', 
					'phpboleto_taxaboleto', 
					'phpboleto_demonstrativo1',
					'phpboleto_demonstrativo2',
					'phpboleto_demonstrativo3',
					'phpboleto_instrucoes1',
					'phpboleto_instrucoes2',
					'phpboleto_instrucoes3',
					'phpboleto_instrucoes4',
					'phpboleto_codigocedente',
					'phpboleto_carteira',
					'phpboleto_identificacao',
					'phpboleto_cpfcnpj',
					'phpboleto_endereco',
					'phpboleto_cidadeuf',
					'phpboleto_cedente') as $option_name) {

		if (isset($_POST[$option_name])) {
			$opt[$option_name] = htmlentities(html_entity_decode($_POST[$option_name]));
		}
	}			
		
	update_option('phpboleto-config', $opt);
		
    return true;
}

function form_phpboleto() 
{
	$opt  = get_option('phpboleto-config');
	
	$lista_bancos = array (
						"Banespa" 		=>	"banespa",
						"Banestes"		=>	"banestes",
						"Banco do Brasi"=>	"bb",
						"Bradesco"		=>	"bradesco",
						"Caixa Econômica Federal"	=>	"cef",
						"HSBC"			=>	"hsbc",
						"Itaú"			=>	"itau",
						"Nossa Caixa"	=>	"nossacaixa",
						"Real"			=>	"real",
						"Santander Banespa"	=>	"santander_banespa",
						"Sudameris"		=>	"sudameris",
						"Unibanco"		=>	"unibanco"
						);
	
	$output = "<tr>\n\r";
    
    $output .= "<td >\n\r<strong>Banco:</strong></td>\n\r";
    $output .= "<td><select name=\"phpboleto_banco\">";
    				
    		foreach ($lista_bancos as $nome=>$valor) {
    			$selected = "";
    			
    			if ($valor == html_entity_decode($opt['phpboleto_banco']))
    				$selected = "selected";	
    			
    			$output .= "<option value=\"" . $valor . "\" $selected />".$nome."</option>";
    		}
    				
    				
    $output .= "</select></td>\n\r";
    
    $output .= "</tr>\n\r";
    $output .= "<tr>\n\r";

    $output .= "<td >\n\r<strong>Dias para pagamento:</strong></td>\n\r";
    $output .= "<td><input type=\"text\" name=\"phpboleto_diaspagamento\" value=\"" . html_entity_decode($opt['phpboleto_diaspagamento']) . "\"/></td>\n\r";

    $output .= "</tr>\n\r";
    $output .= "<tr>\n\r";
    
    $output .= "<td >\n\r<strong>Taxa do boleto:</strong></td>\n\r";
    $output .= "<td><input type=\"text\" name=\"phpboleto_taxaboleto\" value=\"" . html_entity_decode($opt['phpboleto_taxaboleto']) . "\"/></td>\n\r";
    
    $output .= "</tr>\n\r";
    $output .= "<tr>\n\r";
    
    $output .= "<td >\n\r<strong>Demonstrativo linha 1:</strong></td>\n\r";
    $output .= "<td><input type=\"text\" name=\"phpboleto_demonstrativo1\" value=\"" . html_entity_decode($opt['phpboleto_demonstrativo1']) . "\"/></td>\n\r";
    
    $output .= "</tr>\n\r";
    $output .= "<tr>\n\r";
    
    $output .= "<td >\n\r<strong>Demonstrativo linha 2:</strong></td>\n\r";
    $output .= "<td><input type=\"text\" name=\"phpboleto_demonstrativo2\" value=\"" . html_entity_decode($opt['phpboleto_demonstrativo2']) . "\"/></td>\n\r";
    
    $output .= "</tr>\n\r";
    $output .= "<tr>\n\r";
    
    $output .= "<td >\n\r<strong>Demonstrativo linha 3:</strong></td>\n\r";
    $output .= "<td><input type=\"text\" name=\"phpboleto_demonstrativo3\" value=\"" . html_entity_decode($opt['phpboleto_demonstrativo3']) . "\"/></td>\n\r";
    
    $output .= "</tr>\n\r";
    $output .= "<tr>\n\r";
    
    $output .= "<td >\n\r<strong>Instruções linha 1:</strong></td>\n\r";
    $output .= "<td><input type=\"text\" name=\"phpboleto_instrucoes1\" value=\"" . html_entity_decode($opt['phpboleto_instrucoes1']) . "\"/></td>\n\r";
    
    $output .= "</tr>\n\r";
    $output .= "<tr>\n\r";
    
    $output .= "<td >\n\r<strong>Instruções linha 2:</strong></td>\n\r";
    $output .= "<td><input type=\"text\" name=\"phpboleto_instrucoes2\" value=\"" . html_entity_decode($opt['phpboleto_instrucoes2']) . "\"/></td>\n\r";
    
    $output .= "</tr>\n\r";
    $output .= "<tr>\n\r";
    
    $output .= "<td >\n\r<strong>Instruções linha 3:</strong></td>\n\r";
    $output .= "<td><input type=\"text\" name=\"phpboleto_instrucoes3\" value=\"" . html_entity_decode($opt['phpboleto_instrucoes3']) . "\"/></td>\n\r";
    
    $output .= "</tr>\n\r";
    $output .= "<tr>\n\r";
    
    $output .= "<td >\n\r<strong>Instruções linha 4:</strong></td>\n\r";
    $output .= "<td><input type=\"text\" name=\"phpboleto_instrucoes4\" value=\"" . html_entity_decode($opt['phpboleto_instrucoes4']) . "\"/></td>\n\r";
    
    $output .= "</tr>\n\r";
    $output .= "<tr>\n\r";
    
    $output .= "<td >\n\r<strong>Código do cedente:</strong></td>\n\r";
    $output .= "<td><input type=\"text\" name=\"phpboleto_codigocedente\" value=\"" . html_entity_decode($opt['phpboleto_codigocedente']) . "\"/></td>\n\r";
    
    $output .= "</tr>\n\r";
    $output .= "<tr>\n\r";
    
    $output .= "<td >\n\r<strong>Código carteira:</strong></td>\n\r";
    $output .= "<td><input type=\"text\" name=\"phpboleto_carteira\" value=\"" . html_entity_decode($opt['phpboleto_carteira']) . "\"/></td>\n\r";
    
    $output .= "</tr>\n\r";
    $output .= "<tr>\n\r";
    
    $output .= "<td >\n\r<strong>Identificação:</strong></td>\n\r";
    $output .= "<td><input type=\"text\" name=\"phpboleto_identificacao\" value=\"" . html_entity_decode($opt['phpboleto_identificacao']) . "\"/></td>\n\r";
    
    $output .= "</tr>\n\r";
    $output .= "<tr>\n\r";
    
    $output .= "<td >\n\r<strong>CPF/CNPJ:</strong></td>\n\r";
    $output .= "<td><input type=\"text\" name=\"phpboleto_cpfcnpj\" value=\"" . html_entity_decode($opt['phpboleto_cpfcnpj']) . "\"/></td>\n\r";
    
    $output .= "</tr>\n\r";
    $output .= "<tr>\n\r";
    
    $output .= "<td >\n\r<strong>Endereço:</strong></td>\n\r";
    $output .= "<td><input type=\"text\" name=\"phpboleto_endereco\" value=\"" . html_entity_decode($opt['phpboleto_endereco']) . "\"/></td>\n\r";
    
    $output .= "</tr>\n\r";
    $output .= "<tr>\n\r";
    
    $output .= "<td >\n\r<strong>Cidade/UF:</strong></td>\n\r";
    $output .= "<td><input type=\"text\" name=\"phpboleto_cidadeuf\" value=\"" . html_entity_decode($opt['phpboleto_cidadeuf']) . "\"/></td>\n\r";
    
    $output .= "</tr>\n\r";
    $output .= "<tr>\n\r";
    
    $output .= "<td >\n\r<strong>Cedente:</strong></td>\n\r";
    $output .= "<td><input type=\"text\" name=\"phpboleto_cedente\" value=\"" . html_entity_decode($opt['phpboleto_cedente']) . "\"/></td>\n\r";
    
    $output .= "</tr>\n\r";
    
    $output .= "</tr>\n\r";
    return $output;
}
