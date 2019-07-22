<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="bootstrap-4.3.1-dist/js/bootstrap-dynamic-tabs.css"></script>

  <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script type="text/javascript" src="bootstrap-4.3.1-dist/js/bootstrap.js"></script>
  <script type="text/javascript" src="bootstrap-4.3.1-dist/js/bootstrap-dynamic-tabs.js"></script>  
</head>
<body>

<div class="container mt-3">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<button id="btnHtml" class="btn btn-info">Aba com HTML</button>
				<button id="btnAjax" class="btn btn-primary">Aba com AJAX</button>
				<button id="btnIon" class="btn btn-danger">Aba com ícone <i class="fa fa-user"></i></button>
			</div>
		</div>
		<div class="tab-content" id="tabs">
		</div>
	</div>
  <br>

  <!-- Tab panes -->
  <div class="tab-content" id="tabs">
  </div>
</div>

</body>

<script type="text/javascript">
var d = new Date();
var n = d.getTime();
var tabs = $('#tabs').bootstrapDynamicTabs().addTab({
	title:'Home ',
	text:'Plugin jQuery para manipular tabs do bootstrap de forma dinâmica, excelente para aplicações multitelas na WEB ou em runtimes como node-webkit ou electron.',
	 
	closable: false
});


 
$('#btnHtml').click(function(){
	var d = new Date();
    var n = d.getTime();
	tabs.addTab({
		title: 'Aba com HTML. ' + n,
		html: '<h2>Desenvolvido por <a href="//jayralencar.com.br">Jayr Alencar</a></h2>' + n + '<iframe src="VerCli.php"></iframe>',
		id: 'aba' + n
	})
});
$('#btnAjax').click(function(){
	tabs.addTab({
		title: 'Carregando via Ajax. ',
		html: '<h2>Desenvolvido por AJAX',
		ajaxUrl: 'VerCli.php', 
		id: 'ajax'   
	});
});
$('#btnIon').click(function(){
	tabs.addTab({
		title: 'Aba com ícone. ',
		html: '<h2>Aba com ícone</h2>Um icone Font Awesome, exemplo: fa fa-user. O icone será mostrado na aba. Você também pode usar os glyphicon do Bootstrap </code>',
		icon: 'fa fa-user'
	})
})
</script>

</html>
