<?php
$_GET["sessionid"] = $_GET["sessionid"]=="" ? $_SESSION["pagseguro_id"] : $_GET["sessionid"];
require_once("pagseguro/pgs.php");
require_once("pagseguro/tratadados.php");

$nzshpcrt_gateways[$num]['name'] = 'UOL PagSeguro - Diversas formas de pagamento';
$nzshpcrt_gateways[$num]['admin_name'] = 'PagSeguro';
$nzshpcrt_gateways[$num]['internalname'] = 'pagseguro';
$nzshpcrt_gateways[$num]['function'] = 'gateway_pagseguro';
$nzshpcrt_gateways[$num]['form'] = "form_pagseguro";
$nzshpcrt_gateways[$num]['submit_function'] = "submit_pagseguro";

if( get_option('transact_url')=="http://".$_SERVER["SERVER_NAME"].$_SERVER["REDIRECT_URL"]){ transact_url();}

function gateway_pagseguro($seperator, $sessionid) 
{
    global $wpdb;
    // Carregando os dados
     
    $cart = unserialize($_SESSION['nzshpcrt_serialized_cart']);
    
    $options = array(
        'email_cobranca' => get_option('pagseguro_email'),
        'ref_transacao'  => $_SESSION['order_id'],
        'encoding'       => 'utf-8',
        //'item_frete_1'   => number_format(($cart->total_tax + $cart->base_shipping) * 100, 0, '', ''),
        'item_frete_1'	 => $_SESSION['quote_shipping']
    );
    // Dados do cliente
    $_cliente = $_POST["collected_data"];
    list($ddd,$telefone)   = trataTelefone($_cliente[17]);
    list($end,$num,$compl) = trataEndereco($_cliente[4]);
    $cliente = array (
        'nome'   => $_POST["collected_data"][2] . " " . $_cliente[3],
        'cep'    => preg_replace("/[^0-9]/","", $_cliente[7]),
        'end'    => $end,
        'num'    => $num,
        'compl'  => $compl,
        'bairro' => '',
        'cidade' => '',
        'uf'     => '',
        'pais'   => 'Brasil',
        'ddd'    => $ddd,
        'tel'    => $telefone,
        'email'  => $_cliente[8]
    );
    // Usando a session, isso é correto
    //$cart = $cart->cart_items;
    
    $produtos = array();  
  
    foreach($cart as $item) {
    	
    	$produto = $wpdb->get_row('SELECT name,price,weight FROM '.$wpdb->prefix.'product_list WHERE id='.$item->product_id,ARRAY_A,0);
    	
    	$anexo_descricao = "";
    	
		foreach ($item->product_variations as $var_id => $val_id )
		{
    		
    		$variacao_descricao = $wpdb->get_row('SELECT var.name as variacao,val.name as descricao FROM  '.$wpdb->prefix.'product_variations var inner join '.$wpdb->prefix.'variation_values val on (val.variation_id=var.id) where var.id='.$var_id.' AND val.id='.$val_id, ARRAY_A, 0);
			
    		$anexo_descricao .= " - ".$variacao_descricao['variacao'].": ".$variacao_descricao['descricao'];
		}
    	    	
        $produtos[] = array(
            "id"         => (string) "SOYLOCO_PRODUTO_".$item->product_id,
            "descricao"  => $produto['name'].$anexo_descricao,
            "quantidade" => $item->quantity,
            "valor"      => $produto['price'],
        	"peso"		 => $produto['weight']        	
        );
    }   
    
    $PGS = New pgs($options);
    $PGS->cliente($cliente);	
    $PGS->adicionar($produtos);
    $mostra = array(
        "btn_submit"  => 0,
        "print"       => false, 
        "open_form"   => false,
        "show_submit" => false
    );

    $form = $PGS->mostra($mostra);

    $_SESSION["pagseguro_id"] = $sessionid;
    echo '<form id="form_pagseguro" action="https://pagseguro.uol.com.br/security/webpagamentos/webpagto.aspx" method="post">',
        $form,
        '<script>window.onload=function(){form_pagseguro.submit();}</script>';
    exit();
}

function transact_url()
{
    if(!function_exists("retorno_automatico")) {
        define ('TOKEN', get_option("pagseguro_token"));
        function retorno_automatico (
            $VendedorEmail, $TransacaoID, $Referencia, $TipoFrete,
            $ValorFrete, $Anotacao, $DataTransacao, $TipoPagamento,
            $StatusTransacao, $CliNome, $CliEmail, $CliEndereco,
            $CliNumero, $CliComplemento, $CliBairro, $CliCidade,
            $CliEstado, $CliCEP, $CliTelefone, $produtos, $NumItens
        )
        {
            global $wpdb;
            switch($StatusTransacao) {
            case "Completo":case "Aprovado":
                $sql = "UPDATE `".$wpdb->prefix . "purchase_logs` SET `processed` = '2' WHERE id=" . $Referencia;
                $wpdb->query($sql);  
            case "Cancelado":
                break;
            }
        }
        require_once("pagseguro/retorno.php");
    }
}

function submit_pagseguro() 
{
    if($_POST['pagseguro_email'] != null) {
        update_option('pagseguro_email', $_POST['pagseguro_email']);
    }
    if($_POST['pagseguro_token'] != null) {
        update_option('pagseguro_token', $_POST['pagseguro_token']);
    }
    return true;
}

function form_pagseguro() 
{
    $output = "<tr>\n\r";
    $output .= "<tr>\n\r";
    $output .= "	<td colspan='2'>\n\r";

    $output .= "<strong>".TXT_WPSC_PAYMENT_INSTRUCTIONS_DESCR.":</strong><br />\n\r";
    $output .= "Email vendedor <input type=\"text\" name=\"pagseguro_email\" value=\"" . get_option('pagseguro_email') . "\"/><br/>\n\r";
    $output .= "TOKEN <input type=\"text\" name=\"pagseguro_token\" value=\"" . get_option('pagseguro_token') . "\"/><br/>\n\r";
    $output .= "<em>".TXT_WPSC_PAYMENT_INSTRUCTIONS_BELOW_DESCR."</em>\n\r";
    $output .= "	</td>\n\r";
    $output .= "</tr>\n\r";
    return $output;
}
