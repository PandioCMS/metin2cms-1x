<?php $char = isset($_GET['char']) ? $_GET['char'] : null; 
$check = mysqli_query($sqlServ, "SELECT * FROM player WHERE name LIKE '$char'");
$sql = mysqli_num_rows($check);
if ($sql > 0) {
?>
<div class="page-header">
        <h1><?php if($char) { echo "Profilul lui $char"; } else { echo 'Negăsit'; }?></h1>
      </div>
<div class="well">
<?php
$sql = "SELECT * FROM player WHERE name LIKE '$char'";
$sql2 = mysqli_query($sqlServ, $sql);
$row = mysqli_fetch_object($sql2);
$lvl = $row->level;
$skillgroup = $row->skill_group;
$class = $row->job;
$onlinemin = $row->playtime;
$exp = $row->exp;
$levelstep = $row->level_step;
$name = $row->name;
$lastplay = $row->last_play;
$horse_level = $row->horse_level;
$id_membru = $row->account_id;

$hp = $row->hp;
$mp = $row->mp;
$ht = $row->ht;
$iq = $row->iq;
$st = $row->st;
$dx = $row->dx;

echo "<center><img src=\"images/chars/$class.png\"></center>";
echo "<table class=\"table table-striped table-bordered\">
			<tbody>
				<tr>
					<td colspan=\"2\">Nume: </td>
					<td colspan=\"2\">$name</td>
				</tr>
				<tr>
					<td colspan=\"2\">Regat: </td>
					<td colspan=\"2\">";
					
			switch($empire) {
				case 1:
					echo '<span class="label label-danger">Shinshoo</span>';
					break;
				case 2:
					echo '<span class="label label-warning">Chunjo</span>';
					break;
				case 3:
					echo '<span class="label label-info">Jinno</span>';
					break;
				default:
					return false;
			}
			
echo " <img src=\"images/regat/$empire.jpg\"></td>
				</tr>
				<tr>
					<td colspan=\"2\">Timp joc: </td>
					<td colspan=\"2\">$onlinemin Minute</td>
				</tr>
				<tr>
					<td colspan=\"2\">Trecere nivel: </td>
					<td colspan=\"2\">",$levelstep,"/4</td>
				</tr>";
				
echo "			<tr>
					<td colspan=\"2\">Nivel cal: </td>
					<td colspan=\"2\">";
if ($horse_level == 0) {
echo "				<span class=\"label label-info\">Nu deține cal</span>";
}
if ($horse_level > 0 && $horse_level < 11) {
echo "				<span class=\"label label-info\">$horse_level</span> <img src=\"images/horse/imaginecal.png\"> <span class=\"label label-info\">Cal începător</span>";
}
if ($horse_level > 10 && $horse_level < 21) {
echo "				<span class=\"label label-info\">$horse_level</span> <img src=\"images/horse/cartearmat.png\"> <span class=\"label label-info\">Cal armat</span>";
}
if ($horse_level == 21) {
echo "				<span class=\"label label-info\">$horse_level</span> <img src=\"images/horse/cartemilitar.png\"> <span class=\"label label-info\">Cal militar</span>";
}
echo "</td></tr>";
	
	echo "

				<tr>
					<td colspan=\"2\">Ultima dată online:</td>
					<td colspan=\"2\">$lastplay</td>
				</tr>
				<tr>
					<td colspan=\"2\">Ras&#259; / Abilit&#259;&#355;i </td>";

echo "<td colspan=\"2\"><span class=\"label label-info\">";
if($class == "0" or $class == "4")
{
	if($skillgroup == "1" and $skillgroup !="0")
	{
	echo "R&#259;zboinic Corp ";
	}
	elseif($skillgroup == "2" and $skillgroup !="0")
	{
	echo "R&#259;zboinic Mental ";
	}
	elseif($skillgroup == "0")
	{
	echo "R&#259;zboinic <small>(Nicio abilitate &#238;nv&#259;&#355;at&#259;)</small>";
	}	
}
elseif($class == "1" or $class == "5")
{
	if($skillgroup == "1" and $skillgroup !="0")
	{
	echo "Ninja Lam&#259; ";
	}
	elseif($skillgroup == "2" and $skillgroup !="0")
	{
	echo "Ninja Arc ";
	}
	elseif($skillgroup == "0")
	{
	echo "Ninja <small>(Nicio abilitate &#238;nv&#259;&#355;at&#259;)</small>";
	}
}
elseif($class == "2" or $class == "6")
{
	if($skillgroup == "1" and $skillgroup !="0")
	{
	echo "Sura Arme ";
	}
	elseif($skillgroup == "2" and $skillgroup !="0")
	{
	echo "Sura Magie Neagr&#259; ";
	}
	elseif($skillgroup == "0")
	{
	echo "Sura <small>(Nicio abilitate &#238;nv&#259;&#355;at&#259;)</small>";
	}
}
elseif($class == "3" or $class == "7")
{
	if($skillgroup == "1" and $skillgroup !="0")
	{
	echo "&#350;aman Dragon ";
	}
	elseif($skillgroup == "2" and $skillgroup !="0")
	{
	echo "&#350;aman Vindec&#259;tor ";
	}
	elseif($skillgroup == "0")
	{
	echo "&#350;aman <small>(Nicio abilitate &#238;nv&#259;&#355;at&#259;)</small>";
	}
}

else
{

echo "garnix";
}
echo "</span></td></tr>";

echo "			<tr>
					<td>HP: $hp</td>
					<td>SP: $mp</td>
					<td>VIT: $ht</td>
					<td>INT: $iq</td>
				</tr>
				<tr>
					<td>Nivel: $lvl</td>
					<td>Exp: $exp</td>
					<td>STR: $st</td>
					<td>DEX: $dx</td>
				</tr>";

echo"			</tbody>
		</table></div>";
		}
else {
		echo "<div class=\"alert alert-danger\" role=\"alert\">
				Caracterul căutat <strong>nu există</strong>! 
			</div>";  
			}
?>


<a href="javascript: history.go(-1)" class="btn btn-warning" role="button">&#171; &Icirc;napoi</a>