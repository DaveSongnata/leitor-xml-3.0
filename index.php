<?php

$xml = simplexml_load_file('exemploNFCe.xml');

//Verifica que o xml tem algo
if ($xml === false) {
    die('Erro ao carregar o arquivo XML');
}

$nfeInfo = $xml->NFe->infNFe;
$emitente = $nfeInfo->emit;
$destinatario = $nfeInfo->dest;
$total = $nfeInfo->total->ICMSTot;
$detalhes = $nfeInfo->det; 


?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>NFC-e</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            margin: 10px;
        }
        .card-deck .card {
            flex: 1 1 auto;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Nota Fiscal de Consumidor Eletrônica (NFC-e)</h1>

    <div class="card-deck">
        <div class="card">
            <div class="card-header">
                Emitente
            </div>
            <div class="card-body">
                <p><strong>Nome:</strong> <?php echo $emitente->xNome; ?></p>
                <p><strong>CNPJ:</strong> <?php echo $emitente->CNPJ; ?></p>
                <p><strong>Endereço:</strong> <?php echo $emitente->enderEmit->xLgr . ', ' . $emitente->enderEmit->nro . ', ' . $emitente->enderEmit->xBairro . ', ' . $emitente->enderEmit->xMun . ' - ' . $emitente->enderEmit->UF; ?></p>
                <p><strong>CEP:</strong> <?php echo $emitente->enderEmit->CEP; ?></p>
                <p><strong>Telefone:</strong> <?php echo $emitente->enderEmit->fone; ?></p>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Destinatário
            </div>
            <div class="card-body">
                <p><strong>Nome:</strong> <?php echo $destinatario->xNome; ?></p>
                <p><strong>CPF:</strong> <?php echo $destinatario->CPF; ?></p>
                <p><strong>Endereço:</strong> <?php echo $destinatario->enderDest->xLgr . ', ' . $destinatario->enderDest->nro . ', ' . $destinatario->enderDest->xBairro . ', ' . $destinatario->enderDest->xMun . ' - ' . $destinatario->enderDest->UF; ?></p>
                <p><strong>CEP:</strong> <?php echo $destinatario->enderDest->CEP; ?></p>
                <p><strong>Telefone:</strong> <?php echo $destinatario->enderDest->fone; ?></p>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Totais
            </div>
            <div class="card-body">
                <p><strong>Valor Total:</strong> R$ <?php echo number_format((float)$total->vNF, 2, ',', '.'); ?></p>
                <p><strong>Valor de PIS:</strong> R$ <?php echo number_format((float)$total->vPIS, 2, ',', '.'); ?></p>
                <p><strong>Valor de COFINS:</strong> R$ <?php echo number_format((float)$total->vCOFINS, 2, ',', '.'); ?></p>
                <p><strong>Valor de Frete:</strong> R$ <?php echo number_format((float)$total->vFrete, 2, ',', '.'); ?></p>
                <p><strong>Valor de Desconto:</strong> R$ <?php echo number_format((float)$total->vDesc, 2, ',', '.'); ?></p>
            </div>
        </div>
    </div>

    <h2 class="mt-5">Detalhes dos Produtos</h2>
    <div class="table-responsive mt-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Descrição</th>
                    <th>Código</th>
                    <th>Quantidade</th>
                    <th>Valor Unitário</th>
                    <th>Valor Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($detalhes as $item): ?>
                    <tr>
                        <td><?php echo $item->prod->xProd; ?></td>
                        <td><?php echo $item->prod->cProd; ?></td>
                        <td><?php echo number_format((float)$item->prod->qCom, 2, ',', '.'); ?></td>
                        <td>R$ <?php echo number_format((float)$item->prod->vUnCom, 2, ',', '.'); ?></td>
                        <td>R$ <?php echo number_format((float)$item->prod->vProd, 2, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
