<?php
   include('protect.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="cadastro.css">
    <title>Cadastrar Produtos</title>
</head>
<body>
	<div class="container">
        <nav>
            <div class="navLogo">
                <a href="">Lollita.</a>
            </div>
            <div class="navOptions">
                <ul>
                    <li>
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
    <section class="cad_prod">
        <form action="cadastrar.php" method="post" class="form_cad">
			<div class="tittle">
              <h1>Adicionar Roupa</h1> 
			</div>
			<div class="container_form">
				<div class="form_file">
					<label id="text_img">Escolha a imagem do produto:</label></br>
					<input type="file" id="img_prod" name="imagem_prod" accept="image/png, image/jpeg">
				</div>
				</br>
				<div class="form_box">
					<label hidden>ID_Prod 
						<input type="text" name="id_prod" id="id_prod" hidden/>
					</label> </br>
					<label>Categoria: 
						<input type="text" name="categoria" id="categoria" />
					</label> </br>
					<label>Tamanho:
						<input type="text" name="tamanho" id="tamanho" />
					</label> </br>
					<label>Cor:
						<input type="text" name="cor" id="cor" />
					</label></br>
					<label>Preço:
						<input type="number" step="any" name="preco" id="preco"/>
					</label></br>
					<label>Descrição:
						<input type="text" name="descricao" id="descricao" />
					</label></br>
					<label>Quantidade:
						<input type="number" name="quantidade" id="quantidade" />
					</label></br>
					<input type="submit"  value="Cadastrar" name="cadastro" class="bt_cad" />
					<input type="reset"  value="Limpar" class="bt_limpar"/>
				</div>     
			</div>
        </form>
    </section>
	
	<script src="https://kit.fontawesome.com/6bb7bca18b.js" crossorigin="anonymous"></script>    
</body>
</html>
<?php

if(isset($_POST["cadastro"])) {
			include "conecta.php"; // Chama o PHP de Conexão
			
			$img_prod='img/'.($_POST["imagem_prod"]);
			$categoria=strtoupper($_POST["categoria"]);
			$tamanho=strtoupper($_POST["tamanho"]);
			$cor=strtoupper($_POST["cor"]);
			$preco=strtr($_POST["preco"], ',','.');
			$descricao=strtoupper($_POST["descricao"]);
			$quantidade=$_POST["quantidade"];
			
			$erro="";
			if ($categoria == "") 
			{ 
				$erro .= "Digite a categoria;</br>";
			}
			
			if ($tamanho == "") 
			{ 
				$erro .= "Digite o tamanho;</br>";
			}
			
			if ($cor == "") 
			{ 
				$erro .= "Informe a cor;<br/>";
			}

			if ($preco == "" or $preco <0) 
			{ 
				$erro .= "Informe corretamente o preço;<br/>";
			}
			if ($descricao == "") 
			{ 
				$erro .= "Digite uma descrição;<br/>";
			}
			if ($img_prod == "") 
			{ 
				$erro .= "Escolha a imagem do produto.</br>";
			}
			if ($quantidade == "") 
			{ 
				$erro .= "Informe a quantidade de produtos.</br>";
			}
			
			
			if($erro=="")
			{
				$sql="SELECT id_prod,categoria, tamanho, cor, preco, descricao, imagem_prod
					  FROM tb_produto
					  WHERE id_prod LIKE 'id_prod'";
					 
				$result=mysqli_query($conn,$sql)or die ("Impossivel Cadastrar no Banco");
				$linha=mysqli_fetch_assoc($result);

				// verifica se já existe sigla cadastrada no banco
				// não existindo faço insert
				if($linha["categoria"]!=$categoria)
				{				
					$sqlINS="insert into tb_produto
					        (categoria, tamanho, cor, preco, descricao, imagem_prod, quantidade)
						   values('$categoria','$tamanho','$cor', '$preco', '$descricao', '$img_prod', '$quantidade')";
					
							   
					$result=mysqli_query($conn,$sqlINS)or die ("Impossivel Cadastrar ".mysqli_error($conn));
					echo " <link rel='stylesheet' href='cadastro.css'>
							<div class='menssage_box'>
								<h1>Cadastro efetuado com sucesso</h1>
							 	<form action='' method=''
									<p><input type='submit' value='Novo Cadastro' class='bt_novo_cad'/></p>
						  		</form>
							</div>";					
				}
                // senão, informo que já está cadastrada a sigla				
				else
				{
					echo "<link rel=stylesheet href=cadastro.css>
							<div class='box_erro_cad'>		
								<h1>Produto já cadastrado no banco</h1>
								<form action='' method=''>
									<input type='submit'  value='Retornar' class='bt_erro_cad'/>
						 		</form>
							</div>";
				}
				// Fechar conexão
				////////mysqli_close($conn);
			}
		  else {
			echo "<link rel='stylesheet' href='cadastro.css'>
					<div class='tittle_box_erro'>
						<h1>Erro ao cadastrar no banco!</h1> 
						<h2>Verifique as mensagens abaixo:</h2>
						<div class='menssage_box_erro'>
							$erro
						</div>
						<form action='' method=''>
							<input type='submit'  value='Voltar' class='bt_voltar'/>
				 		</form>			
					</div>";
		 }
	} 
?>