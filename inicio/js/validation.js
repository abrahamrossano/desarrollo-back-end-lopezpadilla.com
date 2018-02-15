/*
* Really easy field validation with Prototype
* http://tetlaw.id.au/view/javascript/really-easy-field-validation
* Andrew Tetlaw
* Version 1.5.4.1 (2007-01-05)
* 
* Copyright (c) 2007 Andrew Tetlaw
* Permission is hereby granted, free of charge, to any person
* obtaining a copy of this software and associated documentation
* files (the "Software"), to deal in the Software without
* restriction, including without limitation the rights to use, copy,
* modify, merge, publish, distribute, sublicense, and/or sell copies
* of the Software, and to permit persons to whom the Software is
* furnished to do so, subject to the following conditions:
* 
* The above copyright notice and this permission notice shall be
* included in all copies or substantial portions of the Software.
* 
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
* EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
* MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
* NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS
* BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN
* ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
* CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
* SOFTWARE.
* 
*/


var Errors = {
  msgT: "Error",
  i:0,
  error: function(id1,msg) { 
		$$('.val-jmcj-error_').each(function (a,b)
				{
						//alert(a+"-"+b);
						$(a.id).remove();
				}
			);   
		id1.each (function (id)
		{
				
				error_s=true;
				var input1 = document.createElement('div');
				input1.setAttribute('name','error_');
				input1.setAttribute('class','val-jmcj-error_');
				input1.setAttribute('id','error_');
				input1.innerHTML=msg;
				input1.className="validation-advice val-jmcj-error_";
				$(id).parentNode.appendChild(input1);	
				input1.id='error_';
		} ); 
  },
  clear: function()
  {
	  	$$('.val-jmcj-error_').each(function (a,b)
			{
					$(a.id).remove();
			}
		);   
	  }
}

var Validator = Class.create();

Validator.prototype = {
	initialize : function(className, error, test, options) {
		if(typeof test == 'function'){
			this.options = $H(options);
			this._test = test;
		} else {
			this.options = $H(test);
			this._test = function(){return true};
		}
		this.error = error || 'Validation failed.';
		this.className = className;
	},
	test : function(v, elm) {
		return (this._test(v,elm) && this.options.all(function(p){
			return Validator.methods[p.key] ? Validator.methods[p.key](v,elm,p.value) : true;
		}));
	}
}
Validator.methods = {
	pattern : function(v,elm,opt) {return Validation.get('IsEmpty').test(v) || opt.test(v)},
	minLength : function(v,elm,opt) {return v.length >= opt},
	maxLength : function(v,elm,opt) {return v.length <= opt},
	min : function(v,elm,opt) {return v >= parseFloat(opt)}, 
	max : function(v,elm,opt) {return v <= parseFloat(opt)},
	notOneOf : function(v,elm,opt) {return $A(opt).all(function(value) {
		return v != value;
	})},
	oneOf : function(v,elm,opt) {return $A(opt).any(function(value) {
		return v == value;
	})},
	is : function(v,elm,opt) {return v == opt},
	isNot : function(v,elm,opt) {return v != opt},
	equalToField : function(v,elm,opt) {return v == $F(opt)},
	notEqualToField : function(v,elm,opt) {return v != $F(opt)},
	include : function(v,elm,opt) {return $A(opt).all(function(value) {
		return Validation.get(value).test(v,elm);
	})}
}

var Validation = Class.create();

Validation.prototype = {
	initialize : function(form, options){
		this.options = Object.extend({
			onSubmit : true,
			stopOnFirst : false,
			immediate : false,
			focusOnError : true,
			useTitles : false,
			onFormValidate : function(result, form) {},
			onElementValidate : function(result, elm) {}
		}, options || {});
		this.form = $(form);
		if(this.options.onSubmit) Event.observe(this.form,'submit',this.onSubmit.bind(this),false);
		if(this.options.immediate) {
			var useTitles = this.options.useTitles;
			var callback = this.options.onElementValidate;
			Form.getElements(this.form).each(function(input) { // Thanks Mike!
				Event.observe(input, 'blur', function(ev) { Validation.validate(Event.element(ev),{useTitle : useTitles, onElementValidate : callback}); });
			});
		}
	},
	onSubmit :  function(ev){
		if(!this.validate()) Event.stop(ev);
	},
	validate : function() {
		var result = false;
		var useTitles = this.options.useTitles;
		var callback = this.options.onElementValidate;
		if(this.options.stopOnFirst) {
			result = Form.getElements(this.form).all(function(elm) { return Validation.validate(elm,{useTitle : useTitles, onElementValidate : callback}); });
		} else {
			result = Form.getElements(this.form).collect(function(elm) { return Validation.validate(elm,{useTitle : useTitles, onElementValidate : callback}); }).all();
		}
		if(!result && this.options.focusOnError) {
			Form.getElements(this.form).findAll(function(elm){return $(elm).hasClassName('validation-failed')}).first().focus()
		}
		this.options.onFormValidate(result, this.form);
		return result;
	},
	reset : function() {
		Form.getElements(this.form).each(Validation.reset);
	}
}

Object.extend(Validation, {
	validate : function(elm, options){
		options = Object.extend({
			useTitle : false,
			onElementValidate : function(result, elm) {}
		}, options || {});
		elm = $(elm);
		var cn = elm.classNames();
		return result = cn.all(function(value) {
			var test = Validation.test(value,elm,options.useTitle);
			options.onElementValidate(test, elm);
			return test;
		});
	},
	test : function(name, elm, useTitle) {
		var v = Validation.get(name);
		var prop = '__advice'+name.camelize();
		try {
		if(Validation.isVisible(elm) && !v.test($F(elm), elm)) {
			if(!elm[prop]) {
				var advice = Validation.getAdvice(name, elm);
				if(advice == null) {
					var errorMsg = useTitle ? ((elm && elm.title) ? elm.title : v.error) : v.error;
					advice = '<div class="validation-advice" id="advice-' + name + '-' + Validation.getElmID(elm) +'" style="display:none">' + errorMsg + '</div>'
					switch (elm.type.toLowerCase()) {
						case 'checkbox':
						case 'radio':
							var p = elm.parentNode;
							if(p) {
								new Insertion.Bottom(p, advice);
							} else {
								new Insertion.After(elm, advice);
							}
							break;
						default:
							new Insertion.After(elm, advice);
				    }
					advice = Validation.getAdvice(name, elm);
				}
				if(typeof Effect == 'undefined') {
					advice.style.display = 'block';
				} else {
					
					new Effect.Appear(advice, {duration : 2 });
					//new Effect.BlindDown(advice, {duration : 1 });
				
					
	
				}
			}
			elm[prop] = true;
			elm.removeClassName('validation-passed');
			elm.addClassName('validation-failed');
			return false;
		} else {
			var advice = Validation.getAdvice(name, elm);
			if(advice != null) advice.hide();
			elm[prop] = '';
			elm.removeClassName('validation-failed');
			elm.addClassName('validation-passed');
			return true;
		}
		} catch(e) {
			throw(e)
		}
	},
	isVisible : function(elm) {
		while(elm.tagName != 'BODY') {
			if(!$(elm).visible()) return false;
			elm = elm.parentNode;
		}
		return true;
	},
	getAdvice : function(name, elm) {
		return $('advice-' + name + '-' + Validation.getElmID(elm)) || $('advice-' + Validation.getElmID(elm));
	},
	getElmID : function(elm) {
		return elm.id ? elm.id : elm.name;
	},
	reset : function(elm) {
		elm = $(elm);
		var cn = elm.classNames();
		cn.each(function(value) {
			var prop = '__advice'+value.camelize();
			if(elm[prop]) {
				var advice = Validation.getAdvice(value, elm);
				advice.hide();
				elm[prop] = '';
			}
			elm.removeClassName('validation-failed');
			elm.removeClassName('validation-passed');
		});
	},
	add : function(className, error, test, options) {
		var nv = {};
		nv[className] = new Validator(className, error, test, options);
		Object.extend(Validation.methods, nv);
	},
	addAllThese : function(validators) {
		var nv = {};
		$A(validators).each(function(value) {
				nv[value[0]] = new Validator(value[0], value[1], value[2], (value.length > 3 ? value[3] : {}));
			});
		Object.extend(Validation.methods, nv);
	},
	get : function(name) {
		return  Validation.methods[name] ? Validation.methods[name] : Validation.methods['_LikeNoIDIEverSaw_'];
	},
	methods : {
		'_LikeNoIDIEverSaw_' : new Validator('_LikeNoIDIEverSaw_','',{})
	}
});

Validation.add('IsEmpty', '', function(v) {	
				return  (((v == null) ||  /^\s+$/.test(v) ) || v.length ==0 );
			});


Validation.add('IsFecha', 'No es una Fecha', function(v,elm) {	
			if(Validation.get('IsEmpty').test(v)) return false;
			if(v== "0/0/0" || v == "00/00/00") return true;
				var regex = /^(\d{1,2})\/(\d{1,2})\/(\d{4})$/;
				if(!regex.test(v)) return false;
				var d = new Date(v.replace(regex, '$2/$1/$3'));
				return ( parseInt(RegExp.$2, 10) == (1+d.getMonth()) ) && 
							(parseInt(RegExp.$1, 10) == d.getDate()) && 
							(parseInt(RegExp.$3, 10) == d.getFullYear() );
			});



Validation.addAllThese([
	['required', '<img src ="validation/alerta.png" /> Campo Requerido.', function(v) {				
				return !Validation.get('IsEmpty').test(v);
			}],
	['validate-number', '<img src ="validation/alerta.png" /> N&uacute;mero inv&aacute;lido. Introducir s&oacute;lo valores num&eacute;ricos', function(v) {
			//	alert(Validation.get('IsEmpty').test(v) || (!isNaN(v) && !/^\s+$/.test(v)));
				return Validation.get('IsEmpty').test(v) || (!isNaN(v) && !/^\s+$/.test(v));
			}],
	
	['validate-positivo', '<img src ="validation/alerta.png" /> N&uacute;mero inv&aacute;lido. Introducir s&oacute;lo valores num&eacute;ricos positivos', function(v) {
			//	alert(Validation.get('IsEmpty').test(v) || (!isNaN(v) && !/^\s+$/.test(v)));
				return Validation.get('validate-number').test(v) && (v>=0);
			}],
	
	['validate-digits', '<img src ="validation/alerta.png" /> Escriba s&oacute;lo digitos sin espacios ni otro simbolo.', function(v) {
				return Validation.get('IsEmpty').test(v) ||  !/[^\d]/.test(v);
			}],
	['validate-alpha', '<img src ="validation/alerta.png" /> S&oacute;lo letras permitidas (a-z).', function (v) {
				return Validation.get('IsEmpty').test(v) ||  /[A-Za-z]+$/.test(v) // /^[A-Za-z]+$/.test(v)
			}],
	['validate-alphanum', '<img src ="validation/alerta.png" /> Please use only letters (a-z) or numbers (0-9) only in this field. No spaces or other characters are allowed.', function(v) {
				return Validation.get('IsEmpty').test(v) ||  !/\W\s/.test(v)
			}],
	['validate-date', '<img src ="validation/alerta.png" /> Introduce una fecha v&aacute;lida.', function(v) {
				var test = new Date(v);
				return Validation.get('IsEmpty').test(v) || !isNaN(test);
			}],
	['validate-email', '<img src ="validation/alerta.png" /> Escriba una direcci&oacute;n de correo v&aacute;lida. por ejemplo nombre@dominio.com', function (v) {
				return Validation.get('IsEmpty').test(v) || /\w{1,}[@][\w\-]{1,}([.]([\w\-]{1,})){1,3}$/.test(v)
			}],
	['validate-url', '<img src ="validation/alerta.png" /> URL inv&aacute;lida.', function (v) {
				return Validation.get('IsEmpty').test(v) || /^(http|https|ftp):\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)(:(\d+))?\/?/i.test(v)
			}],
	['validate-curp', '<img src ="validation/alerta.png" /> CURP inv&aacute;lida.XXXX######xxxxx##', function (v) {			
				return Validation.get('IsEmpty').test(v) || /\w{4}\d{6}[M,H][A-Z]{5}\d{2}$/.test(v)
				
			}],
	['validate-rfc', '<img src ="validation/alerta.png" /> RFC inv&aacute;lido. XXXX######XXX', function (v) {			
				return Validation.get('IsEmpty').test(v) || /[\w|\&]{3,4}\d{6}\w{3}$/.test(v)
			}],
	['validate-non-cero', '<img src ="validation/alerta.png" /> No puede ser 0', function (v) {			
				return (v!= 0)
			}],
	
	['validate-dias-salario', '<img src ="validation/alerta.png" /> Los dias de sancion de salario mayores a cero', function (v) {
				return (v>=0);
			}],
	
	['validate-porciento', ' ', function (v) {
				var total=0;															
				var porcentaje = $$('.validate-porciento');
				var err_p=0;
				  porcentaje.each( function(el, indice){
					if ( el.value > 0 )
				  		total+=parseInt(el.value);
				  	else
					{
						//alert("Sumatoria de porcentaje incorrecta, la Sumatoria debe ser 100%. \nte faltan "+ (100-total));
						el.value=1;
						total+=1;
						err_p++;
//				  		return (total==999)
					}
					
				  });					
				  if (total != 100 || err_p > 0 ) alert("Sumatoria de porcentaje incorrecta, la Sumatoria debe ser 100%. \nte faltan "+ (100-total));
				return (total == 100 )
					
			}],
	['validate-compara', '', function (v,el) {
				var advice = Validation.getAdvice('validate-compara', el);
				var Merror="El valor debe estar entre 0 y "+$('cmp_'+el.id).value+"";
				if(advice == null) {						
					var p = el.parentNode;
					advice = '<div class="validation-advice" id="advice-'+'validate-compara'+'-' + Validation.getElmID(el) +'" style="display:block"> '+Merror+'</div>';

					new Insertion.Bottom(p, advice);
				}
				else
				{					
					advice.style.display = 'block';
				}	
			
					return ( el.value >= 0  &&  (parseInt($('cmp_'+el.id).value) >= v) );
					  
						
				}],
	['validate-extencion', ' ', function (v,el) {
			if(Validation.get('IsEmpty').test(v)) return true;			
			var name= v.split(".");
			var ext=name[name.length-1];
			var regex=/\s*\w*\s*(\/([A-Za-z]{3,4}[,]?)*\/)(\s\w\s)*/;
			css=el.className;
			var reg=regex.exec(css);
			var permitidos=(RegExp.$1).replace(/\//g, "");
			var Merror="El archivo debe estar en formato ("+(permitidos)+")";
			if (true) 
			{
				var advice = Validation.getAdvice('validate-extencion', el);
				if(advice == null) {						
					var p = el.parentNode;
					advice = '<div class="validation-advice" id="advice-'+'validate-extencion'+'-' + Validation.getElmID(el) +'" style="display:block"> '+Merror+'</div>';

					new Insertion.Bottom(p, advice);
				}
				else
				{					
					advice.style.display = 'block';
				}
			}
			
			return (  permitidos.split(",").any(function (a,b){
				return(a == ext) ; 
			}));

			
			
				}],

	['validate-date-es', '<img src ="validation/alerta.png" /> Utiliza este formato de fecha: dd/mm/yyyy.', function(v) {
				if(Validation.get('IsEmpty').test(v)) return true;
				var regex = /^(\d{1,2})\/(\d{1,2})\/(\d{4})$/;
				if(!regex.test(v)) return false;
				var d = new Date(v.replace(regex, '$2/$1/$3'));
				return ( parseInt(RegExp.$2, 10) == (1+d.getMonth()) ) && 
							(parseInt(RegExp.$1, 10) == d.getDate()) && 
							(parseInt(RegExp.$3, 10) == d.getFullYear() );
			}],

		
	['validate-fecha', '<img src ="validation/alerta.png" /> Utiliza este formato de fecha: dd/mm/yyyy.', function(v,elm) {			
			var nombrecampo=elm.name.replace("anio","");		
			var Vfecha= $('dia'+nombrecampo).value + "/" + $('mes'+nombrecampo).value + "/" + v;					
			return Validation.get('IsFecha').test(Vfecha,elm) 
	}],
	
	['validate-fecha-mayor-hoy', '<img src ="validation/alerta.png" /> Utiliza este formato de fecha: dd/mm/yyyy y tiene que ser mayor o igual a hoy.', function(v,elm) {			
			var nombrecampo=elm.name.replace("anio","");
			var Vfecha= $('dia'+nombrecampo).value + "/" + $('mes'+nombrecampo).value + "/" + v;
			var Vfecha2= v + "/" + $('mes'+nombrecampo).value + "/" + $('dia'+nombrecampo).value ;			
			var d= new Date();
			var d1= new Date(Vfecha2);
			var correcto= false;
			if (d1.getFullYear()>d.getFullYear()) {
				correcto= true;	
			}else{
				if((d1.getFullYear()==d.getFullYear())){
					if (d1.getMonth()>d.getMonth()) correcto= true;	
					else {
						if (d1.getMonth()==d.getMonth())
							if(d1.getDate()>=d.getDate()) correcto= true;
					}
				}
				//correcto = true;
			}
			return Validation.get('IsFecha').test(Vfecha,elm) && (correcto);
			//return false;
	}],

	['validate-mayor-hoy', '<img src ="validation/alerta.png" /> La fecha tiene que ser mayor a hoy.', function(v,elm) {						
			var d= new Date();
			var d1= new Date(v);
			var correcto= false;
			if (d1.getFullYear()>d.getFullYear()) {
				correcto= true;	
			}else{
				if((d1.getFullYear()==d.getFullYear())){
					if (d1.getMonth()>d.getMonth()) {
						correcto= true;	
					}else {
						if (d1.getMonth()==d.getMonth()){
							if(d1.getDate()>d.getDate()) {
								correcto= true;
							}
						}
					}
				}
				//correcto = true;
			}
			return Validation.get('IsEmpty').test(v,elm) && (correcto);
			//return false;
	}],

	['validate-fecha-rango', '<img src ="validation/alerta.png" /> Verifica bien las fechas', function(v,elm) {			
			var nfin=elm.name.replace("anio","");
			if(isNaN(nfin)){
				var arrAux = nfin.split("_");
				ninicio=""
				for(i=0; i<arrAux.length-1; i++){
					ninicio= ninicio+arrAux[i]+"_";
				}
				ninicio=ninicio+(arrAux[i]-1);
			}else{
				ninicio=nfin-1;
			}
			nombrecampo=ninicio;
			var Vfecha		= 	$('dia'+nombrecampo).value + "/" + $('mes'+nombrecampo).value + "/" + $('anio'+nombrecampo).value ;
			
			$('anio'+nombrecampo).className=$('anio'+nombrecampo).className + " validate-fecha ";				
			nombrecampo=nfin;
			var VfechaFin	= 	$('dia'+nombrecampo).value + "/" + $('mes'+nombrecampo).value + "/" + $('anio'+nombrecampo).value ;
				$('anio'+nombrecampo).className=$('anio'+nombrecampo).className + " validate-fecha ";
			nombrecampo=ninicio;
			var fecha1=$('anio'+nombrecampo).value;
			if(parseInt($('mes'+nombrecampo).value) <=9)
				fecha1=fecha1+"0";
			fecha1= fecha1+$('mes'+nombrecampo).value; 
			if(parseInt($('dia'+nombrecampo).value) <=9)
				fecha1=fecha1+"0";			
			fecha1= fecha1+$('dia'+nombrecampo).value;
			nombrecampo=nfin;

			var fecha2=$('anio'+nombrecampo).value;
			if(parseInt($('mes'+nombrecampo).value) <=9)
				fecha2=fecha2+"0";
			fecha2= fecha2+$('mes'+nombrecampo).value; 
			if(parseInt($('dia'+nombrecampo).value) <=9)
				fecha2=fecha2+"0";			
			fecha2= fecha2+$('dia'+nombrecampo).value;
			if (fecha1 > fecha2) 
				Merror="Fecha de inicio no puede ser mayor que la final";
				
			if (fecha1 > fecha2) 
			{
				var advice = Validation.getAdvice('validate-fecha-rango', elm);
				if(advice == null) {						
					var p = elm.parentNode;
					advice = '<div class="validation-advice" id="advice-'+'validate-fecha-rango'+'-' + Validation.getElmID(elm) +'" style="display:block"> '+Merror+'</div>';

					new Insertion.Bottom(p, advice);
				}
				else
				{					
					advice.style.display = 'block';
				}
			}
			
			return Validation.get('IsFecha').test(Vfecha,$('anio'+nombrecampo)) && Validation.get('IsFecha').test(VfechaFin,elm) && fecha1 <= fecha2;
	}],	
	
		['validate-compara', ' Deben ser iguales', function (v,el) {
			if(Validation.get('IsEmpty').test(v)) return true;			
			
			var ext=name[name.length-1];
			var regex=/\s*\w*\s*(\/(\w*[,]?)*\/)(\s\w\s)*/;
			css=el.className;
			var reg=regex.exec(css);
			var permitidos=(RegExp.$1).replace(/\//g, "");
			///alert($(permitidos).value  + " -- "+v);
			return ($(permitidos).value  == v );
			
				}],
		
	['validate-selection', '<img src ="validation/alerta.png" /> Seleccione una opcion', function(v,elm){			
			//return (elm.length == 0 || elm.selectedIndex == 0 )  || !Validation.get('IsEmpty').test(v) 
			return elm.options ? elm.selectedIndex > 0 : !Validation.get('IsEmpty').test(v);
		}],			


	['validate-selection-varios', '<img src ="validation/alerta.png" /> Seleccione una opcion al menos', function(v,elm){			
			//return (elm.length == 0 || elm.selectedIndex == 0 )  || !Validation.get('IsEmpty').test(v)
			var selec=0;
			var i;
			 for(i=0; i< elm.options.length; i++){
				if(elm.options[i].selected ) {
					selec = selec +1;
				}
			 }
			return (selec >0);
		}],			

		
			
	['validate-currency-pesos', '<img src ="validation/alerta.png" /> Escriba  $ para dinero. Por ejemplo $100.00 .', function(v) {			
				return Validation.get('IsEmpty').test(v) ||  /^\$?\-?([1-9]{1}[0-9]{0,2}(\,[0-9]{3})*(\.[0-9]{0,2})?|[1-9]{1}\d*(\.[0-9]{0,2})?|0(\.[0-9]{0,2})?|(\.[0-9]{1,2})?)$/.test(v)

			}],
	/*['validate-one-required', 'Seleccione alguna de estas opciones.', function (v,elm) {		
				var p = elm.parentNode;
				var options = p.getElementsByTagName('INPUT');
				return ( $A(options).any(function(elm) {			
					return $F(elm);
				}));
			}]*/

	['validate-same', '<img src ="validation/alerta.png" /> Los valores deben ser iguales.', function (v,elm) {		
			  var name= elm.name;
			  var arr=document.getElementsByName(name);
			  var class1=elm.className;
			  for(var i= 0; i<arr.length; i++){
				  if(arr[i].className.indexOf('validate-same') > -1  ){
					if (v != arr[i].value) return false;
				  }
			  }
			  var n=name.split("_");
			  $(n[1]).value=v;
			  return true;
			}],

	['validate-iguales', '<img src ="validation/alerta.png" /> La clave y su confirmaci&oacute;n deben ser iguales', function (v,elm) {		
			  var name= elm.name;
			  var n=name.split("_");
			  if ($(n[1]).value== v)
			  	return true;
			  else 
			  	return false;
			}],


	['validate-one-required', '<img src ="validation/alerta.png" /> Seleccione alguna de estas opciones.', function (v,elm) {		
				var p = elm.parentNode;
				var options2 = p.getElementsByTagName('INPUT');
				return ( $A(options2).any(function(elm) {			
					if ((elm.type.toLowerCase() == "checkbox") || (elm.type.toLowerCase() == "radio"))
						return $F(elm);
					else
						return false;
					// si marca un error en explorer es por el padre, revisar ese peque�o detalle
				}));
			}],
	
	['validate-one-required-fila', '<img src ="validation/alerta.png" /> Seleccione alguna de estas opciones de la fila.', function (v,elm) {		
				var p = elm.parentNode;
				var p2= p.parentNode;
				var hijos = p2.childNodes;
				var aux= false;
				for( var i= 0; i< hijos.length; i++){
					if(hijos[i].nodeName=="TD"){
						var options2 = hijos[i].getElementsByTagName('INPUT');
						if (options2.length > 0){
							var aux2 =  $A(options2).any(function(elm) {			
								if ((elm.type.toLowerCase() == "checkbox") || (elm.type.toLowerCase() == "radio"))
									return $F(elm);
								else
									return false;
								// si marca un error en explorer es por el padre, revisar ese peque�o detalle
							});							
							aux = aux || aux2;
						}
					}
				}
				return aux;
			}],
	
	['validate-one-required-col', '<img src ="validation/alerta.png" /> Seleccione alguna de las opciones anteriores.', function (v,elm) {		
				var p = elm.parentNode;
				var p2= p.parentNode;
				var p3= p2.parentNode;
				var hijos = p3.childNodes;
				var aux= false;
				for( var i= 0; i< hijos.length; i++){
					if(hijos[i].nodeName=="TR"){
						var hijos2=hijos[i].childNodes;
						for(var j= 0; j<hijos2.length; j++){
							if(hijos2[j].nodeName== "TD"){
								var options2 = hijos2[j].getElementsByTagName('INPUT');
								if (options2.length > 0){
									var aux2 =  $A(options2).any(function(elm) {
										if ((elm.type.toLowerCase() == "checkbox") || (elm.type.toLowerCase() == "radio"))
											return $F(elm);
										else
											return false;
									});							
									aux = aux || aux2;
								}
							}
						}
					}
				}
				return aux;
			}]
	
	
]);