</div>

</body>

</html>

<?php


\UserManagement\delete();
/* make sure nothing past the last </html> tag is sent */

ob_end_flush();

exit;


?>
