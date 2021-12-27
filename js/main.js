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
        if(response=='Success'){
            alert("Projekat uspešno zakazan");
            console.log("Dodar projekat");
            location.reload(true);
        }else{
            console.log("Projekat nije dodat");
        }
    });

    request.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Sledeca greska se desila> '+textStatus, errorThrown)
    });
});