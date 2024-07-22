<?php 
require_once(realpath(dirname(__FILE__)).'\dompdf-2.0.8\dompdf\autoload.inc.php');
    use Dompdf\Dompdf;


    // $dompdf = new Dompdf();


    // $html = '<h1>Hola</h1>';

    // $dompdf->loadHtml($html);
    // $data = array('name'=>'John Smith', 'date'=>'1/29/15');
    // $html = file_get_contents("pdf.php"); 
    // $html = ob_get_clean();
    // // $dompdf->loadHtml($html)->with('data', $data);

    // $dompdf->loadHtml($html);
    // // $dompdf->load_html_file('test.html', $data);
    // // $dompdf->setPaper('A4', 'lnadscape');

    // // $dompdf->loadView('pdf.php', compact('data'));

    // $dompdf->render();
    // $dompdf->stream();

//     $name = $_POST['name'];
// $date = $_POST['date'];

// // Generate HTML content
// $html = "<!DOCTYPE html>
// <html>
// <head>
// <title>PDF Example</title>
// </head>
// <body>
// <h1>PDF Example</h1>
// <p>Name: $name</p>
// <p>Date: $date</p>
// </body>
// </html>
// ";


// $dompdf = new Dompdf();
// $dompdf->loadHtml($html);
// $dompdf->setPaper('A4', 'portrait');
// $dompdf->render();
// $dompdf->stream("example.pdf", ["Attachment" => false]);


function createPDF($texto, $modo){
    require_once(realpath(dirname(__FILE__)).'\dompdf-2.0.8\dompdf\autoload.inc.php');
    $texto     = $texto;
      $modo      = $modo;
      $download  = $modo === 'si' ? true : false;
      $contenido = '<!DOCTYPE html>
      <html>
        <head>
          <style>
            table {
              width: 100%%;
              text-align: center;
            } 
          </style>
        </head>
        <body>
       
          <h1>Bienvenido de nuevo a %s</h1>
          <p>Versión <b>%s</b></p>
          <p>%s</p>
          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>John Doe</td>
                <td>jhon@doe.com</td>
                <td>$2,532</td>
              </tr>
              <tr>
                <td>2</td>
                <td>John Doe</td>
                <td>jhon@doe.com</td>
                <td>$712</td>
              </tr>
              <tr>
                <td>3</td>
                <td>John Doe</td>
                <td>jhon@doe.com</td>
                <td>$6,250</td>
              </tr>
              <tr>
                <td>4</td>
                <td>John Doe</td>
                <td>jhon@doe.com</td>
                <td>$8,152</td>
              </tr>
              <tr>
                <td>5</td>
                <td>John Doe</td>
                <td>jhon@doe.com</td>
                <td>$596</td>
              </tr>
              <tr>
                <td>6</td>
                <td>John Doe</td>
                <td>jhon@doe.com</td>
                <td>$1,756</td>
              </tr>
            </tbody>
          </table>
        </body>
      </html>';
      $contenido = sprintf($contenido, $texto, "alo", "alo");
 
      // Nombre del pdf
      $filename = 'try'.'.pdf';
   
    //   // Opciones para prevenir errores con carga de imágenes
    //   $options = new Options();
    //   $options->set('isRemoteEnabled', true);
 
      // Instancia de la clase
      $dompdf = new Dompdf();
 
      // Cargar el contenido HTML
      $dompdf->loadHtml($contenido);
 
      // Formato y tamaño del PDF
      $dompdf->setPaper('A4', 'portrait');
 
      // Renderizar HTML como PDF
      $dompdf->render();
 
      // Salida para descargar
      $dompdf->stream($filename, ['Attachment' => $download]);
}


createPDF('aloooo', 'si');
?>