<?php
    include('protect.php');
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- <link rel="stylesheet" href="index.css">Css para a parte do back-end -->
    <link rel="stylesheet" href="style.css">

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
                        <a href="logout.php" class="nav-link">SAIR DO PAINEL</a>
                    </li>
                    <li>
                    <form action="" method="get">
                        <i class="fas fa-list"></i>
                        <a href="" class="nav-link">LISTAR PRODUTOS
                            <input type="submit"  value="Listar" name="listar" class="bt_listar"/>
                        </a>
                    </form>
                    
                    </li>
                    <li>
                        <i class="fas fa-plus"></i>
                        <a href="cadastrar.php" class="nav-link">ADICIONAR ROUPAS</a>
                    </li>
                    <li>
                        <i class="fas fa-pencil-alt"></i>
                        <a href="editar.php" class="nav-link">EDITAR PRODUTO</a>
                    </li>
                    <li>
                    <!-- <form action="" method="get">
                        <i class="fas fa-calendar-check"></i>
                        <a href="" class="nav-link">LISTAR VENDAS
                            <input type="submit"  value="Listar" name="listar_vendas" class="bt_listar"/>
                        </a>
                    </form>
                    </li> -->
                </ul>
            </div>
        </nav>
        <div class="dashboardInfo">
            <div class="dashboardPhrase">
            </div>
       

    <script src="https://kit.fontawesome.com/6bb7bca18b.js" crossorigin="anonymous"></script>
</body>
<?php
if(isset($_GET["listar"]))
{
	include "conecta.php";  // Chama a conexao com o banco de dados
    echo"
    <div class='dashboardPhrase'>
        <h2>Tabela de Produtos Cadastrados</h2>
    </div>";
	$sql="SELECT * FROM tb_produto";
	$result = mysqli_query($conn,$sql) or die (mysqli_connect_error());
	if(mysqli_num_rows($result) > 0){
	echo"
        <link rel='stylesheet' href='style.css'>
        <table class='table_dados'>
            <tr>
                <td>Categoria</td>
                <td>Tamanho</td>
                <td>Cor</td>
                <td>Preço</td>
                <td>Descrição</td>
                <td>Quantidade</td>
            </tr>
        ";
		while($dados = mysqli_fetch_array($result))
		{
		   echo "
           
                <tr>
                    <td id='dados1'>$dados[1]</td>
				    <td id='dados2'>$dados[2]</td>
                    <td id='dados3'>$dados[3]</td>
                    <td id='dados4'>$dados[4]</td>
                    <td id='dados5'>$dados[5]</td>
                    <td id='dados7'>$dados[7]</td>

                ";
		}
        echo"
        <link rel='stylesheet' href='style.css'>
            <form action=''>
			   <p>  <input type='submit'  value='Limpar' class='bt_limpar_list'/>
			 </form>";
			echo"</table>";
	}
	else{
		echo "
        <link rel='stylesheet' href='style.css'>
            <div class='text_erro'>
                <h2>Erro ao listar os produtos</h2>            
                <h4>Não existem produtos cadastrados no banco</h4
            <div>
            <form action=''>
			   <p>  <input type='submit'  value='Limpar' class='bt_limpar_list_erro'/>
			 </form>";
	}
		
}
if(isset($_GET["listar_vendas"]))
{
	include "conecta.php";  // Chama a conexao com o banco de dados
    echo"
    <div class='dashboardPhrase'>
        <h2>Tabela de Vendas</h2>
    </div>";
	$sql="SELECT * FROM tb_venda";
	$result = mysqli_query($conn,$sql) or die (mysqli_connect_error());
	if(mysqli_num_rows($result) > 0){
	echo"
        <link rel='stylesheet' href='style.css'>
        <table class='table_dados'>
            <tr>
                <td>ID_Venda</td>
                <td>Quantidade</td>
                <td>Valor Total</td>
                <td>Status</td>
            </tr>
        ";
		while($dados = mysqli_fetch_array($result))
		{
		   echo "
           
                <tr>
                    <td id='dados1'>$dados[0]</td>
				    <td id='dados2'>$dados[2]</td>
                    <td id='dados3'>$dados[4]</td>
                    <td id='dados4'>$dados[5]</td>

                ";
		}
        echo"
        <link rel='stylesheet' href='style.css'>
            <form action=''>
			   <p>  <input type='submit'  value='Limpar' class='bt_limpar_list'/>
			 </form>";
			echo"</table>";
	}
	else{
		echo "
        <link rel='stylesheet' href='style.css'>
            <div class='text_erro'>
                <h2>Ainda sem Vendas</h2>            
                <h4>Não existem vendas cadastradas no banco</h4
            <div>
            <form action=''>
			   <p>  <input type='submit'  value='Limpar' class='bt_limpar_list_erro'/>
			 </form>";
	}
		
}
?>
        </div>
</html>
