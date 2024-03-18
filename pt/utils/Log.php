<?php 
// include_once("../../banco/config.php");

class Log{

    private $usuario_id;
    private $acao;
    private $detalhes;
    private $conn;

    public function __construct($acao_ = "Registando actividade", $detalhes_ = "Detalhes da actividade",$conexao) {
        $this->acao = $acao_;
        $this->detalhes = $detalhes_;
        $this->usuario_id = $_SESSION['funcionario_id'] ?? 1;
        $this->conn = $conexao;
    }

    public function save()
    {
        $query = "INSERT INTO logs (usuario_id, acao, detalhes)
                            VALUES ($this->usuario_id, '$this->acao', '$this->detalhes')";
        $result = $this->conn->query($query);
        if ($result==TRUE) {
            
        } else {
            
        }
    }


}

?>