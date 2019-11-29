function controltieneproducto() {
    var valorCheckBox = $('input[name="swichtieneproducto"]:checked').val(); //Valor del checkbox 
    var notiene = $('#radio2'); //Div de no tiene boton
    var sitiene = $('#radio1'); //Div de tiene boton

    //Si el checkbox es uno muestra las opciones 
    if (valorCheckBox == 0) {
        $('#radio1').show(); //Muestro el boton tiene
        $('#radio2').hide(); //Oculto el boton no tiene
    } else {
        //Si el checkbox es cero muestra las opciones
        $('#radio1').hide(); //Oculto el boton tiene
        $('#radio2').show(); //Muestro el boton no tiene
    }
    //Limpio todos los campo si hay un cambio en el swicht
    $('input[name="swichtieneproducto"]').on('click', function() {
        $('#radio1').hide(); //Limpira el campo 
        $('#radio2').hide(); //Limpia el campo 

    })

}