<?php

function showToast($heading, $message, $icon)
{
echo "<script>
Swal.fire(
  '$heading',
  '$message',
  '$icon'
)
</script>";
}

?>