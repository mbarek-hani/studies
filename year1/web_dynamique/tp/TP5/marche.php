<?php
setcookie("panier", "", time() - 3600);
header("Location:remplir.php");
echo "redirection vers remplir.php ....";
?>
