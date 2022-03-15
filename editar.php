<?php
   include('protect.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="editar.css">
	<link rel="stylesheet" href="style.css">
    <title>Editar Produtos</title>
</head>
<body>
	<div class="container">
        <nav>
            <div class="navLogo">
                <a href="">Lollita.</a>
            </div>
            <div class="navOptions">
                <ul>
                    <li class="return">
                        <i class="fas fa-undo-alt"></i>
                        <a href="admin_lollita.php" class="nav-link">RETORNAR AO PAINEL ADMIN</a>
                    </li>
                    <li>
                        <i class="fas fa-plus"></i>
                        <a href="cadastrar.php" class="nav-link">ADICIONAR ROUPAS</a>
                    </li>
                    <li>
                        <i class="fas fa-pencil-alt"></i>
                        <a href="editar.php" class="nav-link">EDITAR PRODUTO</a>
                    </li>
                </ul>
            </div>
		</nav>
	</div>
	<section class="edt_prod">
		<form action="editar.php" method="get">
			<div class="tittle">
				<h1>Buscar modelo para alteração</h1>	
			</div>
			<div class="container_form">
				<Label>Digite o id do produto desejado
					<input type="number" name="idprod"/>
				</Label><br>
			</div>
			
   	 		<input type="submit"  value="Buscar" name="busca" class="bt_buscar" />	
    		<input type="submit"  value="Limpar" name="limpa" class="bt_limpar"/>
 		</form>
	</section>

	<script src="https://kit.fontawesome.com/6bb7bca18b.js" crossorigin="anonymous"></script>
</body>
</html>
<?php  
if(isset($_GET["limpa"]))
{
	echo"<form action=''>";
	echo"</form>";
	
}	
if(isset($_GET["busca"])||isset($_GET["altera"]))
{
	include "conecta.php";
    $idprod = $_GET["idprod"];
	
	$erro="";
		
	if ($idprod=="")
	{ 
			$erro .= "Digite o id do produto desejado";
	}

    echo $erro;

if($erro=="")
	{
		$sql="SELECT ID_PROD ,categoria, tamanho, cor, preco, descricao, imagem_prod
			  FROM tb_produto
			  WHERE ID_PROD LIKE '$idprod'";

				  
		$resultado=mysqli_query($conn,$sql)or die ("Impossivel verificar o ID digitado");
        $qtd = mysqli_num_rows($resultado);


		$linha=mysqli_fetch_assoc($resultado);

		if ($linha["ID_PROD"]==$idprod)
		{
			$idproduto=$linha["ID_PROD"];
			$categoria=$linha["categoria"];
		    $tamanho=$linha["tamanho"];
			$cor=$linha["cor"];
			$preco=strtr($linha["preco"], '.',',');
			$descricao=$linha["descricao"];
			$imagem_prod=$linha["imagem_prod"];
			
			if(isset($_GET["busca"]))
			{
			echo "
				<link rel='stylesheet' href='editar.css'>
					<div class='result_busca'>
						<form action='' method='get'>
							<h1>Resultado da Busca</h1>
							<h2>*OBSERVAÇÃO: O campo código é apenas para visualização.</h2>
							<div class='container_form_result'>
								<label>Código 
									<input type=number' name='idprod' value='$idproduto' readonly>
								</label><br>
								<label>Categoria
									<input type='text' name='categoria' value='$categoria' id='categoria_result'>
								</label><br> 
								<label>Tamanho
									<input type='text' name='tamanho' value='$tamanho' id='tamanho_result'> 
								</label><br> 
								<label>Cor
									<input type='text' name='cor' value='$cor' id='cor_result'> 
								</label><br> 
								<label>Preço 
									<input type='text' step='any' name='preco' value='$preco' id='preco_result'> 
								</label><br> 
								<label>Descrição
									<input type='text' name='descricao' value='$descricao' id='desc_result'> 
								</label<br><br>
								<div class='img_prod_result'>
									<label>Imagem do Produto</label>
										<img src='$imagem_prod'>
						
									<br>
								</div> 
							</div>					 
							<p><input type='submit' value='Alterar' name='altera' class='bt_alterar'/></p>
						</form>
					</div>";
			}
			if(isset($_GET["altera"]))	
			{
                $alt_id_produto=$_GET["idprod"];
				$alt_categoria=$_GET["categoria"];				
				$alt_tamanho=$_GET["tamanho"];
				$alt_cor=$_GET["cor"];
				$alt_preco=strtr($_GET["preco"], ',','.');
				$alt_descricao=$_GET["descricao"];

				$alt_categoria=strtoupper($alt_categoria);
				$alt_tamanho=strtoupper($alt_tamanho);
				$alt_cor=strtoupper($alt_cor);
				$alt_descricao=strtoupper($alt_descricao);

				$erro ="";
					
				if ($alt_categoria == "")
				{ 
					$erro .= "Informe uma Categoria;<br>";
				}	
						
				if ($alt_tamanho == "")
				{ 
					$erro .= "Informe o Tamanho;<br>";
				}
				if ($alt_cor == "")
				{ 
					$erro .= "Informe a Cor;<br>";
				}
				if ($alt_preco == "" or $alt_preco<0)
				{ 
					$erro .= "Informe corretamente o Preço;<br>";
				}
				if ($alt_descricao == "")
				{ 
					$erro .= "Informe a Descrição;<br>";
				}

				if($erro=="")
				{
					echo "
					<link rel='stylesheet' href='editar.css'>
						<div class='container_prod_alt'>
						   <form action='' method='get'>
							<h1>Resultado da Alteração</h1>
							
							<label>Código 
								<input type='text' name='idprod' id='codigo' value='$alt_id_produto' readonly>
							</label><br>
							<label>Categoria:
								<input type='text' name='categoria' value='$alt_categoria' id='categoria_result' readonly> 
							</label><br>
							<label>Tamanho:
								<input type='text' name='tamanho' value='$alt_tamanho' id='tamanho_result' readonly>
							</label><br>
							<label>Cor:
								<input type='text' name='cor' value='$alt_cor' id='cor_result' readonly>
							</label><br>
							<label>Preço:
								<input type='number' name='preco' size='20' value='$alt_preco' id='preco_result' readonly> 
							</label><br>
							<label>Descrição:
								<input type='text' name='descricao' size='20' value='$alt_descricao' id='desc_result' readonly> 
							</label><br>
							<div class='img_prod_alt'>
									<label>Imagem do Produto:</label> 
										<img src='$imagem_prod'>
									<br>
								</div> 
						  </form>
						</div>";
				 
					$sql="UPDATE tb_produto
						  SET	categoria='$alt_categoria',
						  		tamanho='$alt_tamanho',
								cor='$alt_cor',
								preco='$alt_preco',
								descricao='$alt_descricao'	
						  WHERE  ID_PROD='$alt_id_produto'";

					$resultado=mysqli_query($conn,$sql) or die ("Impossivel Alterar ".mysqli_error($conn));	 
					echo "
					<link rel='stylesheet' href='editar.css'>
						<div class='message_box_alt_efetuado'>
							<h2>Alterações Efetuadas com Sucesso</h2>
							<form action=''>
						   		<input type='submit'  value='Realizar nova alteração' class='bt_novo_alterar'/>
							</form>
						</div>";		
				}
				else
				{
					echo "
						<link rel='stylesheet' href='editar.css'>
						<div class='erro_box'>
							<h1>Erro na Alteração</h1> 
							<h2>Verifique as mensagens abaixo:</h2>
							<div class='menssage_box_erro'>
								$erro
							</div>
							<form action='' method=''>
								<input type='submit'  value='Voltar' class='bt_voltar'/>
				 			</form>	
						</div>";

				} // fim if($erroALTERAR=="")	
								
            } 
		
		}
		else
		{
		    echo"
				<link rel='stylesheet' href='editar.css'>
					<div class='erro_id'>
						<h1>Resultado da Busca</h1>	
							<p>O ID $idprod não está cadastrado no banco.</p>
						<form action=''>
							<input type='submit'  value='Retornar'/ class='bt_limpar_erro_id'>
		      			</form>
					<div>";
		} // fim if ($qtd > 0)*/
	}
/// fim if($erro=="")	
 // Fechar conexão
 mysqli_close($conn);
}
?>
</p>