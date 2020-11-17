<?php
include('verificaLogin.php');
include 'vendor/autoload.php';
include 'conexao.php';
$nf = $_GET['nf'];


$consulta_banco_escrita = "select * from tb_contaareceber where CO_IDCONTA = '$nf'";
$consulta_banco = mysqli_query($con, $consulta_banco_escrita); 
while($linhas_banco = mysqli_fetch_assoc($consulta_banco)){
    $contabancaria = $linhas_banco['CO_CONTABANCARIA'];
    $valor = $linhas_banco['CO_VALOR'];
    $datav = $linhas_banco['CO_DATAVENCIMENTO'];
    $datae = $linhas_banco['CO_DATAEMISSAO'];
    $cnpj = $linhas_banco['CO_IDCLIENTE'];
}
$consulta_cliente_escrita = "select * from tb_cliente where cl_cnpj = '$cnpj'";
$consulta_cliente = mysqli_query($con, $consulta_cliente_escrita);
while($linhas_cliente = mysqli_fetch_assoc($consulta_cliente)){
    $nome =  $linhas_cliente['CL_NOME'];
    $endereco =  $linhas_cliente['CL_ENDERECO'];
    $bairro =  $linhas_cliente['CL_BAIRRO'];
    $cep =  $linhas_cliente['CL_CEP'];
    $cidade =  $linhas_cliente['CL_CIDADE'];
}


$codigo_banco = Cnab\Banco::ITAU;
$arquivo = new Cnab\Remessa\Cnab400\Arquivo($codigo_banco);
$arquivo->configure(array(
    'data_geracao'  => new DateTime(),
    'data_gravacao' => new DateTime(), 
    'nome_fantasia' => 'Nacon Engenharia', // seu nome de empresa
    'razao_social'  => 'Fernanda e Antônia Engenharia Ltda',  // sua razão social
    'cnpj'          => '09416514000105', // seu cnpj completo
    'banco'         => $codigo_banco, //código do banco
    'logradouro'    => 'Rua Joaquim de Sá',
    'numero'        => '865',
    'bairro'        => 'Jardim Áurea', 
    'cidade'        => 'Sorocaba',
    'uf'            => 'SP',
    'cep'           => '08421-108',
    'agencia'       => '1842', 
    'conta'         => '18632', // número da conta
    'conta_dac'     => '7', // digito da conta
));

// você pode adicionar vários boletos em uma remessa
$arquivo->insertDetalhe(array(
    'codigo_de_ocorrencia' => 1, // 1 = Entrada de título, futuramente poderemos ter uma constante
    'nosso_numero'      => $nf,
    'numero_documento'  => '',
    'carteira'          => '109',
    'especie'           => Cnab\Especie::ITAU_DUPLICATA_DE_SERVICO, // Você pode consultar as especies Cnab\Especie
    'valor'             => $valor, // Valor do boleto
    'instrucao1'        => 2, // 1 = Protestar com (Prazo) dias, 2 = Devolver após (Prazo) dias, futuramente poderemos ter uma constante
    'instrucao2'        => 0, // preenchido com zeros
    'sacado_nome'       => $nome, // O Sacado é o cliente, preste atenção nos campos abaixo
    'sacado_tipo'       => 'cpf', //campo fixo, escreva 'cpf' (sim as letras cpf) se for pessoa fisica, cnpj se for pessoa juridica
    'sacado_cpf'        => $cnpj,
    'sacado_logradouro' => $endereco,
    'sacado_bairro'     => $bairro,
    'sacado_cep'        => $cep, // sem hífem
    'sacado_cidade'     => $cidade,
    'sacado_uf'         => 'SP',
    'data_vencimento'   => $datav,
    'data_cadastro'     => $datae,
    'juros_de_um_dia'     => 0.10, // Valor do juros de 1 dia'
    'data_desconto'       => new DateTime(),
    'valor_desconto'      => 10.0, // Valor do desconto
    'prazo'               => 10, // prazo de dias para o cliente pagar após o vencimento
    'taxa_de_permanencia' => '0', //00 = Acata Comissão por Dia (recomendável), 51 Acata Condições de Cadastramento na CAIXA
    'mensagem'            => ' ',
    'data_multa'          => new DateTime(), // data da multa
    'valor_multa'         => 10.0, // valor da multa
));
$usuario = $_SESSION['nome'];
$hoje = date('YmdHis');
// para salvar
    $nome_arq = "rem$hoje.rem";
    $arquivo->save("C:/Users/roscu/Downloads/$nome_arq");
    $arquivo->save("remessa/$nome_arq");
    $caminho = "C:/Users/roscu/Downloads/$nome_arq";   
    $acao = "Gerou a remessa $nome_arq";
    include('registramovimento.php');
    $inclu = "update tb_contaareceber set co_situacao = 'Em Aberto' where co_idconta = '$nf'";
    mysqli_query($con,$inclu);
    
    echo("<script>window.close();opener.location.href=opener.location.href;</script>");

?>