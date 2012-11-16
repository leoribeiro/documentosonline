<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $users=array(
			// username => password
			'admin'=>'amanha eh um bel0 dia',
	);

	public function validaAdmin(){
		if(isset($this->users[$this->username])){
			if($this->users[$this->username]==$this->password){
				$this->errorCode=self::ERROR_NONE;
				$roles = array('admin');
				$this->setState('roles', $roles); 
				return true;	
			}
			else{
				$this->errorCode = self::ERROR_PASSWORD_INVALID;
			}	
		}
		return false;
	}

	public function getRules($servidor){
		$records = DResponsavelDocumento::model()->findAllByAttributes(array('Responsavel'=>$servidor->CDServidor));
				
		$id_ModelosDocumentos = array();

		foreach($records as $record){
			$id_ModelosDocumentos[] = $record->ModeloDocumento;
		}

		$criteria = new CDbCriteria();
		$criteria->addInCondition('CDModeloDocumento',$id_ModelosDocumentos);

		$modelosDocumentos = DModeloDocumento::model()->findAll($criteria);

		$rules = array();

		foreach ($modelosDocumentos as $modeloDocumento) {
			$rules[] = $modeloDocumento->NMSiglaDocumento;
		}

		return $rules;
	}

	public function authenticate()
	{
		$this->errorCode = self::ERROR_PASSWORD_INVALID;


		if(!$this->validaAdmin()){

			$controle = new ControleLogin();
			// Estabiliza uma conexão com o LDAP do CEFETMG
			$ds = $controle->conectaLDAP();

			if($ds){

				$boolServidor = $controle->autenticaLDAP($ds,'timoteo',
				$this->username,$this->password);


				// carrega a variável com o model do usuário
				$servidor = $controle->VerificaServidorBD($this->username);

				if($boolServidor && ($servidor != null)){

						$roles = $this->getRules($servidor);

						if(empty($roles)){
							$roles[] = 'visualizacao';
						}

						// setando as regras do usuario
						$this->setState('roles', $roles); 

						$this->setState('CDServidor', $servidor->CDServidor); 

						$this->errorCode = self::ERROR_NONE;
				}

			}
		}
		
		return !$this->errorCode;
	}
}