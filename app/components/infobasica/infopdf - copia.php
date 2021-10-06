<?php
// Incluya la biblioteca TCPDF principal (busque la ruta de instalación).
   require_once('../../tcpdf/tcpdf.php');

   // crear nuevo documento PDF
   $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

   // configurar la información del documento
   $pdf->SetCreator(PDF_CREATOR);
   $pdf->SetAuthor('Our Code World');
   $pdf->SetTitle('Example Write Html');

   // establecer datos de encabezado predeterminados
   $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

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

   $html = '<h4>PDF Example</h4><br><p>Bienvenido a la jungla</p>';
 
   $pdf->writeHTML($html, true, false, true, false, '');
   // añadir una página
   $pdf->AddPage();

   $html = '<h1>Hey</h1>';
   // generar el contenido HTML
   $pdf->writeHTML($html, true, false, true, false, '');

   // restablecer puntero a la última página
   $pdf->lastPage();
   //Cerrar y generar documento PDF
   $pdf->Output('informacionbasica.pdf', 'I');

?>