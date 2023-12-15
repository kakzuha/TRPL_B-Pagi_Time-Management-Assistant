<?php
session_start();
session_destroy();
?>
<script type="text/javascript">
    alert('You have signed out');
    location.href = 'auth-sign-in.php';
</script>