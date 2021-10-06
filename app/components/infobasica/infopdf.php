<?php
function fetch_logo()  
{
	include '../../ajax/is_logged.php';
	$CustomerKey = $_SESSION['Keyp'];
	require_once ("../../config/dbx.php");
	
	$getConnectionSL = new Database();
	$con = $getConnectionSL->getConnectionSL($CustomerKey );

	$query_empresa=sqlsrv_query($con,"SELECT CustomerLogo FROM CustomerSarlaft WHERE CustomerKey='".$CustomerKey."'");
	$regempresa=sqlsrv_fetch_array($query_empresa);
	$logo= trim($regempresa['CustomerLogo']);
	return $logo;
}

function fetch_data()  
{
	include '../../ajax/is_logged.php';
	$CustomerKey = $_SESSION['Keyp'];
	require_once ("../../config/dbx.php");
	
	$getConnectionSL = new Database();
	$con = $getConnectionSL->getConnectionSL($CustomerKey );

	$query_empresa=sqlsrv_query($con,"SELECT id, CustomerName, CustomerLogo, CustomerColor FROM CustomerSarlaft WHERE CustomerKey='".$CustomerKey."'");
	$regempresa=sqlsrv_fetch_array($query_empresa);
	$empresa = trim($regempresa['CustomerName']);
	$logo= trim($regempresa['CustomerLogo']);

	$getConnectionCli2 = new Database();
	$conn = $getConnectionCli2->getConnectionCli2($CustomerKey);

	$totregs = 0;
	$query=sqlsrv_query($conn, "SELECT count(CLI_IdInfoBasica) AS TOTAL FROM CLI_InfoBasica WHERE CLI_CustomerKey='".$CustomerKey ."'");
	$reg=sqlsrv_fetch_array($query); 
	$totregs = $reg['TOTAL'];
	
	if( $totregs > 0){	
		include '../../curl/infobasica/listar1pdf.php';
		foreach($data as $key => $row) {}				
		if( $key == "message")
		{
			echo '<tr>
					<td colspan="5">'. $data["message"] .'</td>
				</tr>';
		}
		else
		{
			if( $data["itemCount"] > 0)
			{
				date_default_timezone_set("America/Bogota");
				$DateStamp = date("Y-m-d H:i:s");
				$output = '';
				$j = 1;
				for($i=0; $i<count($data['body']); $i++)
				{
					$id = $data['body'][$i]['CLI_IdInfoBasica'];
					$ActividadEconomica = $data['body'][$i]['CLI_ActividadEconomica'];
					$ObjetoSocial = $data['body'][$i]['CLI_ObjetoSocial'];
					$DescripcionGeneral = $data['body'][$i]['CLI_DescripcionGeneral'];
					$Mision = $data['body'][$i]['CLI_Mision'];
					$Vision = $data['body'][$i]['CLI_Vision'];
					$ObjetivosEstrategicos = $data['body'][$i]['CLI_ObjetivosEstrategicos'];
					$CustomerKey = $data['body'][$i]['CLI_CustomerKey'];
					$USerKey = $data['body'][$i]['CLI_USerKey'];
					
					$output .= '<table>
							<tr><td>Empresa</td><td>'.$empresa.'</td></tr>
							<tr><td>Fecha</td><td>'.$DateStamp.'</td></tr>
							<tr><td>Actividad Económica</td><td>'.$ActividadEconomica.'</td></tr>
							<tr><td>Objeto Social</td><td>'.$ObjetoSocial.'</td></tr>
							<tr><td>Descripción General</td><td>'.$DescripcionGeneral.'</td></tr>
							<tr><td>Misión</td><td>'.$Mision.'</td></tr>
							<tr><td>Visión</td><td>'.$Vision.'</td></tr>
							<tr><td>Objetivos Estratégicos</td><td>'.$ObjetivosEstrategicos.'</td>						  
                     </tr>';
				}
				
				$getUrl = new Database();
				$urlServicios = $getUrl->getUrl();
				if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
				{
					$url = $urlServicios."api/debilidades/lista_eve.php?ck=$CustomerKey";
					$resultado="";
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_VERBOSE, true);
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_TIMEOUT, 30);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
					curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
					curl_setopt($ch, CURLOPT_POST, 0);
					$resultado = curl_exec ($ch);
					curl_close($ch);
					$mestado =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
					$data = json_decode($mestado, true);	
					
					$json_errors = array(
						JSON_ERROR_NONE => 'No se ha producido ningún error',
						JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
						JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
						JSON_ERROR_SYNTAX => 'Error de Sintaxis',
					);
				}
				foreach($data as $key => $row) {}	
				if( $key == "message")
				{
					//echo $data["message"];
				}
				else
				{
					$output .= "<tr><td>Debilidades</td><td>";
					for($i=0; $i<count($data['body']); $i++)
					{												
						$id = $data['body'][$i]["id"];
						$nombreDeb = trim($data['body'][$i]["DebilidadesName"]);
						$ck = trim($data['body'][$i]["CustomerKey"]);
						$uk = trim($data['body'][$i]["UserKey"]);														
						$output .= "<ul>
							<li>$nombreDeb</li>
						</ul>";
					}
					$output .= "</td></tr>";
				}				
				
				if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
				{
					$url = $urlServicios."api/oportunidades/lista_eve.php?ck=$CustomerKey";
					$resultado="";
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_VERBOSE, true);
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_TIMEOUT, 30);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
					curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
					curl_setopt($ch, CURLOPT_POST, 0);
					$resultado = curl_exec ($ch);
					curl_close($ch);
					$mestado =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
					$data = json_decode($mestado, true);	
					
					$json_errors = array(
						JSON_ERROR_NONE => 'No se ha producido ningún error',
						JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
						JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
						JSON_ERROR_SYNTAX => 'Error de Sintaxis',
					);
				}
				foreach($data as $key => $row) {}	
				if( $key == "message")
				{
					//echo $data["message"];
				}
				else
				{
					$output .= "<tr><td>Oportunidades</td><td>";
					for($i=0; $i<count($data['body']); $i++)
					{												
						$id = $data['body'][$i]["id"];
						$nombreOpo = trim($data['body'][$i]["OportunidadesName"]);
						$ck = trim($data['body'][$i]["CustomerKey"]);
						$uk = trim($data['body'][$i]["UserKey"]);														
						$output .= "
						<ul>
							<li>$nombreOpo</li>
						</ul>";
					}
					$output .= "</td></tr>";
				}
				
				if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
				{
					$url = $urlServicios."api/fortalezas/lista_eve.php?ck=$CustomerKey";
					$resultado="";
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_VERBOSE, true);
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_TIMEOUT, 30);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
					curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
					curl_setopt($ch, CURLOPT_POST, 0);
					$resultado = curl_exec ($ch);
					curl_close($ch);
					$mestado =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
					$data = json_decode($mestado, true);	
					
					$json_errors = array(
						JSON_ERROR_NONE => 'No se ha producido ningún error',
						JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
						JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
						JSON_ERROR_SYNTAX => 'Error de Sintaxis',
					);
				}
				foreach($data as $key => $row) {}	
				if( $key == "message")
				{
					//echo $data["message"];
				}
				else
				{
					$output .= "<tr><td>Fortalezas</td><td>";
					for($i=0; $i<count($data['body']); $i++)
					{												
						$id = $data['body'][$i]["id"];
						$nombreFor = trim($data['body'][$i]["FortalezasName"]);
						$ck = trim($data['body'][$i]["CustomerKey"]);
						$uk = trim($data['body'][$i]["UserKey"]);														
						$output .= "
						<ul>
							<li>$nombreFor</li>
						</ul>";
					}
					$output .= "</td></tr>";
				}
				
				if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
				{
					$url = $urlServicios."api/amenazas/lista_eve.php?ck=$CustomerKey";
					$resultado="";
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_VERBOSE, true);
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_TIMEOUT, 30);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
					curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
					curl_setopt($ch, CURLOPT_POST, 0);
					$resultado = curl_exec ($ch);
					curl_close($ch);
					$mestado =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
					$data = json_decode($mestado, true);	
					
					$json_errors = array(
						JSON_ERROR_NONE => 'No se ha producido ningún error',
						JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
						JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
						JSON_ERROR_SYNTAX => 'Error de Sintaxis',
					);
				}
				foreach($data as $key => $row) {}	
				if( $key == "message")
				{
					//echo $data["message"];
				}
				else
				{
					$output .= "<tr><td>Amenazas</td><td>";
					for($i=0; $i<count($data['body']); $i++)
					{												
						$id = $data['body'][$i]["id"];
						$nombreAme = trim($data['body'][$i]["AmenazasName"]);
						$ck = trim($data['body'][$i]["CustomerKey"]);
						$uk = trim($data['body'][$i]["UserKey"]);
						$output .= "
						<ul>
							<li>$nombreAme</li>
						</ul>";
					}
					$output .= "</td></tr></table>";
				}
			}
		}
	}
	return $output; 
}
 
// Incluya la biblioteca TCPDF principal (busque la ruta de instalación).
   require_once('../../tcpdf/tcpdf.php');

   // crear nuevo documento PDF
   $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

   // configurar la información del documento
   $pdf->SetCreator(PDF_CREATOR);
   $pdf->SetAuthor('Mauricio Sánchez Sierra');
   $pdf->SetTitle('INFORMACION BÁSICA');

   // establecer datos de encabezado predeterminados
   $PDF_HEADER_LOGO = fetch_logo();
   $PDF_HEADER_TITLE = "INFORMACIÓN BÁSICA";
   $PDF_HEADER_STRING = "";
	$pdf->SetHeaderData($PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $PDF_HEADER_TITLE, $PDF_HEADER_STRING);
  //$this->pdf->SetHeaderData('/img/logo.png', 100, 'string to print as title on document header', 'string to print on document header');

   // establecer las fuentes de encabezado y pie de página
   $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
   $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

   // establecer fuente predeterminada monoespaciada
   $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

   // establecer márgenes
   $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
   $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
   $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

   // establecer saltos de página automáticos
   $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

   // establecer el factor de escala de la imagen
   $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

   // añadir una página
   $pdf->AddPage();    

   //$html = '<h4>PDF Example</h4><br><p>Bienvenido a la jungla. ';
   $html = '';
   $html .= fetch_data();
   $html .= '</p>';
 
   $pdf->writeHTML($html, true, false, true, false, '');
   // añadir una página
   ////*$pdf->AddPage();

   ////*$html = '<h1>Hey</h1>';
   // generar el contenido HTML
   $pdf->writeHTML($html, true, false, true, false, '');

   // restablecer puntero a la última página
   $pdf->lastPage();
   
   // Este es clave para limpiar cualquier texto anterior, si se quita genera error
   ob_end_clean();
   //Cerrar y generar documento PDF
   $pdf->Output('informacionbasica.pdf', 'I');

?>