<?php
session_start();
if (isset($_SESSION['user_id'])) {
  unset($_SESSION['user_id']);
  session_write_close();
}
header('Location: http://knitspiring.com/freecyclestoop/');
