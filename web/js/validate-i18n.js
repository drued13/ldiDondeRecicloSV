$(function() {
	if($("#lang").val() == "es_ES.utf8")
	{
		$.extend($.validator.messages, {
			required: "Este campo es requerido",
			email: "Por favor ingrese un email válido",
			maxlength: $.validator.format("muy largo"),
			minlength: $.validator.format("muy corto"),
			equalTo: 'Las contraseñas no coinciden'
		});
	
	}else
	{
		$.extend($.validator.messages, {
			required: "This field is required.",
			email: "Please enter a valid email address.",
			maxlength: $.validator.format("very long"),
			minlength: $.validator.format("very short"),
			equalTo: 'The passwords no match'
		});
	}
	
	
});



