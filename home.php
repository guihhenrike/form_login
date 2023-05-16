<?php
  session_start();
  include_once("templates/header.php");
  //include_once("config/processa.php");

  if(!isset($_SESSION['id']))
  {
    header("location: index.php");
    exit;
  }

?>

<div id="success-message" class="alert alert-success" role="alert">
  <h2> <?= print_r($_POST['email']); ?> <h2/>
</div>

<script>
  $(document).ready(function() {
  // Define a duração da mensagem em milissegundos
  var duration = 4000;
  
  // Define uma função para esconder a mensagem após a duração definida
  function hideMessage() {
    $('#success-message').fadeOut('slow');
  }
  
  // Mostra a mensagem
  $('#success-message').show();
  
  // Define um temporizador para esconder a mensagem
  setTimeout(hideMessage, duration);
});
</script>