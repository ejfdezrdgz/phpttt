$("document").ready(function() {

    var enableformbtn = false;

    $(".signpassbox").keyup(function() {
        if ($('#sign_pass1').val() == $('#sign_pass2').val() && $('#sign_pass1').val() != '' && enableformbtn == true) {
            $('#passerrbox').text('');
            $('#signformbtn').attr('disabled', false);
        } else {
            $('#passerrbox').text('Invalid password');
            $('#signformbtn').attr('disabled', true);
        }
    });

    $('#sign_name').keyup(function() {
        let nameval = $('#sign_name').val();
        let linkurl = 'ajax.php?getname=' + nameval;
        if (nameval != '') {
            $.ajax({ url: linkurl }).done(function(data) {
                if (data == "true") {
                    enableformbtn = true;
                } else {
                    enableformbtn = false;
                }
            });
        }
    });

    // $('#sign_nick').keyup(function() {
    //     let nickval = $('#sign_nick').val();
    //     let linkurl = 'ajax.php?getname=' + nickval;
    //     if (nickval != '') {
    //         $.ajax({ url: linkurl }).done(function(data) {
    //         });
    //     }
    // });

});