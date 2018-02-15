<!--#include virtual="/cgi-bin/prospectos/conexiones.asp" -->
<!--#include virtual="/cgi-bin/prospectos/baseDatos.asp" -->

 <%
 
 If CLng(Request.Form("programa")) <> 0 Then 
 
	 modalidad=Request.Form("modalidad")
	
		Set DBCandidato= new baseDatos
		DBCandidato.nombreBase= baseCandidatos
		DBCandidato.crearConexion()
	
	if modalidad =1 then
	  SQL="SELECT preguntaportal.pregunta, preguntaportal.idpreguntaPortal FROM preguntaportal WHERE preguntaportal.baja = 'N' AND (modalidad=1 OR modalidad=0) ORDER BY preguntaportal.prioridad,preguntaportal.pregunta"
	  
	Else
	  SQL="SELECT preguntaportal.pregunta, preguntaportal.idpreguntaPortal FROM preguntaportal WHERE preguntaportal.baja = 'N' AND (modalidad=2 OR modalidad=0) ORDER BY preguntaportal.prioridad,preguntaportal.pregunta"
	end if 
	
		
		Set rst = DBCandidato.ejecutaConsulta(SQL) %>
		
		<div id="areaScroll" class="textgral2 " >Deseo recibir mayor informaci&oacute;n respecto a:<br />
		
		
	  <%  contador= 0 
		 
		While Not rst. EOF
		  
		 Response.Write("<br /><input type='checkbox' name='idBusca'  id='idBusca"&rst("idpreguntaPortal")&"'  value='"&rst("idpreguntaPortal")&"'>&nbsp;"&server.HTMLEncode(rst("pregunta")) & vbCrLf)
		 rst.MoveNext 
	
		Wend	 
		rst.Close
	
	%>
	   <br />&nbsp;
       <br />&nbsp;
	   <br /><span class="textgral2">Si no encontr&oacute; el tema de su inter&eacute;s por favor descr&iacute;balo a continuaci&oacute;n:</span>
	   <br /><textarea name="comentario" id="comentario" cols="50" rows="5" class="textgral"></textarea> 
       <br />&nbsp;
       <br />&nbsp;
       <br />
       <input type="submit" name="submit" value="Enviar Solicitud" class="buttons" style="background:#ED1B24"  id="botonEnvia"/>
       
	</div>
	<%
		DBCandidato.cerrarConexion()
		Set rst= Nothing
		Set DBCandidato= Nothing	

else

%>
       <input type="submit" name="submit" value="Enviar Solicitud" class="buttons" style="background:#ED1B24"  id="botonEnvia"/>
<br /><br />

<%
			
End If
		
%>    


