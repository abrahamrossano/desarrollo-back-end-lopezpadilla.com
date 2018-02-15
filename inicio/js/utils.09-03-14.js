function imgLoad(cual){
	$(cual).update("<img src=\"../imagen/loaderBig.gif\" align='center' />"); 	
}

function showForma(div, pagina, valor){
	imgLoad(div);
	new Ajax.Updater(div, pagina,{   
		parameters: valor + "&rnd="+Math.random(),
		method: 'post'	
	});	
}

function enviar(){
	var a= new Validation('filtros', {immediate:true,  focusOnError:true,stopOnFirst:true });          
	sigue=a.validate();
	if (sigue) {
		imgLoad('arTodos');
		new Ajax.Updater('arTodos', 'ajax/listado.php',{   
			parameters: $('filtros').serialize() + "&rnd="+Math.random(),
			method: 'post'	
		});	
	}
}

function validando(){
	var a= new Validation('datos', {immediate:true,  focusOnError:true,stopOnFirst:true });          
	sigue=a.validate();
	if (sigue) {
		var parForm = $('datos').serialize() + "&rnd="+Math.random()
		imgLoad('arTodos');		
		new Ajax.Request('ajax/validacion.php', {
			onComplete : function(resp) {
				$('arTodos').innerHTML = resp.responseText;
				/*var ret = $("res").value;
				if(ret == "0" || ret == 0){
					enviar();
				}*/
			},
		parameters : parForm,
		method: 'post'
		});
		
	}
}

function verAjax(div){
	var parForm = $('filtros').serialize() + "&rnd="+Math.random();
	imgLoad(div);
	new Ajax.Updater(div, 'ajax/cursos.php',{   
		parameters: parForm,
		method: 'post'	
	});
}

function enviaDatos(forma) {
	var a= new Validation(forma, {immediate:true,  focusOnError:true,stopOnFirst:true });          
	sigue=a.validate();
	if (sigue) {
		$(forma).submit();
	} 
}

function sel_values(nombre){
	var todos = document.getElementsByName(nombre);
	for(var i=0; i<todos.length; i++){
		if (!todos[i].checked == true){
			todos[i].disabled=true;
		}
	}
}

function enviaPromo(forma){
	var a= new Validation(forma, {immediate:true,  focusOnError:true,stopOnFirst:true });          
	sigue=a.validate();
	if (sigue) {
		sel_values("cursos");
		$(forma).submit();
	} 
}

function eliminar(message, url, id){  
	var answer = confirm(message);
	if (answer){
		new Ajax.Request(url, {
		onComplete : function(resp) {
			window.location.reload();
		},
		parameters : "id=" + id + "&rnd="+Math.random(),
		method: 'post'
		});
	}
}

function regresar(pagina){
	window.location =pagina;
}

function showPeriodo(div, datos){
	new Ajax.Request('ajax/formaPeriodo.php', {
		method:'post',
		parameters:  datos + "&rnd="+Math.random(),
		onSuccess: function(transport) {
			$(div).innerHTML = transport.responseText;
		},
		onComplete: function(transport) {
			try {
				// calendario para la fecha de inicio
				Calendar.setup({
					dateField      : 'inicial',
					triggerElement : 'btnCalInicio',
					selFinSemana	: false
				});
				
				// Calendario para la fecha de fin.
				Calendar.setup({
					dateField      : 'final',
					triggerElement : 'btnCalFinal',
					selFinSemana	: false
				});
					
			} catch (ex) {
			}
		},
		onFailure: function(){
			alert('Something went wrong...');
		}
	});	
}

function vaciarCal(elemento, valor){
	$(elemento).value= valor;
}