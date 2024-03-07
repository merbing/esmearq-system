<script>
document.addEventListener("DOMContentLoaded", function() {
    var urlParams = new URLSearchParams(window.location.search);
    var status = urlParams.get('status');

    if (status) {
        switch (status) {
            case "sucesso":
                alert("Cadastro de Cliente concluído com sucesso! Conta do Cliente: " + urlParams.get('conta_do_cliente'));
                break;
            case "erro_atividade":
                alert("Erro ao adicionar atividade");
                break;
            case "erro":
                alert("Erro ao cadastrar cliente");
                break;
            case "erro_idade":
                alert("Idade mínima de 18 anos necessária");
                break;
            case "erro_senha":
                alert("Erro: Senha não fornecida");
                break;
            case "erro_404":
                alert("Erro: O cliente adicionado não foi encontrado");
                break;
            case "erro_email_existente":
                alert("Erro: E-mail duplicado");
                break;
        }
    }
});
</script>
