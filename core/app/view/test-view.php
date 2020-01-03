<?php
  /*
    CifrasEnLetrasTest.php — ProInf.net — nov-2009, ago-2011
  */

//  require_once('CifrasEnLetras.php');

  //---------------------------------------------

  function test($cifras, $prueba, $referencia)
  {
      $correcto = '<span style="color:green">correcto';
      $error = '<span style="color:red">ERROR';

      echo '<li>'.($prueba==$referencia? $correcto: $error).': <b>'.$cifras.'</b> = '.$prueba.'</span></li>';
  }

  //=============================================

  function test_2cifras()
  {
      $lista = array(
      0=>"cero", 1=>"un", 2=>"dos", 7=>"siete",
      10=>"diez", 12=>"doce", 22=>"veintidós",
      30=>"treinta", 50=>"cincuenta", 66=>"sesenta y seis",
      84=>"ochenta y cuatro", 99=>"noventa y nueve");

      echo '<h2>Convertir 2 cifras</h2><ul>';

      foreach ($lista as $cifras=>$referencia) {
          echo test($cifras, CifrasEnLetras::convertirDosCifras($cifras), $referencia);
      }

      for ($i=0; $i<10; $i++) {
          $cifras = rand(0, 99);
          echo "<li>aleatorio: <b>$cifras</b> = ".
        CifrasEnLetras::convertirDosCifras($cifras).'</li>';
      }

      echo '</ul>';
  }

  //·············································

  function test_3cifras()
  {
      $lista = array(
      44=>"cuarenta y cuatro",
      300=>"trescientos",
      100=>"cien",
      121=>"ciento veintiún",
      438=>"cuatrocientos treinta y ocho",
      999=>"novecientos noventa y nueve");

      echo '<h2>Convertir 3 cifras</h2><ul>';

      foreach ($lista as $cifras=>$referencia) {
          echo test($cifras, CifrasEnLetras::convertirTresCifras($cifras), $referencia);
      }

      for ($i=0; $i<10; $i++) {
          $cifras = rand(100, 999);
          echo "<li>aleatorio: <b>$cifras</b> = ".
        CifrasEnLetras::convertirTresCifras($cifras).'</li>';
      }

      echo '</ul>';
  }

  //·············································

  function test_6cifras()
  {
      $lista = array(
      781=>"setecientos ochenta y un",
      1000=>"mil",
      1001=>"mil un",
      1200=>"mil doscientos", 320000=>"trescientos veinte mil",
      458926=>"cuatrocientos cincuenta y ocho mil novecientos veintiséis",
      999999=>"novecientos noventa y nueve mil novecientos noventa y nueve");

      echo '<h2>Convertir 6 cifras</h2><ul>';

      foreach ($lista as $cifras=>$referencia) {
          echo test($cifras, CifrasEnLetras::convertirSeisCifras($cifras), $referencia);
      }

      for ($i=0; $i<10; $i++) {
          $cifras = rand(1000, 999999);
          echo "<li>aleatorio: <b>$cifras</b> = ".
        CifrasEnLetras::convertirSeisCifras($cifras, 'femenino').'</li>';
      }

      echo '</ul>';
  }

  //·············································

  function test_cifras()
  {
      $lista = array(
      1000001=>"un millón un",
      2001000=>"dos millones mil",
      "250000000000"=>"doscientos cincuenta mil millones",
      "75000000000000000"=>"setenta y cinco mil billones");
      $lista2 = array(
      "1"=>"una",
      "240021"=>"doscientas cuarenta mil veintiuna",
      "21300"=>"veintiuna mil trescientas");

      echo '<h2>Convertir cifras en letras</h2><ul>';

      foreach ($lista as $cifras=>$referencia) {
          echo test($cifras, CifrasEnLetras::convertirCifrasEnLetras($cifras), $referencia);
      }
      foreach ($lista2 as $cifras=>$referencia) {
          echo test($cifras, CifrasEnLetras::convertirCifrasEnLetrasFemeninas($cifras), $referencia);
      }

      for ($i=0; $i<2; $i++) {
          $cifras = cifras_aleatorias(rand(1, 126));
          echo "<li>aleatorio: <b>$cifras</b> = <br />".
        CifrasEnLetras::convertirCifrasEnLetras($cifras, genero_aleatorio(), '<br />').'</li>';
      }

      echo '</ul>';
  }

  //·············································

  function test_numeros()
  {
      echo '<h2>Convertir números en letras</h2><ul>';

      test("-123,45 ; 2", CifrasEnLetras::convertirNumeroEnLetras("-123,45", 2), "menos ciento veintitrés con cuarenta y cinco");
      test("2.000,25 ; 3", CifrasEnLetras::convertirNumeroEnLetras("2.000,25", 3, "kilo", "", false, "gramo"), "dos mil kilos con doscientos cincuenta gramos");
      test("43,005 ; 3", CifrasEnLetras::convertirNumeroEnLetras("43,005", 3, "kilómetro", "", false, "metro"), "cuarenta y tres kilómetros con cinco metros");
      test("1.270,23 ; 2", CifrasEnLetras::convertirNumeroEnLetras("1.270,23", 2, "euro", "", false, "céntimo"), "mil doscientos setenta euros con veintitrés céntimos");
      test("1 ; 2", CifrasEnLetras::convertirNumeroEnLetras("1", 2, "euro", "", false, "céntimo"), "un euro con cero céntimos");
      test("0,678 ; 2", CifrasEnLetras::convertirNumeroEnLetras("0,678", 2, "euro", "", false, "céntimo"), "cero euros con sesenta y siete céntimos");
      test("22.000,55 ; 0", CifrasEnLetras::convertirNumeroEnLetras("22.000,55", 0, "euro"), "veintidós mil euros");
      test("-0 ;", CifrasEnLetras::convertirNumeroEnLetras("-0"), "cero");
      test("-0,01 ;", CifrasEnLetras::convertirNumeroEnLetras("-0,01"), "menos cero con uno");
      test("0,01 ; 3", CifrasEnLetras::convertirNumeroEnLetras("0,01", 3), "cero con diez");
      test("20,21 ;", CifrasEnLetras::convertirNumeroEnLetras("20,21"), "veinte con veintiuno");
      test("-,889 ;", CifrasEnLetras::convertirNumeroEnLetras("-,889"), "menos cero con ochocientos ochenta y nueve");
      test("0 ;", CifrasEnLetras::convertirNumeroEnLetras("0"), "cero");
      test("200 ; 0", CifrasEnLetras::convertirNumeroEnLetras("200", -1, "manzana", "", true), "doscientas manzanas");
      test("351 ; 0", CifrasEnLetras::convertirNumeroEnLetras("351,5", 0, "manzana", "", true), "trescientas cincuenta y una manzanas");
      test("1,5 ; 2", CifrasEnLetras::convertirNumeroEnLetras("1,5", 2, "peseta", "", true, "céntimo", "", false), "una peseta con cincuenta céntimos");
      test("300,56 ; 3", CifrasEnLetras::convertirNumeroEnLetras("300,56", 3, "segundo", "", false, "milésima", "", true), "trescientos segundos con quinientas sesenta milésimas");
      test("21,21 ; 2", CifrasEnLetras::convertirNumeroEnLetras("21,21", 2, "niño", "", false, "niña", "", true), "veintiún niños con veintiuna niñas");
      test("1000000", CifrasEnLetras::convertirNumeroEnLetras("1000000", -1, "euro"), "un millón de euros");
      test("200200200", CifrasEnLetras::convertirNumeroEnLetras("200.200.200", -1, "persona", "", true), "doscientos millones doscientas mil doscientas personas");
      test("221.221.221", CifrasEnLetras::convertirNumeroEnLetras("221.221.221", -1, "persona", "", true), "doscientos veintiún millones doscientas veintiuna mil doscientas veintiuna personas");
      test("3120", CifrasEnLetras::convertirNumeroEnLetras("3120", -1, "persona", "", true), "tres mil ciento veinte personas");

      for ($i=0; $i<10; $i++) {
          $cifras = (rand(0, 1)==0?"-":"") . cifras_aleatorias(rand(0, 5)) . "," . cifras_aleatorias(rand(0, 3));
          $numeroDecimales = rand(0, 4);
          echo "<li>aleatorio: <b>$cifras ; $numeroDecimales </b> = ".
        CifrasEnLetras::convertirNumeroEnLetras($cifras, $numeroDecimales).'</li>';
      }

      echo '</ul>';
  }

  //·············································

  function test_euros()
  {
      echo '<h2>Convertir pesos en letras</h2><ul>';

      test("string:498001", CifrasEnLetras::convertirPesosEnLetras("498001", 0), "cuatrocientos noventa y ocho mil un pesos");
      test("long:85009", CifrasEnLetras::convertirPesosEnLetras(85009, 0), "ochenta y cinco mil nueve pesos");
      test("double:10200", CifrasEnLetras::convertirPesosEnLetras(10200, 0), "diez mil doscientos pesos");
      echo "<li>aleatorio: <b>1000000</b> = ". CifrasEnLetras::convertirPesosEnLetras(1000000, 0).'</li>';
      echo "<li>aleatorio: <b>2000000</b> = ". CifrasEnLetras::convertirPesosEnLetras(2000000, 0).'</li>';

      echo "<li>aleatorio: <b>3000000</b> = ". CifrasEnLetras::convertirPesosEnLetras(3000000, 0).'</li>';
      echo "<li>aleatorio: <b>4000000</b> = ". CifrasEnLetras::convertirPesosEnLetras(4000000, 0).'</li>';
      echo "<li>aleatorio: <b>5000000</b> = ". CifrasEnLetras::convertirPesosEnLetras(5000000, 0).'</li>';

      echo "<li>aleatorio: <b>6000000</b> = ". CifrasEnLetras::convertirPesosEnLetras(6000000, 0).'</li>';
      echo "<li>aleatorio: <b>7000000</b> = ". CifrasEnLetras::convertirPesosEnLetras(7000000, 0).'</li>';
      echo "<li>aleatorio: <b>8000000</b> = ". CifrasEnLetras::convertirPesosEnLetras(8000000, 0).'</li>';

      echo "<li>aleatorio: <b>9000000</b> = ". CifrasEnLetras::convertirPesosEnLetras(9000000, 0).'</li>';
      echo "<li>aleatorio: <b>10000000</b> = ". CifrasEnLetras::convertirPesosEnLetras(10000000, 0).'</li>';
      echo "<li>aleatorio: <b>21000000</b> = ". CifrasEnLetras::convertirPesosEnLetras(21000000, 0).'</li>';
      echo "<li>aleatorio: <b>41000000</b> = ". CifrasEnLetras::convertirPesosEnLetras(41000000, 0).'</li>';
      echo "<li>aleatorio: <b>41001001</b> = ". CifrasEnLetras::convertirPesosEnLetras(41001001, 0).'</li>';








      for ($i=0; $i<100; $i++) {
          $cifras = (rand(0, 1)==0?"-":"") . cifras_aleatorias(rand(0, 9)) ;
          echo "<li>aleatorio: <b>$cifras</b> = ".
        CifrasEnLetras::convertirPesosEnLetras($cifras, 0).'</li>';
      }

      echo '</ul>';
  }

  //·············································

  function test_formatear()
  {
      $lista = array(
      1234567890=>"1.234_567.890",
      "1012,25"=>"1.012,25",
      "111222333444555666"=>"111.222_333.444_555.666",
      "9876654,3210"=>"9_876.654,3210",
      "-12345,67"=>"-12.345,67");
      $lista2 = array(
      "9888777666555444333222111"=>"9<sub>4</sub>888.777<sub>3</sub>666.555<sub>2</sub>444.333<sub>1</sub>222.111"
    );

      echo '<h2>Formatear cifras</h2><ul>';

      foreach ($lista as $cifras=>$referencia) {
          echo test($cifras, CifrasEnLetras::formatearCifras($cifras), $referencia);
      }
      foreach ($lista2 as $cifras=>$referencia) {
          echo test($cifras, CifrasEnLetras::formatearCifras($cifras, "html"), $referencia);
      }

      echo '</ul>';
  }


  //=============================================
  // Auxiliar

  function genero_aleatorio()
  {
      $generos = array("femenino", "masculino", "neutro");
      return $generos[rand(0, 2)];
  }

  function cifras_aleatorias($numero_cifras)
  {
      $list = array();
      for ($i=1; $i<$numero_cifras; $i++) {
          $list[] = substr('0123456789000000000000', rand(0, 19), 1);
      }
      return implode('', $list);
  }

  //---------------------------------------------

?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="blue">
                <h4 class="title">Calendario de Prestamo</h4>
            </div>





            <div class="card-content table-responsive">
                <h1>TEST: Cifras en Letras</h1>

                <?php
    //test_euros();
    //test_formatear();


  ?>

                <p>ProInf.net &copy;2011</p>
            </div>
        </div>
    </div>
</div>