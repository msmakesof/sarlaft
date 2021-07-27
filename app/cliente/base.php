<style>
.default{
    width: 20%;
}

.circulo {
     width: 13px;
     height: 13px;
     -moz-border-radius: 50%;
     -webkit-border-radius: 50%;
     -o-radius: 50%;
     border-radius: 50%;
     background: #000;
     border-color: #000;
}
table {
    /*border-collapse: collapse;*/
    border-color: #000;
    padding = 0;
}
td {
    width: 55px;
    text-align:center;
}
</style>
<div>
<?php 
// Test move
$fi = 4;
$co = 2;


for ($c=0; $c<=4; $c++)
{
    for ($f=0; $f<=4; $f++)
    {
    
    }
}
?>
    <table class="default">
        <tr>            
            <td style="background-color:#FFC600"><?php if($fi == 1 && $co == 1) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
            <td style="background-color:#FFC600"><?php if($fi == 1 && $co == 2) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
            <td style="background-color:#ff0000"><?php if($fi == 1 && $co == 4) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
            <td style="background-color:#ff0000"><?php if($fi == 1 && $co == 3) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
            <td style="background-color:#ff0000"><?php if($fi == 1 && $co == 5) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
        </tr>
        <tr>
            <td style="background-color:#ffff00"><?php if($fi == 2 && $co == 1) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
            <td style="background-color:#FFC600"><?php if($fi == 2 && $co == 2) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
            <td style="background-color:#FFC600"><?php if($fi == 2 && $co == 3) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>            
            <td style="background-color:#ff0000"><?php if($fi == 2 && $co == 4) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
            <td style="background-color:#ff0000"><?php if($fi == 2 && $co == 5) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
        </tr>

        <tr>
            <td style="background-color:#9b9b9b"><?php if($fi == 3 && $co == 1) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
            <td style="background-color:#ffff00"><?php if($fi == 3 && $co == 2) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
            <td style="background-color:#FFC600"><?php if($fi == 3 && $co == 3) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
            <td style="background-color:#ff0000"><?php if($fi == 3 && $co == 4) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
            <td style="background-color:#ff0000"><?php if($fi == 3 && $co == 5) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
        </tr>

        <tr>
            <td style="background-color:#9b9b9b"><?php if($fi == 4 && $co == 1) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
            <td style="background-color:#9b9b9b"><?php if($fi == 4 && $co == 2) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
            <td style="background-color:#ffff00"><?php if($fi == 4 && $co == 3) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
            <td style="background-color:#FFC600"><?php if($fi == 4 && $co == 4) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
            <td style="background-color:#ff0000"><?php if($fi == 4 && $co == 5) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>            
        </tr>

        <tr>
            <td style="background-color:#9b9b9b"><?php if($fi == 5 && $co == 1) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
            <td style="background-color:#9b9b9b"><?php if($fi == 5 && $co == 2) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
            <td style="background-color:#ffff00"><?php if($fi == 5 && $co == 3) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
            <td style="background-color:#FFC600"><?php if($fi == 5 && $co == 4) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
            <td style="background-color:#FFC600"><?php if($fi == 5 && $co == 5) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
        </tr>

    </table>
</div>