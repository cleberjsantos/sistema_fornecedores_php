<?php
    require_once('config.php');
    require_once('inc/login_require.php');

    require_once(HEADER_TEMPLATE);
?>

    <form class="form-group" name="frm_prod" method="post" action="inserir_produto.php">
        
        <center><h2>Cadastro de Produtos</h2></center>
    
        <div id="centro">
          
            <div class="form-group row" >
                <label for="IdProd" class="col-sm-2 col-form-label" >ID Produto: </label>   
                <input type="IdProd"  class="form-control" style="width:200px;" class="form-control" name="txtIdProduto"></br>
            </div>
            
            <div class="form-group row" >
                <label for="IdForn" class="col-sm-2 col-form-label" >ID Fornecedor: </label>   
                <input type="IdForn"  class="form-control" style="width:200px;" class="form-control" name="txtIdFornecedor"></br>
            </div>        
           
            <div class="form-group row" >
                <label for="nomeProd" class="col-sm-2 col-form-label" >Nome Produto: </label>   
                <input type="nomeProd"  class="form-control" style="width:500px;" class="form-control" name="txtnomeProduto"></br>
            </div>    
    
            <div class="form-group row" >
                <label for="modelo" class="col-sm-2 col-form-label" >Modelo: </label>   
                <input type="modelo"  class="form-control" style="width:500px;" class="form-control" name="txtModelo"></br>
            </div>
           
             <div class="form-group row" >
                <label for="lote" class="col-sm-2 col-form-label" >Lote: </label>   
                <input type="lote"  class="form-control" style="width:200px;" class="form-control" name="txtLote"></br>
            </div>
    
            <div class="form-group row" >
                <label for="preco" class="col-sm-2 col-form-label" >Preço: </label>   
                <input type="preco"  class="form-control" style="width:200px;" class="form-control" name="txtPreco"></br>
            </div>
      
             <div class="form-group row" >
                <label for="quantidade" class="col-sm-2 col-form-label" >Quantidade: </label>   
                <input type="quantidade"  class="form-control" style="width:200px;" class="form-control" name="txtQuant"></br>
            </div>
    
          <button class="btn btn-primary" type="submit">Produto</button>	
            
        </div>
      
    </form>

<?php require_once(FOOTER_TEMPLATE); ?>
