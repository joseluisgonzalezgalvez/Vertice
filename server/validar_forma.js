function marcar(source) 
{
    checkboxes=document.getElementsByTagName('input');
    for(i=0;i<checkboxes.length;i++)
    {
	if(checkboxes[i].type == "checkbox")
	{
	    
	    checkboxes[i].checked=source.checked;
	}
    }
}
function validate()
{
    var _prioridad    = document.getElementsByName( "etiqueta" );
    var _fecha_inicio = document.getElementsByName( "bday" );
    var _fecha_fin    = document.getElementsByName( "eday" );
    var _hora_inicio  = document.getElementsByName( "bhour" );
    var _hora_fin     = document.getElementsByName( "ehour" );
    var _archivos     = document.getElementsByName( "archivo[]" );
    var _players      = document.getElementsByName( "ips[]" );
    var _num_players  = 0;

    for( var i=0 ; i<_players.length ; i++ )
	if( _players[i].checked )
	    _num_players++;

    if( _prioridad[0].value == -1 )
	alert( "Debes elegir una PRIORIDAD.");
    else if( _prioridad[0].value == "CANCELADO" || _prioridad[0].value == "DETENER" ) {
	if( _num_players == 0 )
	    alert( "Para cancelar deber elegir algún PLAYER." );
	else {
	    if( confirm( "Seguro que quieres ELIMINAR/DETENER la programación especial." ) )
		document.formulario.submit();
	    else
		alert( "No se eliminará el contenido especial. " );
	}
    }
    else {
	if( _archivos[0].value == "" )
	    alert( "Debes elegir algún archivo" );
	else {
	    if( _num_players == 0 ) 
		alert( "Debes marcar algún player" );
	    else {
		if( _fecha_fin[0].value == "" 
		    || _fecha_inicio[0].value == "" 
		    || _hora_inicio[0].value == "" 
		    || _hora_fin[0].value == "" )
		    alert( "Ingresa fechas y horas de INICIO y TÉRMINO" );
		else {
		    if( _fecha_fin[0].value < _fecha_inicio[0].value  )
			alert( "Las fechas son INCOHERENTES." );
		    else {
			if( _fecha_fin[0].value == _fecha_inicio[0].value 
			    && _hora_inicio[0].value == _hora_fin[0].value )
			    alert( "La hora de INICIO y FIN es la misma. " );
			else {
			    if( _hora_fin[0].value < _hora_inicio[0].value ) 
				alert( "Las horas de INICIO y FIN son INCOHERENTES.")
			    else {
				if( confirm( "¿Los datos son correctos?: \n" + 
					     "\nPrioridad: " + _prioridad[0].value + 
					     "\nDesde: " + _fecha_inicio[0].value + " ... " + _hora_inicio[0].value +
					     "\nHasta: " + _fecha_fin[0].value +  " ... " + _hora_fin[0].value ) )
				    document.formulario.submit()
				else 
				    alert( "El envío se ha cancelado" );
			    }
			}
		    }
		}
	    }
	}
    }					  
}
