const clearForm = () => {
    $("#street").val("")
    $("#neighborhood").val("")
    $("#city").val("")
    $("#state").val("")
    $("#number").val("")
    $("#complement").val("")
    $("#input-cep").val("")
}

$(document).ready(function () {

    $('.sidenav').sidenav()

    $('.collapsible').collapsible()

    $("#input-cep").blur(function () {

        let cep = $(this).val().replace(/\D/g, '')
        if (cep != "") {

            let validacep = /^[0-9]{8}$/

            if (validacep.test(cep)) {

                $("#input-cep").val(cep)
                $("#street").val("Buscando dados...")
                $("#neighborhood").val("Buscando dados...")
                $("#complement").val("")
                $("#city").val("Buscando dados...")
                $("#state").val("Buscando dados...")

                let url = "https://viacep.com.br/ws/"

                $.getJSON(url + cep + "/json/", function (dados) {

                    if (!("erro" in dados)) {

                        $("#street").val(dados.logradouro)
                        $("#neighborhood").val(dados.bairro)
                        $("#city").val(dados.localidade)
                        $("#state").val(dados.uf)

                    } else {
                        clearForm()
                        alert("CEP não encontrado.")
                    }
                })
            } else {
                clearForm()
                alert("Formato de CEP inválido.")
            }
        }
        else {
            clearForm()
        }
    })

})
