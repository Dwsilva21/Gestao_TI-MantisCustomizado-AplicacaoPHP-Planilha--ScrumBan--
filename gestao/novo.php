<?
ini_set('default_charset','iso-8859-1');
session_start(); 
if (  $_SESSION["pin"] <> 1980 ) { header ( 'Location: UnionMnuVert.php' );  }

$id = $_REQUEST["id"];
$ordem = $_REQUEST["ord"];
if ($ordem == "" ) { 
    $ordem = "1 desc";
};
?>

<html>
<head>
<title>Erros dos Clientes</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
</head>

<body>


<div class="w3-container">

   <a href="VerAtendimento.php">
   <div class="w3-padding w3-large w3-text-black">
       <i class="material-icons w3-xlarge" title="Voltar">home</i>
   </div>
   </a>
  
   <table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-hoverable">
     <tr class="w3-light-grey">
       <td colspan="6" align="center"><font size="3" face="Verdana" color="#2499F6"><b><em>[ Chamado ] <? echo $id ?></em></b></font></td>
     </tr>
   </table>

   <br> 

   <div ng-app="myApp">


       <div class="w3-container w3-tiny w3-text-green" ng-controller="Chamado">

          <div class="w3-third w3-row-padding" ng-repeat="x in names">
               <label><b>Cliente</b></label>
               <input class="w3-input w3-border w3-light-gray" name="cliente" type="text" disabled value="{{ x.razao }}">
          </div>	
          <div class="w3-third w3-row-padding" ng-repeat="x in names">	
              <label><b>Motivo</b></label>
              <input class="w3-input w3-border w3-light-gray" name="motivo" type="text" disabled value="{{ x.motivo }}">
          </div>	
          <div class="w3-third w3-row-padding" ng-repeat="x in names">	
              <label><b>Sistema</b></label>
              <input class="w3-input w3-border w3-light-gray" name="sistema" type="text" disabled value="{{ x.sistema }}">
          </div>	
          <div class="w3-half w3-row-padding" ng-repeat="x in names">
              <label><b>Descrição</b></label>
              <input class="w3-input w3-border w3-light-gray" name="cliente" type="text" disabled value="{{ x.descricao }}">
          </div>	
          <div class="w3-half w3-row-padding" ng-repeat="x in names">	
              <label><b>Programa</b></label>
              <input class="w3-input w3-border w3-light-gray" name="motivo" type="text" disabled value="{{ x.programa }}">
          </div>	
          <div class="w3-third w3-row-padding" ng-repeat="x in names">
              <label><b>Data</b></label>
              <input class="w3-input w3-border w3-light-gray" name="cliente" type="text" disabled value="{{ x.datahora_cadastro }}">
          </div>	
          <div class="w3-third w3-row-padding" ng-repeat="x in names">	
              <label><b>Contato</b></label>
              <input class="w3-input w3-border w3-light-gray" name="motivo" type="text" disabled value="{{ x.nome_contato }}">
          </div>	
          <div class="w3-third w3-row-padding" ng-repeat="x in names">	
              <label><b>Telefone</b></label>
              <input class="w3-input w3-border w3-light-gray" name="telefone" type="text" disabled value="{{ x.fone_contato }}">
          </div>	
          <div class="w3-third w3-row-padding" ng-repeat="x in names">	
              <label><b>Analista</b></label>
              <input class="w3-input w3-border w3-light-gray" name="analista" type="text" disabled value="{{ x.analista }}">
          </div>	
          <div class="w3-third w3-row-padding" ng-repeat="x in names">	
              <label><b>Email</b></label>
              <input class="w3-input w3-border w3-light-gray" name="email" type="text" disabled value="{{ x.email_contato }}">
          </div>	

          <div class="w3-third w3-row-padding" ng-repeat="x in names">	
              <label><b>MANTIS</b></label>
              <input class="w3-input w3-border" name="manid" type="button" style="background:{{ x.color }}"  title="{{ x.labelBR }}" value="{{ x.mantis }}  v.{{ x.verexe }}" onclick="abrir()" > 
          </div>	



	
       </div>

       <br>
       <br>

       <div class="w3-container w3-small w3-text-green" >
          <br><button class="w3-button w3-left w3-red" style="width:250px;" onclick="document.getElementById('id01').style.display='block'">Incluir Anotação <i class="glyphicon glyphicon-user"></i></button><br><br>
       </div>

  
       <div id="id01" class="w3-modal">
          <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:800px">
  
             <div class="w3-center"><br>
                  <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-transparent w3-display-topright" title="Close Modal">X</span>
             </div>
             <br>

             <form class="w3-container " action="data/dados_INS_anotacao.php" name="anotacao" method="POST">
                 <table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-hoverable">
                    <tr class="w3-pale-yellow">
                       <td colspan="6" align="center"><font size="3" face="Verdana" color="#2499F6"><b><em>[ Nova Anotacão ]</em></b></font></td>
                    </tr>

                    <tr class="w3-tiny w3-text-green w3-pale-blue">
					  <td colspan="6" align="center">
                        <input name="digid" type="hidden" value="<? echo $id ?>">
                        <input ng-repeat="x in names" name="digana" type="hidden" value="{{ x.analista }}">
                        <input ng-repeat="x in names" name="digman" type="hidden" value="{{ x.mantis }}">
                        <div class="w3-third w3-row-padding"  >
                            <label><b>Descrição</b></label>
                            <textarea rows="4" cols="50" class="w3-input w3-border " name="digdes"></textarea>
                        </div>	
                        <div class="w3-third w3-row-padding"  >	
                            <label><b>Motivo</b></label>
                            <select class="w3-select" name="digmot">
                            <option value="" disabled selected>Escolha sua opção</option>
                            <option value="Cliente ausente/impossibilitado">Cliente ausente/impossibilitado</option>
                            <option value="Correção prevista">Correção prevista</option>
                            <option value="Falha de operação/Dúvida sanada">Falha de operação/Dúvida sanada</option>
                            <option value="Falha do sistema corrigida">Falha do sistema corrigida</option>
                            <option value="Outro">Outro</option>
                            </select>
                        </div>	

                        <div class="w3-third w3-row-padding"  >	
                            <label><b>Status</b></label>
                            <select class="w3-select" name="digsta">
                            <option value="" disabled selected>Escolha sua opção</option>
                            <option value="AGUARDANDO APROVAÇÃO">AGUARDANDO APROVAÇÃO</option>
                            <option value="AGUARDANDO CLIENTE">AGUARDANDO CLIENTE</option>
                            <option value="AGUARDANDO DEFINIÇÃO">AGUARDANDO DEFINIÇÃO</option>
                            <option value="AGUARDANDO FORNECEDOR">AGUARDANDO FORNECEDOR</option>
                            <option value="AGUARDANDO USUÁRIO">AGUARDANDO USUÁRIO</option>
                            <option value="EM ANDAMENTO">EM ANDAMENTO</option>
                            <option value="EM DESENVOLVIMENTO">EM DESENVOLVIMENTO</option>
                            <option value="EM TESTE">EM TESTE</option>
                            <option value="FINALIZADO">FINALIZADO</option>
                            </select>
                        </div>	
 
 
                        <div class="w3-third w3-row-padding"  >
                            <label><b>Tempo [HH:MM]</b></label>
                            <input class="w3-input w3-border " name="dighor" type="text" value="00:00" style="width:30%" maxlength="05">
                        </div>	
 
                        <div class="w3-third w3-row-padding"  >
                             <label><b>Enviar anotação por EMAIL para o contato ? </b></label>
                             <select class="w3-select" name="digenv">
                             <option value="" disabled selected>Escolha sua opção</option>
                             <option value="S">Sim</option>
                             <option value="N">Não</option>
                             </select>
                        </div>	

                      </td>
					</tr>


                    <tr class="w3-tiny w3-text-green w3-pale-blue">
					   <td colspan="6" align="center">

                           <div class="w3-third w3-row-padding"  >
                              <input class="w3-input w3-border w3-light-gray w3-round-xxlarge" type="button" style="width:30%" value="Gravar" onclick="gravar()">
                           </div>	
                           <div class="w3-third w3-row-padding"  >	
                              <input class="w3-input w3-border w3-light-gray w3-round-xxlarge" type="button" style="width:30%" value="Limpar" onclick="limpar()">
                           </div>	
                       </td>
					</tr>
 
                 </table>
             </form>
          <br>
          </div>
	   </div>

       <br>

       <div class="w3-container w3-tiny w3-text-green" ng-controller="Anotacoes">
         <table border="0" width="100%" cellspacing="3" cellpadding="4" class="w3-table-all w3-hoverable">
            <tr bgcolor="#5555FF" class="w3-green"> 
                <td width="02%" align="center">Nº</td>
                <td width="10%" align="center">ID <br><a href="VerChamado.php?id=<? echo $id ?>&ord=1"><i class="fa fa-caret-up" <? if ( $ordem == '1' ){ echo "style='color:red'"; } ?> title="crescente"></i></a><a href="VerChamado.php?id=<? echo $id ?>&ord=1 desc"><i class="fa fa-caret-down" <? if ( $ordem == '1 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
                <td width="08%" align="center">Nome <br><a href="VerChamado.php?id=<? echo $id ?>&ord=3"><i class="fa fa-caret-up" <? if ( $ordem == '3' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerChamado.php?id=<? echo $id ?>&ord=3 desc"><i class="fa fa-caret-down" <? if ( $ordem == '3 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
                <td width="10%" align="center">Data Hora <br><a href="VerChamado.php?id=<? echo $id ?>&ord=4"><i class="fa fa-caret-up" <? if ( $ordem == '4' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerChamado.php?id=<? echo $id ?>&ord=4 desc"><i class="fa fa-caret-down" <? if ( $ordem == '4 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
                <td width="45%" align="center">Descrição <br><a href="VerChamado.php?id=<? echo $id ?>&ord=5"><i class="fa fa-caret-up" <? if ( $ordem == '5' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerChamado.php?id=<? echo $id ?>&ord=5 desc"><i class="fa fa-caret-down" <? if ( $ordem == '5 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
                <td width="10%" align="center">Motivo <br><a href="VerChamado.php?id=<? echo $id ?>&ord=6"><i class="fa fa-caret-up" <? if ( $ordem == '6' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerChamado.php?id=<? echo $id ?>&ord=6 desc"><i class="fa fa-caret-down" <? if ( $ordem == '6 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
                <td width="10%" align="center">Status <br><a href="VerChamado.php?id=<? echo $id ?>&ord=7"><i class="fa fa-caret-up" <? if ( $ordem == '7' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerChamado.php?id=<? echo $id ?>&ord=7 desc"><i class="fa fa-caret-down" <? if ( $ordem == '7 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
                <td width="05%" align="center">Tempo <br><a href="VerChamado.php?id=<? echo $id ?>&ord=8"><i class="fa fa-caret-up" <? if ( $ordem == '8' ){ echo "style='color:red'"; } ?> title="crescente"></i></a> <a href="VerChamado.php?id=<? echo $id ?>&ord=8 desc"><i class="fa fa-caret-down" <? if ( $ordem == '8 desc' ){ echo "style='color:red'"; } ?> title="descrescente"></i></a></td>
            </tr>
  
            <tr ng-repeat="y in names" class="w3-tiny"> 
                <td width="02%" align="center"  >  {{ y.cnt }} </td>
                <td width="10%" align="center"  >  {{ y.id }} </td>
                <td width="08%" align="center"  >  {{ y.responsavel }} </td>
                <td width="10%" align="center"  >  {{ y.datahora }} </td>
                <td width="45%" align="center"  >  {{ y.descricao}} </td>
                <td width="10%" align="center"  >  {{ y.motivoenc }} </td>
                <td width="10%" align="center"  >  {{ y.status }} </td>
                <td width="05%" align="center"  >  {{ y.tempo }} </td>
         	</tr>
 
         </table>
       </div>

   </div>

<br>
<br>

</div>

</body>
</html>

<script>
var app = angular.module('myApp', []);
app.controller('Chamado', function($scope, $http) {
   $http.get("data/dados_SEL_chamado.php?id=<? echo $id ?>")
   .then(function (response) {$scope.names = response.data.records;});
});

app.controller('Anotacoes', function($scope, $http) {
   $http.get("data/dados_SEL_anotacoes.php?id=<? echo $id ?>&ord=<? echo $ordem ?>")
   .then(function (response) {$scope.names = response.data.records;});
});

app.controller('Arquivos', function($scope, $http) {
   $http.get("data/dados_SEL_arquivos.php?id=<? echo $id ?>")
   .then(function (response) {$scope.names = response.data.records;});
});

function limpar()
{
	document.anotacao.digdes.value = "";
	document.anotacao.digmot.value = "";
	document.anotacao.digsta.value = "";
	document.anotacao.dighor.value = "00:00";
	document.anotacao.digenv.value = "";
};

function gravar()
{
	xerro = "";
	xhora = document.anotacao.dighor.value.substr(0,2);
	xtrac = document.anotacao.dighor.value.substr(2,1);
	xminu = document.anotacao.dighor.value.substr(3,2);
	
	if ( document.anotacao.digdes.value == "" || document.anotacao.digmot.value == "" || document.anotacao.digsta.value == "" || document.anotacao.digenv.value == "" ) 
	{
		xerro = "Obrigatório preenchimento de todos os campos!";
	}	
	if ( xtrac != ":" )
	{
		xerro = "Não encontrado no campo Tempo o caracter : no local correto!";
	}	
	
	if ( isNaN(xhora + xminu) )
	{
		xerro = "Tempo Inválido (HH:MM)" ;
	}	

	if (  parseInt(xhora) < 0 || parseInt(xhora) > 12 )
	{
		xerro = "Horas inválidas no campo Tempo (00 a 12) = " + parseInt(xhora) ;
	}	
	

	if ( parseInt(xminu) < 0 || parseInt(xminu) > 59 )
	{
		xerro = "Minutos inválidos no campo Tempo (00 a 59) = " + parseInt(xminu);
	}	
	
	
	
	if ( xerro == 0 )
	{
      var txt;
      var r = confirm('Confirma inclusão de anotação ?');
      if (r == true) { document.anotacao.submit(); }
	}
	else
	{
		alert( xerro );
	}	
	
};


function  abrir()
{
	window.open("http://uniondata.com.br/cliente/mantisbt/view.php?id=" + document.anotacao.digman.value, "_blank");
};

</script>
