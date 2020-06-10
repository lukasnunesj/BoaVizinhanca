function enviar(event){
    var forms =  document.getElementsByClassName('needs-validation');
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

function buscar(event){
    var forms =  document.getElementsByClassName('needs-validation');
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



$("#alert-sucesso").hide();
$("#alert-erro").hide();