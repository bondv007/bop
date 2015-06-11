<?php

if (isset($invalidfields)) {
    echo " <p class='top15 gray12'><table>
        <tr><th>Fields</th><th>Error</th><tr>";
    foreach ($invalidfields as $key => $field) {
        echo "<tr><td>" . $key . "</td><td>";
        echo "<ul>";
        foreach ($field as $error) {
            echo "<li>" . $error . "</li>";
        }
        echo "</ul></td></tr>";
    }
    echo "</table>  </p>";
}
?>
