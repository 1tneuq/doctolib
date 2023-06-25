<?php
function form_begin($class, $method, $action) {
    echo ("\n<!-- ============================================== -->\n");
    echo ("<!-- form_begin : $class $method $action) -->\n");
    printf("<form class='%s' method='%s' action='%s'>\n", $class, $method, $action);
}

function form_input_text($label, $name, $size, $value, $type) {
    echo ("\n<!-- form_input_text : $label $name $size $value -->\n");
    echo ("  <div class='form-group row mt-2'>\n");

    echo ("<label for='$name' class='col-4 col-form-label fw-bold'>$label:</label>\n");
    echo ("<div class='col-8'>\n");
    echo ("<input type='$type' class='form-control' name='$name' size='$size' value='$value'>\n");
    echo ("</div>\n");

    echo ("</div>\n");
}

function form_select($label, $name, $multiple, $size, $liste) {
    echo ('<div class="col-md-6 form-group mt-2">');
    echo('<label for="'.$name.'" class="form-label fw-bold">'.$label.'</label>'.'<br><select '.$multiple.' class="form-select" name="'.$name.($multiple ? '[]' : '').'" size="'.$size.'">');
    foreach ($liste as $option){
        echo '<option>'.$option.'</option>';
    }
    echo '</select> </div>';
}

function form_select_drop($label, $name, $multiple, $options) {
    echo '<div class="form-group col-md-12 mt-2">';
    echo '<label for="' . $name . '" class="form-label fw-bold">' . $label . '</label>';
    echo '<select name="' . $name . '"';

    if ($multiple) {
        echo ' multiple';
    }

    echo ' class="form-select" >';

    foreach ($options as $option) {
        echo '<option>' . $option . '</option>';
    }

    echo '</select>';
    echo '</div>';
}

function form_input_reset($value) {
    echo '<input type="reset" value="'.$value.'" class="btn btn-danger">';
}

function form_input_submit($value) {
    echo "<div class='text-center'>";
    echo '<br/><input type="submit" value="'.$value.'" class="btn btn-success">';
    echo "</div>";
}

function form_end() {
    echo '</form>';
}

?>
