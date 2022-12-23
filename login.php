<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<?php
  $title="Connexion";
  include_once "./components/head.php";
?>
  <body>
    <?php
      include_once "./components/navbar.php";
    ?>
    
    <h1>Se connecter</h1>

    <main>
      <section>
        <h2>Inscription</h2>
        <form action="/routes/signup.php" method="post">
          <input type="email" name="email" placeholder="john.doe@exemple.com" />
          <!-- Tester si la clé errorEmail existe dans le tableau $_GET -->
          <p>
            <?= isset($_GET['emailError']) ? "Email invalide" : "" ?>
          </p>
          
          <input type="password" name="password" placeholder="Mot de passe" />
          <p>
            <?= isset($_GET['passwordError']) ? "Mot de passe trop court" : "" ?>
          </p>
          <button>Valider</button>
        </form>
      </section>

      <section>
        <h2>Connexion</h2>
        <form action="./routes/signin.php" method="post">
          <input type="email" name="email" placeholder="john@exemple.com">
          <input type="password" name="password" placeholder="Votre mot de passe">
          <button>Valider</button>
        </form>
      </section>
    </main>
    
  </body>
</html>