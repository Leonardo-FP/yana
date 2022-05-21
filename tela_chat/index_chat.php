<?php
	require_once('../Tela_cadastro_YANA/login/verifica_login.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>

	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="script.js"></script>
	<link rel="shortcut icon" href="icone.ico" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="style.css" />
	<title>Chat</title>

	<!-- Bootstrap e Jquery -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

	<script src="/socket.io/socket.io.js"></script>


</head>
<body >
	<img  src="icone.png" alt="">



	<!-- Telas -->
	<div id="tela">

		<div id="status"></div>

		<li id="mensagens" ></li>
	</div>
	


    
	
	<!-- Teclado -->
	<form id="form"  method="POST" enctype="multipart/form-data">
		<div class="col-lg-12">
			<div class="input-group">
				<input required type="text" name="mensagem" id="msg" autofocus autocomplete="off" placeholder="Digite sua mensagem" class="form-control" />
				<span class="input-group-btn">
					<input type="submit" value="&rang;&rang;" class="btn btn-success">
					<input type="hidden" name="env" value="envMsg"/>
				</span>
			</div>
		</div>



		
		<script>
			$(function () {
				const socket = io()
				socket.nickname = $_SESSION['nome'];

				
					
				/* Envio das msgs do front-end para servidor  */
				$('form').submit(function(evt){
					if(socket.nickname === $_SESSION['nome']){

						// socket.nickname = prompt('Digite o seu usuario').toUpperCase()
						// socket.emit('login', socket.nickname)


						$('#msg').keypress(function (evt) {
							socket.emit('status',`${socket.nickname} está digitando...`)
						})


						$('#msg').keyup(function (evt){
							setTimeout(function(){socket.emit('status','')},1500)
							
							
						})

						socket.on('status', function(msg) {
							$('#status').html(msg)
						})

					}else {
						socket.emit('chat msg', $('#msg').val())
					}



					$('#msg').val('')
					return false
				})


				socket.on('chat msg',function (msg) {
					$('#mensagens').append($('<li>').text(msg))
					scrollToBottom()
				})

				
				
				

			})



			/* auto scroll */
			function scrollToBottom(){

    			let mensagens = document.getElementById('mensagens').lastElementChild;
   				mensagens.scrollIntoView();
			}

			

		</script>

</body>
</html>