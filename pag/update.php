<?php
header('Location: actualizar.php' . (isset($_GET['id']) ? '?id=' . urlencode($_GET['id']) : ''));
exit();
