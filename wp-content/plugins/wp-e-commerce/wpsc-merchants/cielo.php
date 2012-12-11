<?php
/*
 * Some parts of this code were inspired by the shopp plugin and their paypal pro module. 
 * and copyright Ingenesis Limited, 19 August, 2008.
 */
$nzshpcrt_gateways[$num]['name'] = 'Cielo - Cartões de Crédito';
$nzshpcrt_gateways[$num]['internalname'] = 'cielo';
$nzshpcrt_gateways[$num]['function'] = 'gateway_cielo';
$nzshpcrt_gateways[$num]['form'] = "form_cielo";
$nzshpcrt_gateways[$num]['submit_function'] = "submit_cielo";
$nzshpcrt_gateways[$num]['payment_type'] = "credit_card";

if(in_array('cielo',(array)get_option('custom_gateway_options'))) {
	$curryear = date('Y');
	
	//generate year options
	for($i=0; $i < 10; $i++){
		$years .= "<option value='".$curryear."'>".$curryear."</option>\r\n";
		$curryear++;
	}
 
	$gateway_checkout_form_fields[$nzshpcrt_gateways[$num]['internalname']] = "
	<tr id='wpsc_pppro_cc_type' class='card_type' >
		<td colspan='2'>
			<label for='visa' id='spanvisa' >Visa <input type='radio' id='visa' name='cctype' value='visa'></label>		
			<label for='mastercard' id='spanmastercard'>Mastercard <input type='radio' id='mastercard' name='cctype' value='mastercard' ></label>
		</td>
	</tr>
	<tr id='wpsc_pppro_cc_number'>
		<td class='wpsc_pppro_cc_number1'>Número do cartão: *</td>
		<td class='wpsc_pppro_cc_number2'>
			<input type='text' value='' maxlength='16' name='card_number' title='Por favor, insira o número do cartão de crédito'  />
		</td>
	</tr>
	<tr id='wpsc_pppro_cc_number'>
		<td class='wpsc_pppro_cc_number1'>Nome impresso no cartão: *</td>
		<td class='wpsc_pppro_cc_number2'>
			<input type='text' value='' name='nome_portador' maxlength='50' size='35' title='Por favor, insira o nome exatamente como ele está impresso no cartão'  />
		</td>
		
	</tr>
	<tr id='wpsc_pppro_cc_expiry' >
		<td class='wpsc_pppro_cc_expiry1'>Validade: *</td>
		<td class='wpsc_pppro_cc_expiry2'>
			<select class='wpsc_ccBox' name='expiry[month]'>
			".$months."
			<option value='01'>01</option>
			<option value='02'>02</option>
			<option value='03'>03</option>
			<option value='04'>04</option>
			<option value='05'>05</option>						
			<option value='06'>06</option>						
			<option value='07'>07</option>					
			<option value='08'>08</option>						
			<option value='09'>09</option>						
			<option value='10'>10</option>						
			<option value='11'>11</option>																			
			<option value='12'>12</option>																			
			</select>
			<select class='wpsc_ccBox' name='expiry[year]'>
			".$years."
			</select>
		</td>
	</tr>
	<tr id='wpsc_pppro_cc_code' class='card_cvv' >
		<td class='wpsc_pppro_cc_code1'>Código de segurança: *</td>
		<td class='wpsc_pppro_cc_code2'><input type='text' size='4' value='' maxlength='3' name='card_code' title='Por favor, insira o código de segurança localizado na parte de trás do cartão' />
		</td>
	</tr>
	<tr id='wpsc_pppro_cc_parcelamento' class='card_parcela' >
		<td class='wpsc_pppro_cc_parcela1'>Parcele a sua compra: *</td>
		<td class='wpsc_pppro_cc_parcela2'>
			<select class='wpsc_ccparcela' name='card_parcelamento' id='card_parcelamento'>
				<option value='1'>1x</option>
				<option value='2'>2x</option>
				<option value='3'>3x</option>
				<option value='4'>4x</option>																							
			</select>
		</td>
	</tr>
	 <script>
  	
		jQuery(\".wpsc_checkout_forms\").validate({
				rules: {					
	         		card_number: {
	       				minlength: 16,
	       				maxlength: 16,
	       				number: true     				
	     			},
	     			cctype: {
	     				required:true				
	         		},
	         		nome_portador: {
	     				required:true
	         		},
	         		card_code: {
	         			minlength: 3,
	       				maxlength: 3,
	     				required:true
	     			}
     			},
				messages: {
     				card_number: {       				
       					minlength: \"Verifique se você digitou todos os números do seu cartão\",
       					maxlength: \"O número do cartão não pode ter mais que 16 números\",
       					required: \"Por favor, insira o número do cartão de crédito\"
     				},
     				cctype: {
     					required: \"Selecione uma bandeira de pagamento\",
     					number: \"Este campo só pode receber números. Por favor, verifique se os dados estão corretos\"
     				},
     				nome_portador: {
     					required: \"Por favor, insira o nome exatamente como ele está impresso no cartão\"
     				},
     				card_code: {
     					minlength: \"O código de segurança deve ter 3 dígitos\",
	       				maxlength: \"O código de segurança deve ter 3 dígitos\",
     					required: \"Por favor, insira o código de segurança localizado na parte de trás do cartão\"
     				} 				
       			},
       			errorPlacement: function(error, element) {
     				if (element.attr(\"name\") == \"cctype\")
				       error.insertAfter(\"#spanmastercard\");
     				else
       					error.insertAfter(element);
   				}
       			
     		});   			
  	
  </script>
	

";
}
  
  
function gateway_cielo($seperator, $sessionid){
	
	global $wpdb, $wpsc_cart;

	$id_pedido = $wpdb->get_var("SELECT ID FROM `".WPSC_TABLE_PURCHASE_LOGS."` WHERE sessionid='".$sessionid."' LIMIT 1");
	
	$wpsc_cart->calculate_total_price();

	$valor_cobrado = $wpsc_cart->total_price;
	
	$produtos = array(); 

    $produtos_descricao = "";
    
    foreach($wpsc_cart->cart_items as $item) {
    	
    	$produto = $wpdb->get_row('SELECT name,price,weight FROM '.$wpdb->prefix.'wpsc_product_list WHERE id='.$item->product_id,ARRAY_A,0);
    	
    	$anexo_descricao = "";
    	
		foreach ($item->product_variations as $var_id => $val_id )
		{
    		
    		$variacao_descricao = $wpdb->get_row('SELECT var.name as variacao,val.name as descricao FROM  '.$wpdb->prefix.'wpsc_product_variations var inner join '.$wpdb->prefix.'wpsc_variation_values val on (val.variation_id=var.id) where var.id='.$var_id.' AND val.id='.$val_id, ARRAY_A, 0);
			
    		$anexo_descricao .= " - ".$variacao_descricao['variacao'].": ".$variacao_descricao['descricao'];
		}
		
		$produtos_descricao .= $produto['name'].$anexo_descricao."(".$item->quantity.")";    	    	
        
    }
	
	
	$opt = get_option("cielo-config");
	
	//sendcielo(file_get_contents("/home/marco/trabalhos/cintaliga/wp-content/plugins/wp-e-commerce/merchants/teste_cielo.xml"));
		
	$requisicaoCielo = new SimpleXMLElement(file_get_contents(dirname(__FILE__)."/cielo_skeleton.xml"));
	
	$requisicaoCielo->tid = $sessionid;
	$requisicaoCielo->{'dados-ec'}->numero = $opt['cielo_numeroafiliacao'];
	$requisicaoCielo->{'dados-ec'}->chave = $opt['cielo_chaveafiliacao'];
	
	$requisicaoCielo->{'dados-cartao'}->numero = $_POST['card_number'];
	$requisicaoCielo->{'dados-cartao'}->validade = $_POST['expiry']['year'].$_POST['expiry']['month'];
	$requisicaoCielo->{'dados-cartao'}->{'codigo-seguranca'} = $_POST['card_code'];
	$requisicaoCielo->{'dados-cartao'}->{'nome-portador'} = $_POST['nome_portador'];
	
	$requisicaoCielo->{'dados-pedido'}->numero = $id_pedido;
	$requisicaoCielo->{'dados-pedido'}->valor = str_replace(".","",str_replace(",","",sprintf("%0.2f",$valor_cobrado)));
	//$requisicaoCielo->{'dados-pedido'}->valor = 100;
	$requisicaoCielo->{'dados-pedido'}->{'data-hora'} = date("Y-m-d\TH:i:s");
	//$requisicaoCielo->{'dados-pedido'}->descricao = $produtos_descricao;
	
	$requisicaoCielo->{'forma-pagamento'}->bandeira = $_POST['cctype'];
	
	// Caso a compra seja parcelada
	if ($_POST['collected_data']['wpsc_ccparcela']>1){
		// produto tipo 2, parcelado pela loja
		$requisicaoCielo->{'forma-pagamento'}->produto = "2";
		$requisicaoCielo->{'forma-pagamento'}->parcelas = $_POST['wpsc_ccparcela'];
	}
	
	//"mensagem=".$requisicaoCielo->asXML()
	
	$response = sendcielo($requisicaoCielo);
	
	//exit('<pre>'.print_r($response, true).'</pre><pre>'.print_r($data, true).'</pre>');
	if($response->autorizacao->codigo == '4'){
		//redirect to  transaction page and store in DB as a order with accepted payment
		$sql = "UPDATE `".WPSC_TABLE_PURCHASE_LOGS."` SET `processed`= '2',authcode = '".$response->autorizacao->arp."',transactid='".$response->tid."' WHERE `sessionid`=".$sessionid;
		$wpdb->query($sql);
		$transact_url = get_option('transact_url');
		unset($_SESSION['WpscGatewayErrorMessage']);

		Header("Location: ".get_option("transact_url").$seperator."sessionid=".$sessionid."&transactid=".$response->tid."&gateway=cielo");
	
		exit();
	}else{
		//redirect back to checkout page with errors
		Header("Location: ".get_option("transact_url").$seperator."sessionid=");
	
		exit();
	}
}

function sendcielo ($requisicaoCielo) {
	
	$connection = curl_init();
	
	$opt  = get_option('cielo-config');
		
	if ($opt['cielo_testmode'] == "1"){
		curl_setopt($connection,CURLOPT_URL,"https://qasecommerce.cielo.com.br/servicos/ecommwsec.do"); // Sandbox testing
//		exit('sandbox is true');
	}else{
		curl_setopt($connection,CURLOPT_URL,"https://ecommerce.cbmp.com.br/servicos/ecommwsec.do"); // Live
	}

	$requisicaoCieloTID = new SimpleXMLElement(file_get_contents(dirname(__FILE__)."/cielo_skeleton_tid.xml"));
	
	$requisicaoCieloTID->{'dados-ec'}->numero = $requisicaoCielo->{'dados-ec'}->numero;
	$requisicaoCieloTID->{'dados-ec'}->chave = $requisicaoCielo->{'dados-ec'}->chave;
	
	$requisicaoCieloTID->{'forma-pagamento'}->bandeira = $requisicaoCielo->{'forma-pagamento'}->bandeira;
	$requisicaoCieloTID->{'forma-pagamento'}->produto = $requisicaoCielo->{'forma-pagamento'}->produto;
	$requisicaoCieloTID->{'forma-pagamento'}->parcelas = $requisicaoCielo->{'forma-pagamento'}->parcelas;
			
	$useragent = 'WP e-Commerce plugin';
	curl_setopt($connection, CURLOPT_SSL_VERIFYPEER, 0); 
	curl_setopt($connection, CURLOPT_SSL_VERIFYHOST, 0); 
	curl_setopt($connection, CURLOPT_NOPROGRESS, 1); 
	curl_setopt($connection, CURLOPT_VERBOSE, 1); 
	curl_setopt($connection, CURLOPT_FOLLOWLOCATION,0); 
	curl_setopt($connection, CURLOPT_POST, 1); 
	curl_setopt($connection, CURLOPT_TIMEOUT, 30); 
	curl_setopt($connection, CURLOPT_USERAGENT, $useragent); 
	curl_setopt($connection, CURLOPT_REFERER, "https://".$_SERVER['SERVER_NAME']); 
	curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
	
	// Requisita o TID
	curl_setopt($connection, CURLOPT_POSTFIELDS, "mensagem=".$requisicaoCieloTID->asXML());	
	
	$respostaTID = new SimpleXMLElement(curl_exec($connection));
	
	if (strlen($respostaTID->tid) != 20)
		return false;
	
	$requisicaoCielo->tid = $respostaTID->tid;
	
	curl_close($connection);

	$autorizacaoCon = curl_init();

	curl_setopt($autorizacaoCon, CURLOPT_SSL_VERIFYPEER, 0); 
	curl_setopt($autorizacaoCon, CURLOPT_SSL_VERIFYHOST, 0); 
	curl_setopt($autorizacaoCon, CURLOPT_NOPROGRESS, 1); 
	curl_setopt($autorizacaoCon, CURLOPT_VERBOSE, 1); 
	curl_setopt($autorizacaoCon, CURLOPT_FOLLOWLOCATION,0); 
	curl_setopt($autorizacaoCon, CURLOPT_POST, 1); 
	curl_setopt($autorizacaoCon, CURLOPT_TIMEOUT, 30); 
	curl_setopt($autorizacaoCon, CURLOPT_USERAGENT, $useragent); 
	curl_setopt($autorizacaoCon, CURLOPT_REFERER, "https://".$_SERVER['SERVER_NAME']); 
	curl_setopt($autorizacaoCon, CURLOPT_RETURNTRANSFER, 1);
	
	curl_setopt($autorizacaoCon, CURLOPT_POSTFIELDS, "mensagem=".$requisicaoCielo->asXML());
	
	if ($opt['cielo_testmode'] == "1"){
		curl_setopt($autorizacaoCon,CURLOPT_URL,"https://qasecommerce.cielo.com.br/servicos/ecommwsec.do"); // Sandbox testing
//		exit('sandbox is true');
	}else{
		curl_setopt($autorizacaoCon,CURLOPT_URL,"https://ecommerce.cbmp.com.br/servicos/ecommwsec.do"); // Live
	}
	
	$autorizacaoCartao = curl_exec($autorizacaoCon);
	
	curl_close($autorizacaoCon);
	
	return new SimpleXMLElement($autorizacaoCartao);
}

function submit_cielo(){
 
	foreach (array( 'cielo_numeroafiliacao','cielo_chaveafiliacao','cielo_testmode' ) as $option_name) {

		if (isset($_POST[$option_name])) {
			$opt[$option_name] = htmlentities(html_entity_decode($_POST[$option_name]));
		}
	}			
		
	update_option('cielo-config', $opt);
		
    return true;
	
  return true;
}  

function form_cielo(){

	$opt  = get_option('cielo-config');
		
$output = '
<tr>
	<td>
		<label for="cielo_numeroafiliacao">Número de afiliação Cielo</label>
	</td>
	<td>
		<input type="text" name="cielo_numeroafiliacao" id="cielo_numeroafiliacao" value="'.$opt['cielo_numeroafiliacao'].'" size="30" />
	</td>
</tr>
<tr>
	<td>
		<label for="cielo_chaveafiliacao">Chave da afiliação</label>
	</td>
	<td>
		<input type="password" name="cielo_chaveafiliacao" id="cielo_chaveafiliacao" value="'.$opt['cielo_chaveafiliacao'].'" size="16" />
	</td>
</tr>
<tr>
	<td>
		<label for="paypal_pro_testmode">'.__('Test Mode Enabled:').'</label>
	</td>
	<td>
		<input type="hidden" name="cielo_testmode" value="0"><input type="checkbox" name="cielo_testmode" id="cielo_testmode" value="1" '.($opt['cielo_testmode']=='1' ? "checked" : "").' />					
	</td>
</tr>';
return $output;
}
?>
