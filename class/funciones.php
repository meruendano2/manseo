<?php

class Funciones {
    private $resultado;
    private $campos;

    public function __construct() {
        $this->campos = array();
    }

    // ******** para mostrar campo
    function mostrarCampoInput($tipo, $label, $id, $valor, $requerido, $error) {
        if ($tipo != 'hidden') {
            $dato = "<div class='form-group'>";
            if ($label != '') $dato .= " <label for='".$id."'>".$label.":</label>";
            $dato .= "<input class='form-control input-sm' type='".$tipo."' name='".$id."' id='".$id."' value='".$valor."' ".$requerido." data-error='".$error."' placeholder='".$label."' />";
            if ($error != '') $dato .= " <div class='help-block with-errors'></div>";
            $dato .= "</div>";
        } else {
            $dato = "<input class='form-control' type='".$tipo."' name='".$id."' id='".$id."' value='".$valor."' />";
        }
        return $this->resultado = $dato;
    }

    // ******** para mostrar campo select
    function mostrarCampoSelect($tabla, $label, $id, $valor) {
        if ($tabla == 'categoria') {
            $dato = "<div class='form-group'>";
            $dato .= " <label for='".$id."'>".$label.":</label>";
            $dato .= "<select class='form-control input-sm' name='".$id."' id='".$id."'>";
            $dato .= "<option value='".$valor."' selected='selected'>".$valor."  </option>";
            $dato .= "<option value='Administrador'>Administrador</option>";
            $dato .= "<option value='Cliente'>Cliente</option>";
            $dato .= "</select>";
            $dato .= "</div>";
        }
        return $this->resultado = $dato;
    }

    // ******** para mostrar campo textarea
    function mostrarCampoTextarea($columnas, $id, $valor) {
        $dato = " <div class='form-group'>";
        $dato .= " <textarea class='form-control' rows='".$columnas."' name='".$id."' id='".$id."'>".$valor."</textarea>";
        $dato .= "</div>";
        return $this->resultado = $dato;
    }

    // ******** para mostrar campo checkbox
    function mostrarCampoCheckbox($label, $id, $valor) {
        $dato = "<label for='".$id."' class='ui-state-default masespacio'>".$label.":</label>";
        $dato .= "<span id='".$id."' class='radios'>";
        if ($valor == "Si") $texto = "checked='checked'"; else $texto = "";
        $dato .= "<label for='".$id."1'>Si</label> <input type='radio' id='".$id."1' name='".$id."' value='Si' ".$texto." />";
        if ($valor == "No") $texto = "checked='checked'"; else $texto = "";
        $dato .= "<label for='".$id."2'>No</label> <input type='radio' id='".$id."2' name='".$id."' value='No' ".$texto." />";
        if ($valor == " ") $texto = "checked='checked'"; else $texto = "";
        $dato .= "<label for='".$id."3'>N/D</label> <input type='radio' id='".$id."3' name='".$id."' value=' ' ".$texto." />";
        $dato .= "</span>"; 

        return $this->resultado = $dato;
    }
}
?>
