<?php include "index.php"; ?>
<link href="content/usuario.css" rel="stylesheet" />
<form class="form-group" name="frm_func" method="get" action="inserir_funcionario.php">
      
    <center><h2>Cadastro de Usuario</h2></center>
    
    <div id=centro>
        
        <div class="form-group row" >
            <label for="nome" class="col-sm-2 col-form-label" >Login:   </label>   
            <input type="nome" placeholder="Nome" class="form-control" style="width:500px;" class="form-control" name="txtLogin"></br>
        </div>
    
        <div class="form-group row" >
            <label for="nome" class="col-sm-2 col-form-label" >Senha:   </label>   
            <input type="nome"  placeholder="Nome" class="form-control" style="width:500px;" class="form-control" name="txtSenha"></br>
        </div>
       

        <button class="btn btn-primary" type="submit">Inserir</button>							   
	 </div>							   
</form>
