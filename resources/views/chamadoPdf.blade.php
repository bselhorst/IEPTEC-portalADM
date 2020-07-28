<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div align="center">
        <img src="{{public_path('backend/images/acre.png')}}" alt="Logo" height="75px">
    </div>
    <div align="center" style="padding-top: 5px">
        <b>Instituto Estadual de Educação Profissional e Tecnológico - IEPTEC</b>
        <br>
        <b>Divisão de Tecnologia da Informação</b>
    </div>
    <br>
    <table width="100%">
        <tr align="center">
            <td style="border: 1px solid" colspan="2"><b>RELATÓRIO DE ATENDIMENTO</b></td>
        </tr>
        <tr>
            <td style="border: 1px solid; width: 40%"><b>Número do Chamado:</b> {{ $chamado->id }}</td>
            <td style="border: 1px solid"><b>Data do Chamado:</b> {{ $chamado->created_at->format('d/m/Y H:i:s') }}</td>
        </tr>
        <tr>
            <td style="border: 1px solid" colspan="2"><b>Setor:</b> {{ $chamadoCompleto[0]->nome }}</td>
        </tr>
        <tr>
            <td style="border: 1px solid" colspan="2"><b>Solicitante:</b> {{ $chamadoCompleto[0]->solicitante }}</td>
        </tr>
        <tr>
            <td style="border: 1px solid" colspan="2"><b>Técnico:</b> {{ $chamadoCompleto[0]->name }}</td>
        </tr>
        <tr>
            <td style="border: 1px solid" colspan="2"><b>Categoria:</b> {{ $chamadoCompleto[0]->categoria }}</td>
        </tr>
        <tr>
            <td style="text-align: justify; border: 1px solid; height: 175px; vertical-align: top" colspan="2">
                <b>Descrição:</b>
                <br>
                {{ $chamado->descricao }}
            </td>
        </tr>
        <tr>
            <td style="text-align: justify; border: 1px solid; height: 250px; vertical-align: top" colspan="2">
                <b>Solução:</b>
                <br>
                {{ $chamado->solucao }}
            </td>
        </tr>
    </table>
    <br><br><br>
    <table width="100%">
        <tr>
            <td style="width: 50%">___________________________________________</td>
            <td style="width: 50%">___________________________________________</td>
        </tr>
        <tr>
            <td style="width: 50%" align="center">Ass. Técnico</td>
            <td style="width: 50%" align="center">Ass. Solicitante</td>
        </tr>
    </table>
</body>
</html>
