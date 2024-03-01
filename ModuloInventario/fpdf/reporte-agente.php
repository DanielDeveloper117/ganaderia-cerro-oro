<?php

require('./fpdf.php');

class PDF extends FPDF{
   // Cabecera de página
   function Header(){
      $this->Image('../img/logo-copia.png', 150, 5, 40); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
      $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(45); // Movernos a la derecha
      $this->SetTextColor(0, 0, 0); //color
      //creamos una celda o fila
      $this->Cell(110, 15, utf8_decode('Reporte de agente'), 0, 1, 'C', 0); 
      // AnchoCelda, AltoCelda, titulo, borde(1-0), saltoLinea(1-0), posicion(L-C-R), ColorFondo(1-0)
      $this->Ln(3); // Salto de línea   
   }
   // Pie de página
   function Footer(){
      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
      $hoy = date('d/m/Y');
      $this->Cell(355, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
   }
}

include("../conexion.php");
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../login.html");
    exit;
}
$pdf = new PDF();
$pdf->AddPage(); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas


if (isset($_GET['id'])) {
   $id_usuario = $_GET['id'];
   $sql = "SELECT id_usuario, nombre, usuario FROM registro_usuarios WHERE id_usuario = :id_usuario";
   $stmt = $conn->prepare($sql);
   $stmt->bindParam(':id_usuario', $id_usuario);
   $stmt->execute();

   while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
       //---------------------------INFORMACION DEL AGENTE----------
      $pdf->SetTextColor(103); //color
      /* informacion id_usuario */
      $pdf->Cell(8);  // mover a la derecha
      $pdf->SetFont('Arial', 'B', 10);
      $pdf->Cell(5, 10, utf8_decode("Id: ". $fila['id_usuario']), 0, 0, '', 0);
      $pdf->Ln(5);
      /* informacion nombre */
      $pdf->Cell(8);  // mover a la derecha
      $pdf->SetFont('Arial', 'B', 10);
      $pdf->Cell(59, 10, utf8_decode("Nombre del agente: ". $fila['nombre']), 0, 0, '', 0);
      $pdf->Ln(5);
      /* informacion usuario */
      $pdf->Cell(8);  // mover a la derecha
      $pdf->SetFont('Arial', 'B', 10);
      $pdf->Cell(85, 10, utf8_decode("Usuario: ". $fila['usuario']), 0, 0, '', 0);
      $pdf->Ln(10);
      // AnchoCelda, AltoCelda, titulo, borde(1-0), saltoLinea(1-0), posicion(L-C-R), ColorFondo(1-0)
      //---------------------------INFORMACION DEL AGENTE------------
   }
}
  
//---------------------------TABLA CLIENTES----------------------
/* TITULO DE LA TABLA */
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(50); // mover a la derecha
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(100, 10, utf8_decode("Reporte de clientes registrados "), 0, 1, 'C', 0);
$pdf->Ln(7);
/* COLUMNAS DE LA TABLA */
$pdf->SetFillColor(225,225,225); //colorFondo
$pdf->SetTextColor(0,0,0); //colorTexto
$pdf->SetDrawColor(163, 163, 163); //colorBorde
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(8,  8, utf8_decode('Id'), 1, 0, 'C', 1);
$pdf->Cell(55, 8, utf8_decode('Nombre'), 1, 0, 'C', 1);
$pdf->Cell(55, 8, utf8_decode('Dirección'), 1, 0, 'C', 1);
$pdf->Cell(25, 8, utf8_decode('Telefono'), 1, 0, 'C', 1);
$pdf->Cell(48, 8, utf8_decode('Correo'), 1, 1, 'C', 1);
// AnchoCelda, AltoCelda, titulo, borde(1-0), saltoLinea(1-0), posicion(L-C-R), ColorFondo(1-0)
$i = 0;
$pdf->SetFont('Arial', '', 8);
$pdf->SetDrawColor(163, 163, 163); //colorBorde
$i = $i + 1;

if (isset($_GET['id'])) {
   $id_usuario = $_GET['id'];
   $sql = "SELECT id_cliente, id_usuario, nombre, telefono, direccion, correo FROM clientes WHERE id_usuario = :id_usuario";
   $stmt = $conn->prepare($sql);
   $stmt->bindParam(':id_usuario', $id_usuario);
   $stmt->execute();
   while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
      /* registros de la tabla */
      $pdf->Cell(8,  8, utf8_decode("". $fila['id_cliente']), 1, 0, 'C', 0);
      $pdf->Cell(55, 8, utf8_decode("". $fila['nombre']), 1, 0, 'L', 0);
      $pdf->Cell(55, 8, utf8_decode("". $fila['direccion']), 1, 0, 'L', 0);
      $pdf->Cell(25, 8, utf8_decode("". $fila['telefono']), 1, 0, 'L', 0);
      $pdf->Cell(48, 8, utf8_decode("". $fila['correo']), 1, 1, 'L', 0);
      // AnchoCelda, AltoCelda, titulo, borde(1-0), saltoLinea(1-0), posicion(L-C-R), ColorFondo(1-0)
   }
}
//---------------------------TABLA CLIENTES----------------------


//---------------------------TABLA Cobranza----------------------
/* TITULO DE LA TABLA */
$pdf->Ln(7);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(50); // mover a la derecha
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(100, 10, utf8_decode("Reporte de cobranzas "), 0, 1, 'C', 0);
$pdf->Ln(7);
/* COLUMNAS DE LA TABLA */
$pdf->SetFillColor(225,225,225); //colorFondo
$pdf->SetTextColor(0,0,0); //colorTexto
$pdf->SetDrawColor(163, 163, 163); //colorBorde
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(8,  8, utf8_decode('Id'), 1, 0, 'C', 1);
$pdf->Cell(55, 8, utf8_decode('Cliente'), 1, 0, 'C', 1);
$pdf->Cell(35, 8, utf8_decode('Monto'), 1, 0, 'C', 1);
$pdf->Cell(50, 8, utf8_decode('Tipo de recaudacion'), 1, 0, 'C', 1);
$pdf->Cell(35, 8, utf8_decode('Fecha'), 1, 1, 'C', 1);
// AnchoCelda, AltoCelda, titulo, borde(1-0), saltoLinea(1-0), posicion(L-C-R), ColorFondo(1-0)
$i = 0;
$pdf->SetFont('Arial', '', 8);
$pdf->SetDrawColor(163, 163, 163); //colorBorde
$i = $i + 1;

if (isset($_GET['id'])) {
   $id_usuario = $_GET['id'];
   $sql = "SELECT id_cobranza, cliente, monto, tipo_recaudacion, fecha FROM cobranza WHERE id_usuario = :id_usuario";
   $stmt = $conn->prepare($sql);
   $stmt->bindParam(':id_usuario', $id_usuario);
   $stmt->execute();
   while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
      /* registros de la tabla */
      $pdf->Cell(8,  8, utf8_decode("". $fila['id_cobranza']), 1, 0, 'C', 0);
      $pdf->Cell(55, 8, utf8_decode("". $fila['cliente']), 1, 0, 'L', 0);
      $pdf->Cell(35, 8, utf8_decode("$ ". $fila['monto']), 1, 0, 'L', 0);
      $pdf->Cell(50, 8, utf8_decode("". $fila['tipo_recaudacion']), 1, 0, 'L', 0);
      $pdf->Cell(35, 8, utf8_decode("". $fila['fecha']), 1, 1, 'L', 0);
      // AnchoCelda, AltoCelda, titulo, borde(1-0), saltoLinea(1-0), posicion(L-C-R), ColorFondo(1-0)
   }
}
//---------------------------TABLA CLIENTES----------------------

$pdf->Output('Reporte.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)
?>