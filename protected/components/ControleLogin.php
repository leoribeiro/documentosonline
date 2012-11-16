<?php

class ControleLogin {

	private $ipServerNTI = "200.131.39.111";
	private $ipServer;

	function ControleLogin(){
		$this->ipServer = gethostbyname($_SERVER['SERVER_NAME']);
	}


	public function conectaLDAP(){
		

		// ssh -L 1389:200.131.39.111:389 nti@200.131.39.111

		// LDAP configurações
		if($this->ipServer == $this->ipServerNTI){
			$serverURL = "ldap1.dri.cefetmg.br";
			$ds=ldap_connect($serverURL);
		}
		else{
			$serverURL = "localhost";
			$ds=ldap_connect($serverURL,1389);	
		}
		
		$ds=ldap_connect($serverURL);
		ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
		ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
		
		return $ds;
	}
	
	// retorna true se autenticar
	// retorna false se não autenticar
	public function autenticaLDAP($ds,$ou,$username,$password){

		if($this->ipServer != $this->ipServerNTI){
			return true;
		}

		if (@$ds) {
		   $dn = "uid=".$username.",ou=people,ou=".$ou.",dc=cefetmg,dc=br";
		   $dnAlunoG = "uid=".$username.",ou=people,ou=graduacao,
		   ou=".$ou.",dc=cefetmg,dc=br";
		   $dnAlunoT = "uid=".$username.",ou=people,ou=mediotecnico,
		   ou=".$ou.",dc=cefetmg,dc=br";
			if (!($r = @ldap_bind($ds,$dn,$password)) and
			!($r = @ldap_bind($ds,$dnAlunoG,$password)) 
			and !($r = @ldap_bind($ds,$dnAlunoT,$password))) {
		      return false;
		   }
			return true;
		}
		return false;
		   			  
	}
	
	public function VerificaDadosLDAPAluno($username,$tipoAluno){
		
		  $ds = $this->conectaLDAP();
		  $ou = "aluno";
		  $dn = "uid=".$username.",ou=people,ou=".$tipoAluno.",
		  ou=".$ou.",dc=cefetmg,dc=br";
		  $filter="(objectclass=*)";
		  $justthese = array("ou", "sn", "givenname", "mail"); 
		  $sr=@ldap_read($ds, $dn, $filter);
		  if(!$sr){
			return false;
	      }
	
		  $entry = @ldap_get_entries($ds, $sr);
		   
		  $nomecompleto = $entry[0]["cn"][0];
		  $email = $entry[0]["gosamailforwardingaddress"][0];
		  $this->modelAluno = array();
		  $this->modelAluno[] = $username;
		  $this->modelAluno[] = $nomecompleto;
		  $this->modelAluno[] = $email;
		  $this->modelAluno[] = $this->password;
		  if($tipoAluno == "graduacao"){
			$this->modelAluno[] = "alunoGraduacao";
		  }
		  else if($tipoAluno == "mediotecnico"){
			$this->modelAluno[] = "alunoTecnico";
		  }
		 
		  return true;
	
	}
	
	public function VerificaServidorBD($username){
		
	  	  $criteria = new CDbCriteria;
		  $criteria->compare('LoginServidor',$username);
		  $dadosServidor = Servidor::model()->find($criteria);
		  return $dadosServidor;
		
	}
	
	public function VerificaServidorReq($username){
		
	  	  $criteria = new CDbCriteria;
		  $criteria->compare('LoginServidor',$username);
		  $dadosServidor = Servidor::model()->find($criteria);
		
		  if(!is_null($dadosServidor)){
			  $criteria = new CDbCriteria;
			  $criteria->compare('Servidor_CDServidor',$dadosServidor->CDServidor);
			  $dadosServidorReq = SS_ModeloRequerimentoServidor::model()->find($criteria);

			  if(!is_null($dadosServidorReq)){
				return true;
			  }
		  }		

		  return false;		
	}
	
	public function VerificaAlunoBD($username){
		
	  	  $criteria = new CDbCriteria;
		  $criteria->compare('NumMatricula',$username);
		  $dadosAluno = Aluno::model()->find($criteria);
		  return $dadosAluno;
		
	}
	
	public function VerificaProfessorBD($username){
		
		  $criteria = new CDbCriteria;
		  $criteria->with = array('relServidor');
		  $criteria->together = true;
		  $criteria->compare('relServidor.LoginServidor',$username);
		  $dadosusuario = Professor::model()->find($criteria);
		  return $dadosusuario;
		
	}
	
	public function ValidaServidor($username,$password){

		$model = $this->VerificaServidorBD($username);
		if(!is_null($model)){
			$this->VerificarSenhaServidorExiste($username,$password);
			return true;
		}	
		return false;		
	}
	
	public function ValidaProfessor($username,$password){

		$model = $this->VerificaProfessorBD($username);
		if(!is_null($model)){
			$this->VerificarSenhaServidorExiste($username,$password);
			return true;
		}	
		return false;		
	}
	
	
	public function ValidaAluno($username,$password){

		$this->VerificarSenhaAlunoExiste($username,$password);
		$model = $this->VerificaAlunoBD($username);
		if(!is_null($model)){
			return true;
		}		
		return false;		
	}
	

	
	// Método que verifica se a senha do usuário está cadastrado
	// no Banco de Dados local (uma cópia de alguns dados do LDAP de BH)
	// Se não estiver cadastrado, a senha do usuário é armazenada.
	public function VerificarSenhaServidorExiste($loginLDAP,$password){
	    $criteria = new CDbCriteria;
		$criteria->compare('LoginServidor',$loginLDAP);
		$modelServidor = Servidor::model()->find($criteria);
		
		if(!is_null($modelServidor)){
			$criteria = new CDbCriteria;
			$criteria->compare('Servidor_CDServidor',$modelServidor->CDServidor);
			$modelSenhaServidor = SenhaServidor::model()->find($criteria);
	
			if(is_null($modelSenhaServidor)){
	
				$modelSenhaServidor = new SenhaServidor;
				$modelSenhaServidor->Servidor_CDServidor = $modelServidor->CDServidor;
				$modelSenhaServidor->Senha = crypt($password, Randomness::blowfishSalt());
				$modelSenhaServidor->save();
				
			}
		}		
	}
	
	
	// Método que verifica se a senha do aluno está cadastrado
	// no Banco de Dados local (uma cópia de alguns dados do LDAP de BH)
	// Se não estiver cadastrado, a senha do usuário é armazenada.
	public function VerificarSenhaAlunoExiste($loginLDAP,$password){
	    $criteria = new CDbCriteria;
		$criteria->compare('NumMatricula',$loginLDAP);
		$modelAluno = Aluno::model()->find($criteria);
		
		if(!is_null($modelAluno)){
			$criteria = new CDbCriteria;
			$criteria->compare('Aluno_CDAluno',$modelAluno->CDAluno);
			$modelSenhaAluno = SenhaAluno::model()->find($criteria);
	
			if(is_null($modelSenhaAluno)){
	
				$modelSenhaAluno = new SenhaAluno;
				$modelSenhaAluno->Aluno_CDAluno = $modelAluno->CDAluno;
				$modelSenhaAluno->Senha = crypt($password, Randomness::blowfishSalt());
				$modelSenhaAluno->save();
				
			}
		}		
	}
	
	// 
	// // Se o link com o servidor LDAP cair
	// // é possível autenticar no sistema
	// // se o usuário tiver logado ao menos uma vez
	// // antes do LDAP cair
	public function AutenticaServidorBD($username,$password){
		
		$criteria = new CDbCriteria;
		$criteria->compare('LoginServidor',$username);
		$modelServidor = Servidor::model()->find($criteria);
	
		if(!is_null($modelServidor)){
			$criteria = new CDbCriteria;
			$criteria->compare('Servidor_CDServidor',$modelServidor->CDServidor);
			$modelSenhaServidor = SenhaServidor::model()->find($criteria);
			if(crypt($password, $modelSenhaServidor->Senha) !== $modelSenhaServidor->Senha){
				return false;
			}
			return true;
		}
		return false;
	}


}