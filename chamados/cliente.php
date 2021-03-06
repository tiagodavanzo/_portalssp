<?php
  session_start();
  require_once("config.php");
  require_once("php/verifica.php");
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Sistema de Chamados - Portal SSP</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">
  </head>
<body>
    
  <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="cliente.php">Chamados</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </nav>

  <main role="main" class="container">

    <div class="starter-template">
        <h1>Chamados - Clientes</h1>
        <form id="frmChamado">
          <input type="hidden" id="hdId" value="">
          <input type="hidden" id="hdIdCliente" value="<?php echo $_SESSION[Config::$uniqid]["id"]; ?>">
          <div class="row text-left">
            <div class="col-md-12">
              <label for="firstName">Título</label>
              <input type="text" class="form-control" id="txtTitulo" placeholder="" value="">
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Descrição</label>
                <textarea class="form-control" id="txtDescricao" rows="3"></textarea>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <button class="btn btn-primary btn-md" id="btnOK" type="button">Cadastrar</button>
                <button class="btn btn-danger btn-md" id="btnCancelar" type="button">Cancelar</button>
              </div>
            </div>
          </div>
        </form>
      <p>&nbsp;</p>
      <div class="row">
          <div class="col-md-12">
          <table id="chamados" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Status</th>
                    <th>Atendido Por</th>
                    <th>Ações</th>
                </tr>
            </thead>
        </table>
          </div>
      </div>
    </div>

  </main><!-- /.container -->

  <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.css"/>
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.js"></script>
  <script src="https://kit.fontawesome.com/3c40c56dfa.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/cliente.js"></script>

</html>
