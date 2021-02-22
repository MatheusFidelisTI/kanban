
function carregaCard(){

    const filtro_curso     = document.getElementById('select-filtro-curso').value;
    const num_aula         = document.getElementById('select-filtro-num-aula').value;
    const filtro_professor = document.getElementById('input-filtro-professor').value;
    const ordenar_por      = document.getElementById('select-filtro-ordenar-por').value;
    const ordenar_por_modo = document.getElementById('select-filtro-ordenar-por_modo').value;
    dados = [];

    if(filtro_curso == 'n' && num_aula == 'n' && filtro_professor == '')
    {
       
        $.ajax({
            method: "POST",
            url: "http://localhost/TESTE_PHP/Home/boardlist",
            data: "ordenar_por="+ordenar_por+"&ordenar_por_modo="+ordenar_por_modo,
            success: function (retorna) {
                document.getElementById('dados_card').innerHTML = retorna;
            }
        })
    }
    else
    {
        $.ajax({
            method: "POST",
            url: "http://localhost/TESTE_PHP/Home/boardlist",
            data: "filtro_curso="+filtro_curso+"&num_aula="+num_aula+"&filtro_professor="+filtro_professor+"&ordenar_por="+ordenar_por+"&ordenar_por_modo="+ordenar_por_modo,
            success: function (retorna) {
                
                document.getElementById('dados_card').innerHTML = retorna;
            }
        })
    }

}
function cardProximo(id_card,id_status){
  
        $.ajax({
            method: "POST",
            url: "http://localhost/TESTE_PHP/Home/validaProximo",
            data: "id_card="+id_card+"&id_status="+id_status,
            success: function (retorna) {
                if(retorna == 'N'){
                    alertSA("Card sem professor cadastrado. Operação abortada!!");
                }
                if(retorna == 'ERRO_MINUTO'){
                    alertSA("Ultima movimentação a menos de Um minuto, Tente novamente mais tarde.");
                }
                if(retorna == 'MOVIDO')
                {  
                    carregaCard();
                    setTimeout(function(){movido()}, 500);
                }
               
            }
        })

}
function cardVoltar(id_card,id_status){

        $.ajax({
            method: "POST",
            url: "http://localhost/TESTE_PHP/Home/validaVoltar",
            data: "id_card="+id_card+"&id_status="+id_status,
            success: function (retorna) {
                if(retorna == 'MOVIDO')
                {
                    carregaCard();
                    setTimeout(function(){movido()}, 500);
                }
                
            }
        })

}

function movido()
{
    $(function() {  
        toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "2500",
        "timeOut": "2500",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
        };
        toastr.success('Card Movimentado!!', 'Sucesso');
    });
}

function alertSA(msg)
{
    $(function() {  
        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: msg
        })
    });
}