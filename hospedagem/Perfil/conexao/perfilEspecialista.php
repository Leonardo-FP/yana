<?php

class database
	{
	private $pdo; 
	public $msgErro = "";
	public function conectar()
	{
		global $pdo;
		try{
			$pdo = new PDO("mysql:dbname="."heroku_d82daf3248dddee".";host="."us-cdbr-east-05.cleardb.net", "b29fb938e18320", "80c894a9");
		} catch (PDOException $e){
		 	$msgErro = $e->getMessage();
		} 
	}

	public function dados_especialista($email_Esp){
		global $pdo; 
		$sql = $pdo->prepare("SELECT * FROM `especialista` WHERE Email_Esp = :Email_Esp");
		$sql->bindValue(":Email_Esp", $email_Esp);
		$sql->execute();
		$lista = $sql->fetch();
		if($sql->rowCount() > 0){		
				return $lista;
		}else{
			return false;
		}
	}
}
?>
