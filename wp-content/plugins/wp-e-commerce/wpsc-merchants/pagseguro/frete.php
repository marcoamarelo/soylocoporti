<?php

class PgsFrete
{
    private $_use     = 'curl';
    private $_debug   = false;
    private $_methods = array('curl');
    private $_result;

    public function PgsFrete()
    {
        if ($this->debug()) {
            echo "\nPgsFrete started!";
        }
    }

    public function debug($debug=null)
    {
        if (null===$debug) {
            return $this->_debug;
        }
        $this->_debug = (bool) $debug;
    }

    public function setUse($useMethod)
    {
        if ('string'!==gettype($useMethod)) {
            throw new Exception('Method for setUse not allowed.'.
              'Method passed: '.var_export($useMethod, true));
        }
        $useMethod = strtolower($useMethod);
        if (!in_array($useMethod, $this->_methods)) {
            throw new Exception('Method for setUse not allowed.'.
              'Method passed: '.var_export($useMethod, true));
        }
        $this->_use = $useMethod;
        if ($this->debug()) {
            echo "\nMethod changed to ".strtoupper($useMethod);
        }
    }

    public function getUse()
    {
        return $this->_use;
    }

    public function request($url, $post=null)
    {
        $method = $this->getUse();
        if (in_array($method, $this->_methods)) {
            $method_name = '_request'.ucWords($method);
            if (!method_exists($this, $method_name)) {
              throw new Exception("Method $method_name does not exists.");
            }
            if ($this->debug()) {
                echo "\nTrying to get '$url' using ".strtoupper($method);
            }
            return call_user_func(array($this, $method_name), $url, $post);
        } else {
            throw new Exception('Method not seted.');
        }
    }

    private function _requestCurl($url, $post=null)
    {
        $urlkey="URL:".md5("$url POST:$post");
        if(isset($_SESSION[$urlkey])){
          $this->_result = $_SESSION[$urlkey];
          return;
        }
        $parse = parse_url($url);
        $ch    = curl_init();
        if ('https'===$parse['scheme']) {
            // Nao verificar certificado
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
        }
        curl_setopt($ch, CURLOPT_URL, $url); // Retornar o resultado
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Retornar o resultado
        if ($post) {
            curl_setopt($ch, CURLOPT_POST, true); // Ativa o modo POST
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post); // Insere os POSTs
        }
        $result = curl_exec($ch);
        curl_close($ch);
        $this->_result = $result;
        $_SESSION[$urlkey]=$result;
    }

    public function gerar($CepOrigem, $Peso, $Valor, $Destino)
    {
        $Peso=str_replace('.',',',$Peso);
        $url = "https://pagseguro.uol.com.br/desenvolvedor/simulador_de_frete_calcular.jhtml?postalCodeFrom={$CepOrigem}&weight={$Peso}&value={$Valor}&postalCodeTo={$Destino}";
        $this->request($url);
        $result = split('\|',$this->_result);
        $valores=array();
        if($result[0]=='ok'){
          $valores['Sedex']=$result[3];
          $valores['PAC']=$result[4];
        }
        return $valores;
    }
}
