$('#dodajForm').submit(function(){
    event.preventDefault();
    console.log("Dodavanje");
    const $form =$(this);
    const $input = $form.find('input, select, button, textarea');

    const serijalizacija = $form.serialize();
    console.log(serijalizacija);

    $input.prop('disabled', true);

    request = $.ajax({
        url: 'handler/add.php',
        type:'post',
        data: serijalizacija
    });

    request.done(function(response, textStatus, jqXHR){
        
            alert("Projekat uspešno zakazan");
            console.log("Dodar projekat");
            location.reload(true);
      
    });

    request.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Sledeca greska se desila> '+textStatus, errorThrown)
    });
});




$('#btn-obrisi').click(function(){
    console.log("Brisanje");

    const checked = $('input[name=cekiranje]:checked');

    req = $.ajax({
        url: 'handler/delete.php',
        type:'post',
        data: {'id':checked.val()}
    });

    req.done(function(res, textStatus, jqXHR){
        if(res=='Success'){
           checked.closest('tr').remove();
           alert('Obrisan projekat');
           console.log('Obrisan');
        }else {
        console.log("Projekat nije obrisan "+res);
        alert("Projekat nije obrisan ");

        }
        console.log(res);
    });

});