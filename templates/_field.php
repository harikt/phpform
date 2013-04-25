<?php
$errors = $this->form->getMessages($this->name);
if ($errors) {
    echo '<ul>';
    foreach ($errors as $error) {
        echo '<li>' . $error . '</li>';
    }
    echo '</ul>';
}
?>
