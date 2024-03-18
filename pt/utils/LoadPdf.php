<?php
use Dompdf\Dompdf;


class LoadPdf{

    private $html;
    private $dompdf;

    public function __construct()
    {
        $this->dompdf = new Dompdf();
        $this->dompdf->setPaper("A4","portait");
        
    }
    /**
     * Carrega  o html fornecido no parametro
     * @param string o html a ser imprimido
     */
    public function load(string $html){
        $this->html = $html;
    
    }
    /**
     * Cria uma tabela com os parametros dados 
     * @param array a lista de titulos para as colunas,ou seja o cabecalho
     * @param array um array com o conteudo da tabela, cada linha da tabela é um array(ex.array associativo )
     */
    public function loadTable(string $titulo,array $head_titles, $lines)
    {
        $html = "
        <h3 style='text-align:center;color:black;font-weight:bolder;font-family: Arial, Helvetica, sans-serif;'>{$titulo}</h3>
        <table border='1' style='margin:auto;font-family: Arial, Helvetica, sans-serif;'>";
            $html .= "<thead style='background-color:black;color:white'>
            <tr>";
            foreach ($head_titles as $key => $value) 
            {
                $html .="<th style='padding:5px;'>{$value}</th>";
            }
            $html .= "</tr></thead>";
    
            
            $html .= "<tbody>";
            
            foreach ($lines as  $values) 
            {     
                $html .= "<tr>";
                foreach ($values as $keys => $value) {
                    // if($keys == "foto"){continue;}
                    $html .="<td style='padding:5px;'>{$value}</td>";
                }
                $html .= "</tr>";
            }
            $html .= "</tbody>";

        $html .="</table>";
        
        $this->html = $html;
        
    }
    public function print()
    {
        $this->dompdf->loadHtml($this->html);
        $this->dompdf->render();
        $this->dompdf->stream();

    }
}