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
                "email": true
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
                required: "O preenchimento deste campo é obrigatório."
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
});