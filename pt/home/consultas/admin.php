<?php
    try{
        // Getting clients count
        $query = "SELECT COUNT(*) as count FROM clientes";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $clients = $result->fetch_assoc();
        }

    }
    catch(Exception $e)
    {
        $clients['count'] = "Informação indisponível";
    }


    try{
        // Getting process count
        $query = "SELECT COUNT(*) as count FROM processos";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $processos = $result->fetch_assoc();
        }

    }
    catch(Exception $e)
    {
        $processos['count'] = "Informação indisponível";
    }

    try{
        // Getting consiltorias count
        $query = "SELECT COUNT(*) as count FROM consultasagendamento";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $consultorias = $result->fetch_assoc();
        }

    }
    catch(Exception $e)
    {
        $consultorias['count'] = "Informação indisponível";
    }


    try{
        // Getting process count
        $query = "SELECT COUNT(*) as count FROM funcionarios";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $funcionarios = $result->fetch_assoc();
        }

    }
    catch(Exception $e)
    {
        $funcionarios['count'] = "Informação indisponível";
    }


    try{
        // Getting top 5 destiny
        $query = "select pais_destino as pais,count(id) as number from consultasagendamento
        group by pais_destino order by number desc limit 5;";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        $destinos_preferidos = [];
        if ($result->num_rows > 0) {
            while($destino_preferido = $result->fetch_assoc()){
                $destinos_preferidos[] = $destino_preferido;
            }
        }

    }
    catch(Exception $e)
    {
        $destinos_preferidos= [];
    }

    try{
        // Getting top 5 services
        $query = "select S.nome,count(C.id) as number from consultasagendamento C
                INNER JOIN servicos S ON (S.id = C.servico_desejado)
                group by S.nome order by number desc limit 5;";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        $servicos_preferidos = [];
        if ($result->num_rows > 0) {
            while($destino_preferido = $result->fetch_assoc()){
                $servicos_preferidos[] = $destino_preferido;
            }
        }

    }
    catch(Exception $e)
    {
        $servicos_preferidos= null;
    }


    try{
        // Getting top 5 viajantes
        $query = "select C.nome,count(V.id) as number from viagens V
        INNER JOIN clientes C ON (C.id = V.id_cliente)
        group by C.nome order by number desc limit 5;";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        $viajantes = [];
        if ($result->num_rows > 0) {
            while($viajante = $result->fetch_assoc()){
                $viajantes[] = $viajante;
            }
        }

    }
    catch(Exception $e)
    {
        $viajantes= [];
    }


?>
