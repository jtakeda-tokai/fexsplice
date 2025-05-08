<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-870YFV54KL"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-870YFV54KL');
    </script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>FexSplice result</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <!-- jQuery (necessary for Bootstrap\'s JavaScript plugins) -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed-->
    <script src="js/bootstrap.min.js"></script>

    <!-- header -->
    <div id="header" class="container">
      <nav class="navbar navbar-default">
      <div class="navbar-header">
        <a class="navbar-brand">Result</a>
      </div>
      </nav>

<?php
  $ver = htmlspecialchars($_POST['ver']);
  $chr = htmlspecialchars($_POST['chr']);
  $pos = htmlspecialchars($_POST['pos']);

  $result = shell_exec( "bash ./extract_target_pos.sh $chr $pos divided_files_'$ver'_path");
  $lines = preg_split( '/\n/', $result );
  $nLine = count( $lines );

  if($nLine==1){
    echo "<font size=+1><b><u>SNV at ".$chr.":".$pos." can't be predicted by FexSplice.</u></b></font><br><br>";
  }
?>

    <!-- main -->
    <div class="container">
      <div class="row">

        <!-- Mainbar -->
        <div class="col-sm-11">
        Predicted pathogenicity in shown in “Prediction” along with “Pathogenic Probability”. Pathogenic Probability >= 0.5 is predicted to be “Pathogenic”.
        <br />

        <!-- Result Table -->
        <div class="container" style="padding:20px 0">
          <table class="table table-striped table-hover">
            <thead>
            <tr>
              <th>Prediction</th>
              <th>Pathogenic Probability</th>
              <th>Genomic Mutation</th>
              <th>Strand</th>
              <th>Gene name, ID and exon No. based on Ensembl release 101</th>
            </tr>
            </thead>

            <tbody>

<?php
  for($iLine=1; $iLine<=$nLine-1; $iLine++){
    echo "<tr>";
    $element = preg_split('/\t/', $lines[$iLine-1]);
    $nElement = count( $element );

    if($element[7] >= 0.5){
      echo "<td><font color=red>Abnormal</font></td>";
    }else if($element[7] < 0.5){
      echo "<td>Normal</td>";
    }else{
      echo "<td>Not predicted</td>";
    }
    echo "<td>".$element[7]."</td>";
    echo "<td>g.".$element[1]."".$element[2].">".$element[3]."</td>";
    echo "<td>".$element[6]."</td>";
    echo "<td>".$element[8]."</td>";
    echo "</tr>";
  }
  echo "</table>";
  echo "<b><i>Input queries: $ver, $chr, $pos</b></i>";
?>

            </tbody>
          </table>
        </div>
        <!-- END OF Table -->

      </div>
    </div>
    <br>
    <input type="button"  value="Return" class="btn btn-info" onclick="history.back()">
    <br><br>
  </div>
  </body>
</html>

