<?php
/**
 * pagseguro 
 * 
 * @package 
 * @version 1.0
 * @author DGmike <http://dgmike.com.br> 
 */
class correios
{
    public $internal_name = 'correios';
    public $name          = 'Frete pelos Correios';
    public $is_external   = true;
    public $needs_zipcode = true;

    public function getName()
    {
        return $this->name;
    }

    public function getInternalName()
    {
        return $this->internal_name;
    }

    public function getForm () 
    {
        $shipping = get_option('pagseguro_shipping_configs');
        if (!is_array($shipping)) {
            $shipping = array();
        }
        extract($shipping+array('cep' => '','valor_fixo' => '', 'meio' => array('Sedex'=>'0', 'PAC'=> '0')));
        $checked_sedex = $meio['Sedex'] == '1' ? ' checked="checked" ' : '';
        $checked_pac = $meio['PAC'] == '1' ? ' checked="checked" ' : '';
        return <<<EOF
<tr><td>
<p>
    <label>
        <span>Informe seu CEP (XXXXX-XXX): </span><br />
        <input type="text" name="shipping[cep]" value="$cep" />
    </label><br />
    <label>
        <span>Caso o módulo não consiga encontrar o CEP da pessoa, informe um valor fixo para o frete (por item):</span><br />
        <input type="text" name="shipping[valor_fixo]" value="$valor_fixo" />
    </label><br />
    <input type="hidden" name="shipping[meio][Sedex]" value="0" />
    <input type="hidden" name="shipping[meio][PAC]" value="0" />
    <label> Mostrar estes meios de envio (escolha pelo menos um): </label><br />
    <label><input type="checkbox" name="shipping[meio][Sedex]" value="1" $checked_sedex /> Sedex</label><br />
    <label><input type="checkbox" name="shipping[meio][PAC]" value="1" $checked_pac /> PAC</label>
</p>

<h4>Como configurar?</h4>

<p>Entre no site do <a href="https://pagseguro.uol.com.br" target="_blank">PagSeguro</a> e entre com seu usuário e senha.</>

<p>Entre no menu <strong>Meus Dados</strong> e acesse, em <strong>Configuração de Checkout</strong>, a opção <strong>Preferências Web e frete</strong>.</p>

<p>Na <strong>Definição de Cálculo do frete</strong> deixe a opção <strong>Fete fixo com desconto</strong> marcada, e configure o <strong>Valor do frete para itens extra</strong> definido como <strong>0,00</strong> conforme a figura.</p>

<div style="border:1px solid #CCC;padding:10px;background:#FDFDFD;">
    <a href="../wp-content/plugins/wp-e-commerce/shipping/pagseguro-frete.png" title="Clique e veja ampliado" target="_blank">
        <img src="../wp-content/plugins/wp-e-commerce/shipping/pagseguro-frete.png" width="100%" />
    </a>
    <p><em>Tela que você encontrará no PagSeguro</em></p>
</div>
</td></tr>

EOF;
    }

    public function submit_form() 
    {
        if(isset($_POST['shipping'])) {
            $shipping  = (array)get_option('pagseguro_shipping_configs');
            $submitted = (array)$_POST['shipping'];
            $values = array_merge($shipping, $submitted);
            $values = array_intersect_key($values, array('cep' => true, 'valor_fixo' => true, 'meio' => array('Sedex' => '0', 'PAC' => '0')));
            update_option('pagseguro_shipping_configs', $values);
        }
        return true;
	}

    public function getQuote( $for_display = false )
    {
        require_once(dirname(__FILE__).'/pagseguro/frete.php');
        global $wpdb, $wpsc_cart;
        $zipcode = '';                
        if(isset($_POST['zipcode'])) {
            $zipcode = $_POST['zipcode'];      
            $_SESSION['wpsc_zipcode'] = $_POST['zipcode'];            
        } else if(isset($_SESSION['wpsc_zipcode'])) {
            $zipcode = $_SESSION['wpsc_zipcode'];
        }               
        if (!$zipcode || $zipcode == "Seu CEP") { // Este meio de fretamento só funcionará se tiver ZipCode
            return null;
            $zipcode = '00000-000';
        }
        $shipping = get_option('pagseguro_shipping_configs');
        if (!is_array($shipping)) {
            $shipping = array();
        }
            
        //extract($shipping+array('cep' => '','valor_fixo' => '', 'meio' => array('Sedex'=>'0', 'PAC'=> '0')));
        extract($shipping);
        // Calculando o valor e o peso total
        $total = 0;
        $preco = 0;
        foreach ((array)$wpsc_cart->cart_items as $item) {
            $preco += $item->total_price;
            $total += $this->converteValor($item->weight, 'gram')*$item->quantity;
        }
        $frete = new PgsFrete();
        $total = number_format($total/1000, 2, '.', '');
        $preco = number_format($preco, 2, ',', '');
        $zipcode = preg_replace('@\D@', '', $zipcode);
        $zipcode = substr($zipcode, 0, 5).'-'.substr($zipcode, 5);
        $oFrete = $frete->gerar($cep, $total, $preco, $zipcode);
        
        if (!$oFrete OR $oFrete == array('' => NULL,)) {
            $oFrete = array(
                'Sedex' => $valor_fixo * $total,
                'PAC'   => $valor_fixo * $total,
            );
        }
        
        $meio = $oFrete[0];
        
        if ($meio['Sedex'] == '0') {
            unset($oFrete['Sedex']);
        }
        if ($meio['PAC'] == '0') {
            unset($oFrete['PAC']);
        }
        return $meio;
    }

    public function converteValor($weight, $unit)
    {
		switch($unit) {
			case "kilogram":
			$weight = $weight * 0.45359237;
			break;
			
			case "gram":
			$weight = $weight * 453.59237;
			break;
		
			case "once":
			case "ounces":
			$weight = $weight * 16;
			break;
			
			default:
			$weight = $weight;
			break;
		}
        return $weight;
    }
}

$correios = new correios();
$wpsc_shipping_modules[$correios->getInternalName()] = $correios;
