<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Ventas de los Vendedores</title>
    <link rel="stylesheet" href="css/table.css">
  </head>
  <body>
    <table border="2">
      <thead><tr>
            <th><center>#</center></th>
            <th><center>Vendor Code<center></th>
            <th><center>Total National Sales</center></th>
            <th><center>Total International Sales</center></th>
            <th><center>National Sales Commission Value</center></th>
            <th><center>international Sales Commission Value</center></th>
            <th><center>Value to Pay to Seller</center></th>
            </tr></thead>
    <?php
        include ("vendedor.php");
        $totalNational =0;
        $totalInternational =0;
        for($f=0; $f < count($arraycodes); $f++){
          echo "<tr>";
              echo "<td><center><strong>".($f+1)."</strong></center></td>";
              echo "<td><center>".current($arraycodes)."</center></td>";
              echo "<td><center>".number_format(nationalSales(current($arraycodes),$array2),2) ."</center></td>";
              echo "<td><center>".number_format(internationalSales(current($arraycodes),$array2),2)." </center></td>";
              echo "<td><center>".number_format(nationalCommissions(current($arraycodes),$array2),2)." </center></td>";
              echo "<td><center>".number_format(internationalCommissions(current($arraycodes),$array2),2)." </center></td>";
              echo "<td><center>".number_format(vendorPayValue(current($arraycodes),$array2),2)." </center></td>";
          echo "</tr>";
          $totalNational += nationalSales(current($arraycodes),$array2);
          $totalInternational +=internationalSales(current($arraycodes),$array2);
            next($arraycodes);
        }
        echo "<tr>";
            echo "<td><center><strong>Total Sales</strong></center></td>";
            echo "<td></td>";
            echo "<td><center><strong>".number_format($totalNational,2) ."</strong></center></td>";
            echo "<td><center><strong>".number_format($totalInternational,2) ."</strong></center></td>";
        echo "</tr>";
     ?>
   </table>
  </body>
</html>
