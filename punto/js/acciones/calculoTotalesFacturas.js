document.getElementById('valorItem').addEventListener('change', function(){

        impuestos= ((limpiadorCaracteresConPunto(valorItem.value) * cantidad.value)*impuesto.value)/100;
        valorBruto= limpiadorCaracteresConPunto(valorItem.value) * cantidad.value;
        valorNeto = valorBruto+impuestos;

    $("#subTotal").html((valorNeto));
    $("#subTotalGlobal").html("$ "+valorBruto+"");
    $("#taxGlobal").html("$ "+impuestos+"");
    $("#totalGlobal").html("$"+valorNeto+"");
    
   
   });


document.getElementById('cantidad').addEventListener('change', function(){

        impuestos= ((limpiadorCaracteresConPunto(valorItem.value) * cantidad.value)*impuesto.value)/100;
        valorBruto= limpiadorCaracteresConPunto(valorItem.value) * cantidad.value;
        valorNeto = valorBruto+impuestos
        $("#subTotal").html((valorNeto));
        $("#subTotalGlobal").html("$ "+valorBruto+"");
        $("#taxGlobal").html("$ "+impuestos+"");
        $("#totalGlobal").html("$"+valorNeto+"");
   });


document.getElementById('impuesto').addEventListener('change', function(){

     impuestos= ((limpiadorCaracteresConPunto(valorItem.value) * cantidad.value)*impuesto.value)/100;
     valorBruto= limpiadorCaracteresConPunto(valorItem.value) * cantidad.value;
     valorNeto = valorBruto+impuestos
    $("#subTotal").html((valorNeto));
    $("#subTotalGlobal").html("$ "+valorBruto+"");
    $("#taxGlobal").html("$ "+impuestos+"");
    $("#totalGlobal").html("$"+valorNeto+"");
   });
