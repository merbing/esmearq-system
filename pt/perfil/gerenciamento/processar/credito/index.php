<?php
// Definir variáveis para o exemplo
$montante = 100000.00; // Montante do crédito
$prazo_credito = 12; // Prazo do crédito em meses
$taxaJuro = 25; // Taxa de juros em percentagem
$iva = 14; // Taxa de IVA em percentagem

// Cálculos
$taxaJurosMensal = $taxaJuro / 100;

// 1. Calcular os juros mensais
$jurosMensal = $montante * $taxaJurosMensal;

// 2. Calcular o IVA sobre o montante do crédito
$ivaMontante1 = $montante * ($iva / 100);

$ivaMontante = $ivaMontante1 / $prazo_credito;

// 3. Calcular o Montante Mensal a ser devolvido pelo cliente
$montanteMensalCliente = $montante / $prazo_credito;

// 4. Somar o Juros Mensal ao Montante Mensal Cliente, considerando o IVA sobre o montante
$totalMensal = $jurosMensal + $ivaMontante + $montanteMensalCliente;

// Imprimir o resultado
echo "Montante Mensal Total: $totalMensal";
?>
