<?php
require_once("classes/Sql.php");
$sql = new Sql();
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if($id){
    $sql->deleteData($id);
    header("Location: index.php");
    exit;
}

$cadastros = $sql->listAll();

?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sistema - Cadastro de Endereço</title>
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link rel="stylesheet" href="/assets/css/style.css">
    </head>
<body>
    <header>
    <nav class="nav-extended light-blue darken-4">
    <div class="nav-wrapper">
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li>
        <a href="/index.php">Listar Clientes</a></li>
        <li><a href="/form.php">Cadastrar Cliente</a></li>
      </ul>
    </div>
    
  </nav>

  <ul class="sidenav " id="mobile-demo">
    <li class="">
        <a class="white-text light-blue darken-4" href="/index.php"><i class="material-icons prefix">format_list_bulleted</i>Listar Clientes</a>
    </li>
    <li ><a class="white-text light-blue darken-4 " href="/form.php">
    <i class="material-icons prefix">library_add</i> Cadastrar Cliente</a></li>
  </ul>
    </header>
    <div class="container z-depth-1">
        <h3 class="teal-text lighten-1-text">Lista de Clientes</h3>
        <ul class="collapsible popout">
            <?php 
            if($cadastros){
                
                foreach($cadastros as $cadastro){ ?>
                <li>
                    <div class="collapsible-header">
                        <i class="material-icons">portrait</i>
                        <p><?php echo $cadastro['first_name']. " ". $cadastro['last_name']; ?></p>
                    </div>
                    <div class="collapsible-body">
                        <h4>Endereço</h4>
                        <p>Cep: <?php echo $cadastro['zipcode'] ??"Não Informado";?></p>
                        <p> <?php echo $cadastro['logradouro'] ??"Não Informado";?></p>
                        <p>Numero: <?php echo $cadastro['num'] ??"Não Informado";?></p>
                        <p>Complemento: <?php echo $cadastro['complement'] ??"Não Informado";?></p>
                        <p>Bairro: <?php echo $cadastro['neighborhood']??"Não Informado";?></p>
                        <p>Cidade: <?php echo $cadastro['city']??"Não Informado";?></p>
                        <p>Estado: <?php echo $cadastro['uf']??"Não Informado";?></p>
                        <div class="container buttons">    
                            <a class="btn-floating blue" href="form.php?id=<?php echo $cadastro['id']; ?>">
                                <i class="material-icons">edit</i>
                            </a>
                            <a class="btn-floating red" href="/?id=<?php echo $cadastro['id']; ?>">
                                <i class="material-icons">delete_forever</i>
                            </a>
                        </div>
                    </div>
                </li>
            <?php
                }
            } else { ?>
                <li>
                    <div class="collapsible-header">
                        <i class="material-icons"></i>
                        <p>Nenhum cliente Cadastrado no momento</p>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
    <!--JavaScript at end of body for optimized loading-->
<script src="/assets/lib/jquery-3.5.1.min.js"></script>

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="/assets/js/script.js"></script>
</body>

</html>
