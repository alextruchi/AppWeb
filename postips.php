<?php

Class genPost{

    var $cartas_usadas = array();
 
    function imprimirPostRojo($top,$left,$i) {
            $html='<div id="div'.$i.'" style="top:'.$top.'px; width:100px; left:'.$left.'px; background-color:red; position:absolute; height:25px; text-align: center;"
            onmousedown="comienzoMovimiento(event, this.id);" onmouseover="this.style.cursor=\'move\'")">
            <span style="display: inline-block; text-align: center;">Importante</span></div>';
            return $html;
    }

    function imprimirPostAmar($top,$left,$i) {
        $html='<div id="div'.$i.'" style="top:'.$top.'px; width:100px; left:'.$left.'px; background-color:yellow; position:absolute; height:25px; text-align: center;"
        onmousedown="comienzoMovimiento(event, this.id);" onmouseover="this.style.cursor=\'move\'")">
        <span style="display: inline-block; text-align: center;">No importante</span></div>';
        return $html;
}
}

$Obj=new genPost();

?>