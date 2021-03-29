const clearForm = () => {
    $("#street").val("")
    $("#neighborhood").val("")
    $("#city").val("")
    $("#state").val("")
    $("#num").val("")
    $("#complement").val("")
    $("#zipcode").val("")
}

const checkInput = (e)=>{
    let inputName = e.target.name
    let label = $("label[for=" + inputName + "]").html()
    
    let toast = '<span class="white-text">O Campo ' + label + ' esta Vazio!</span><button class="btn-flat toast-action">Undo</button>'

    if(!e.target.value){
            M.toast({html: toast, classes: 'red'})
    }
}

const searchcep = (e) =>{
        
        let cep = e.target.value

        cep = cep.replace(/\D/g, '')
        
        if (cep != "") {

            let validacep = /^[0-9]{8}$/

            if (validacep.test(cep)) {

                $("#zipcode").val(cep)
                $("#street").val("Buscando dados...")
                $("#neighborhood").val("Buscando dados...")
                $("#complement").val("Buscando dados...")
                $("#city").val("Buscando dados...")
                $("#state").val("Buscando dados...")

                let url = "https://viacep.com.br/ws/"

                $.getJSON(url + cep + "/json/", function (dados) {
                    
                    if (!("erro" in dados)) {
                        $("#complement").val("")
                        $("#street").val(dados.logradouro)
                        $("#neighborhood").val(dados.bairro)
                        $("#city").val(dados.localidade)
                        $("#state").val(dados.uf)

                    } else {
                        clearForm()
                        let msg = '<span class="white-text">"CEP não encontrado!</span><button class="btn-flat toast-action">Undo</button>'
                        M.toast({html: msg, classes: 'red'})
                    
                    }
                })
            } else {
                clearForm()
                let msg = '<span class="white-text">"CEP não encontrado!</span><button class="btn-flat toast-action">Undo</button>'
                M.toast({html: msg, classes: 'red'})
            }
        }
        else {
            clearForm()
            let msg = '<span class="white-text">"CEP Invalido!</span><button class="btn-flat toast-action">Undo</button>'
                M.toast({html: msg, classes: 'red'})
        }
}
$(document).ready( ()=> {

    $('#first_name').blur(checkInput)
    $('#last_name').blur(checkInput)
    $('#zipcode').blur(checkInput)
    $('#city').blur(checkInput)
    $('#street').blur(checkInput)
    $('#state').blur(checkInput)
    $('#num').blur(checkInput)
    $('#neighborhood').blur(checkInput)
    $("#zipcode").blur(searchcep)

    $('.sidenav').sidenav()
    $('.collapsible').collapsible()
})
