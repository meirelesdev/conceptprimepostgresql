<?php
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if($id){
    require_once("classes/Sql.php");
    $sql = new Sql();
    $cliente = $sql->getData($id);
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sistema - Cadastro de Endereço</title>
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
<body>
    <header>
    <nav class="nav-extended light-blue darken-4">
    <div class="nav-wrapper">
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="index.php">Listar Clientes</a></li>
        <li><a href="form.php">Cadastrar Cliente</a></li>
      </ul>
    </div>
    
  </nav>

  <ul class="sidenav" id="mobile-demo">
    <li><a class="white-text light-blue darken-4" href="index.php"><i class="material-icons prefix">format_list_bulleted</i>Listar Clientes</a></li>
    <li><a class="white-text light-blue darken-4" href="form.php"><i class="material-icons prefix">library_add</i>Cadastrar Cliente</a></li>
  </ul>
    </header>
    <div class="container z-depth-1">

        <h3 class="teal-text lighten-1-text">
            <?php if($id){
            echo "Editar Cadastro";
        } else{
            echo "Cadastrar Cliente";
        }
            
            ?></h3>
        <form action="cadastrar.php" method="POST" id="formAdd">
            <input type="number" name="id" value="<?php echo $cliente['id']; ?>" hidden>
                <div class="row">
                    <div class="col s12">
                        <div class="row">
                            <div class="input-field col s12 m6">
                            <input type="text"  name="first_name" id="first_name"  required  class="validate" value="<?php echo $cliente['first_name'] ??''; ?>">
                              <label for="first_name">Nome</label>
                            </div>
                            <div class="input-field col s12 m6">
                            <input type="text" name="last_name" id="last_name"  required  class="validate" value="<?php echo $cliente['last_name'] ?? ''; ?>">
                              <label for="last_name">Sobrenome</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s10 m3">
                                <i class="material-icons prefix">location_on</i>
                            
                                <input type="text" required name="zipcode"  id="zipcode" class="validate"  value="<?php echo $cliente['zipcode']?? ''; ?>">
                                <label for="zipcode">CEP</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s9">
                                <input type="text" required  name="street" id="street"  class="validate" value="<?php echo $cliente['logradouro']?? ''; ?>">
                                <label for="street">Logradouro</label>
                            </div>
                            <div class="input-field col s3">
                                <input type="text" name="num" id="num"  required  class="validate" value="<?php echo $cliente['num'] ??''; ?>">
                                <label for="num">Nº</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="text"  name="complement" id="complement" class="validate" value="<?php echo $cliente['complement'] ??''; ?>">
                                <label for="complement">Complemento</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s8">
                                <input type="text" required name="neighborhood" id="neighborhood" class="validate" value="<?php echo $cliente['neighborhood'] ??''; ?>">
                                <label for="neighborhood">Bairro</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s2">
                                <input type="text" required readonly placeholder="Estado" name="uf" id="state" class="" value="<?php echo $cliente['uf']??''; ?>">
                                
                            </div>
                            <div class="input-field col s10">
                                <input type="text" required readonly name="city" placeholder="Cidade" id="city" class="" value="<?php echo $cliente['city']??''; ?>">
                                
                            </div>
                        </div>
                    </div>
                <div class="row ">
                    <button class="btn waves-effect waves-right"  type="submit" name="action">
                    <?php if($id){
                                echo "Salvar Alterações";
                            } else{
                                echo "Cadastrar";
                            }
                     ?>
                <i class="material-icons right">send</i>
                </button>
                </div>
            </form>
    </div>
    <!--JavaScript at end of body for optimized loading-->
    <script src="assets/lib/jquery-3.5.1.min.js"></script>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>
