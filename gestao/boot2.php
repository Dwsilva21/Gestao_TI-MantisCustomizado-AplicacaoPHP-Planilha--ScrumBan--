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




<div class="container">
    <h1>Bootstrap Dynamic Tabs</h1>
    <div class="well">

        <a href="#" id="btnAdd"><i class="icon-plus-sign-alt"></i>Add Tab</a>
        <br><br>
        <ul class="nav nav-tabs" id="tabs">
            <li class="active"><a href="#tab1" data-toggle="tab">Tab 1</a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="tab1">Hello tab #1 content...</div>
        </div>
   </div>
   
</div>




<script>
  $('#btnAdd').click(function (e) {
    var nextTab = $('#tabs li').size()+1;

    // create the tab
    $('<li><a href="#tab'+nextTab+'" data-toggle="tab">Tab '+nextTab+'</a></li>').appendTo('#tabs');

    // create the tab content
    $('<div class="tab-pane" closable id="tab'+nextTab+'"><iframe  src="VerCli.php" id="iframe'+nextTab+'"></iframe></div>').appendTo('.tab-content');

    // make the new tab active
    $('#tabs a:last').tab('show');
});
</script>