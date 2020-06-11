function enviar(event){
    var forms =  document.getElementsByClassName('needs-validation');
    Array.prototype.filter.call(forms, function (form) {
        if (form.checkValidity()) {
            if($("#senha").val() == $("#confirmacao").val()){
                let dadosFormulario = $(form).serialize();
                axios.post('core.php', dadosFormulario)
                .then(function (response) {
                    if(response.data.sucesso == true){
                        $("#alert-senhas").hide();
                        $("#alert-sucesso").show();
                    } else {
                        $("#alert-erro").show();
                    }
                });
            } else {
                event.preventDefault();
                event.stopPropagation();
                $("#alert-senhas").show();
            }
        } else {
            event.preventDefault()
            event.stopPropagation()
        }
        form.classList.add('was-validated')
    });
}

function buscar(event){
    
    let dadosFormulario = $('.formulario').serialize();
    axios.post('core.php', dadosFormulario)
    .then(function (response) {
        $('#dataTables').DataTable({
            data:response.data.dados,
            searching: false,
            columns: [
                {data: "nome", title: 'Nome'},
                {data: "email", title: 'Email'},
                {data: "telefone", title: 'Telefone'},
                {data: "bairro", title: 'Bairro'},
                {data: "cidade", title: 'Cidade'},
                {data: "estado", title: 'Estado'}
            ]
        });
    });
}

function entrar(event){
    $("#dados_formulario").hide();
    var forms =  document.getElementsByClassName('needs-validation');
    Array.prototype.filter.call(forms, function (form) {
        if (form.checkValidity()) {
            let dadosFormulario = $('.formulario').serialize();
            axios.post('core.php', dadosFormulario)
            .then(function (response) {
                if(response.data.sucesso != true){
                    $("#alert-erro").show();
                    return;
                }
                let dados = response.data.dados[0];
                console.log(dados);
                
                $("#codigo").val(dados.codigo);
                $("#nome").val(dados.nome);
                $("#telefone").val(dados.telefone);
                $("#estado").val(dados.estado);
                $("#bairro").val(dados.bairro);
                $("#cidade").val(dados.cidade);
                $("#dados_formulario").show();
            });
        } else {
            event.preventDefault()
            event.stopPropagation()
            
        }
        form.classList.add('was-validated')
    });
    
}

function atualizar(event){
    var forms =  document.getElementsByClassName('dados_formulario');
    Array.prototype.filter.call(forms, function (form) {
        if (form.checkValidity()) {
            let dadosFormulario = $(form).serialize();
            axios.post('core.php', dadosFormulario)
            .then(function (response) {
                if(response.data.sucesso == true){
                    $("#alert-sucesso").show();
                } else {
                    $("#alert-erro").show();
                }
            });
        } else {
            event.preventDefault()
            event.stopPropagation()
        }
        form.classList.add('was-validated')
    });
}

function excluir(){
    $("#acao").val("excluir");
    let dadosFormulario = $('.dados_formulario').serialize();
    axios.post('core.php', dadosFormulario)
    .then(function (response) {
        if(response.data.sucesso == true){
            $("#alert-sucesso-exclusao").show();
        } else {
            $("#alert-erro").show();
        }
    });
}

$("#alert-sucesso").hide();
$("#alert-erro").hide();
$("#dados_formulario").hide();
$("#alert-sucesso-alteracao").hide();
$("#alert-sucesso-exclusao").hide();
$("#alert-senhas").hide();