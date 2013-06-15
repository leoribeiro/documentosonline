<?php

class ConfigApp {

	public $host = "";
	public $usuario = "";
	public $password = "";
	public $basedados = "";
	public $passAdmin = "admin";
	public $ipServer = "";
	public $smtp = "";
	public $userSmtp = "";
	public $passSmtp = "";

	public function ConfigApp(){
		$dados = array();
		// primeira linha: host
		// segunda linha: usuario
		// terceira linha: senha
		// quarta linha: base de dados
		$handle = @fopen("/var/passdb.conf", "r");
		if ($handle) {
		    while (($buffer = fgets($handle, 4096)) !== false) {
		        $dados[] = chop($buffer);
		    }
		    if (!feof($handle)) {
		        echo "Error: unexpected fgets() fail\n";
		    }
		    fclose($handle);
		}
		if(!empty($dados)){
			$this->host = $dados[0];
			$this->usuario = $dados[1];
			$this->password = $dados[2];
			$this->basedados = $dados[3];
			$this->passAdmin = $dados[4];
			$this->ipServer = $dados[5];
			$this->smtp = $dados[6];
			$this->userSmtp = $dados[7];
			$this->passSmtp = $dados[8];
		}
	}
}

?>