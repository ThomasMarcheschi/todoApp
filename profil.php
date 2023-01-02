<?php
session_start();
?>


<!DOCTYPE html>
<html lang="fr">
  <?php
    $title="Page de profil";
    include_once "./components/head.php";
  ?>
  <body>
    <?php
      include_once "./components/navbar.php";
    ?>
    <h1>Votre page de profil</h1>
  <div class="profil-info">
    <img id="avatar" src='<?="./images/users/".$_SESSION['avatar'] ?>'>
    <p><?= $_SESSION['email'] ?></p>

    <form action="/routes/uploadAvatar.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="avatar" accept="image/png, image/jpeg">
    <button type="submit">Enregistrer</button>

    </form>
  </div>
  </body>
</html> 