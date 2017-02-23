$( document ).ready(function() {
    $('#postcode').mask('0000-000');

    $.validator.addMethod("validPtPhone", function(value, element) {
        if ($("#country").val() != 'PT') {
            return true;
        }
        return this.optional(element) || /^(?:9[1-36][0-9]|2[12][0-9]|2[35][1-689]|24[1-59]|26[1-35689]|27[1-9]|28[1-69]|29[1256])[0-9]{6}$/i.test(value);
    }, "O número deve ser válido em Portugal.");

    $.validator.addMethod("validPostcode", function(value, element) {
        return this.optional(element) || /^\d{4}-\d{3}$/.test(value);
    }, "");

    $("#regForm").validate({
        "onclick": true,
        "rules": {
            "email": {
                "required": true,
                "email": true,
                "remote": "ajax/isRegisteredEmail"
            },
            "email_conf": {
                "required": true,
                "equalTo": "#email"
            },
            "password": {
                "required": true,
                "minlength": 8
            },
            "password_conf": {
                "required": true,
                "equalTo": "#password"
            },
            "name": {
                "required": true
            },
            "last_name": {
                "required": true
            },
            "nif": {
                "digits": true,
                "minlength": 9
            },
            "phone": "validPtPhone",
            "postcode": "validPostcode"
        },
        messages: {
            'email': {
                required: "O preenchimento deste campo é obrigatório.",
                email: "Utilize um email válido.",
                remote: "Este email já está registado."
            },
            'email_conf': {
                required: "O preenchimento deste campo é obrigatório.",
                equalTo: "O email deve ser idêntico ao anterior."
            },
            'password': {
                required: "O preenchimento deste campo é obrigatório.",
                minlength: ""
            },
            'password_conf': {
                required: "O preenchimento deste campo é obrigatório.",
                equalTo: "A password deve ser idêntica à anterior."
            },
            'name': {
                required: ""
            },
            'last_name': {
                required: "O preenchimento deste campo é obrigatório."
            },
            'nif': {
                digits: "Utilize somente números.",
                minlength: "Este campo deve conter 9 números."
            }
        }
    });

    $( "#password" ).keyup(function() {
        var value = $(this).val();
        var score = 0;

        if ($("#progress-bar").hasClass('safe-pass')) {
            $("#progress-bar").removeClass('safe-pass');
        }

        if ($("#progress-bar").hasClass('very-safe-pass')) {
            $("#progress-bar").removeClass('very-safe-pass');
        }

        if (value.length > 0) {
            $(".password-box").css('visibility', 'visible');

            //only evaluate the password if its size is greater or equal than 8
            if (value.length >= 8) {
                //This condition verifies if there is at least one special character
                if (/[^\w]/.test(value)) {
                    score++;
                }

                //This condition verifies the existence of a number
                if (/[\d]/.test(value)) {
                    score++;
                }

                //One uppercase character increases one more point
                if (/[A-Z]/.test(value)) {
                    score++;
                }

                //Finally the last condition is checking for one lowercase letter
                if (/[a-z]/.test(value)) {
                    score++;
                }

                //If at the final the score is like 2 or 3, then it is a safe password
                if (score > 1 && score < 4) {
                    $("#progress-bar").addClass('safe-pass');
                }
                //However if it attends all requirements then the password is very safe
                else if (score >= 4) {
                    $("#progress-bar").addClass('very-safe-pass');
                }
            }
        } else {
            $(".password-box").css('visibility', 'hidden');
        }
    });
});
