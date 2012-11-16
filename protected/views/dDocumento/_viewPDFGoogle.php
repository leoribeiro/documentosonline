<div align="center">


<?php

    $ipServerNTI = "200.131.39.111";
	$ipServer = gethostbyname($_SERVER['SERVER_NAME']);
	if($ipServer == $ipServerNTI){
		$tempoArq = Yii::app()->session['tempoArq'];
		$urlServer = "http://sistemas.timoteo.cefetmg.br";
		$nomeArquivo = $urlServer.Yii::app()->baseUrl."/pdfs/".$tempoArq.".pdf";
		?>
		<iframe src="http://docs.google.com/gview?url=<?php echo $nomeArquivo; ?>&embedded=true" style="width:80%; height:500px;" frameborder="0" ></iframe>

		<?php
		}
		else{
		?>
		<iframe src="http://docs.google.com/gview?url=http://sistemas.timoteo.cefetmg.br/teste6.pdf&embedded=true" style="width:80%; height:500px;" frameborder="0" ></iframe>
		<?php	
		}
?>

</div>