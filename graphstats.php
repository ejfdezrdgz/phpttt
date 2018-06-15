<?php
session_start();
include "funcs.php";
include_once "jpgraph/src/jpgraph.php";
include_once "jpgraph/src/jpgraph_pie.php";

$obj = mymatches();
$data = array($obj["nwon"], $obj["ndraw"], $obj["nlost"], $obj["nopen"]);
$graph = new PieGraph(200, 200);
$theme_class = "DefaultTheme";
$graph->SetBox(true);
$p1 = new PiePlotC($data);
$graph->Add($p1);
$graph->SetMarginColor('#dcdcdc');
// $p1->label->SetColor("red");
$p1->SetMid("$obj[ndone]", '#2d85a8');
$p1->ShowBorder();
$p1->SetSliceColors(array('#cee8f1', '#a2d4e7', '#77bbd6', '#50a5c7'));
$graph->Stroke();