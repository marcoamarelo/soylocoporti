<?
include('frete.php');
$f=new PgsFrete();
print_r($f->gerar('04334100',5,100,'04334100'));
?>
