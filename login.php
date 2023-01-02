<?php
session_start();

$inscriptionEmailError = "";
$inscriptionPasswordError = "";

$connexionEmailError = "";
$connexionPasswordError = "";


if(isset($_GET['inscription'])){
  if(isset($_GET['emailError'])){
    $inscriptionEmailError = $_GET['emailError'] === "InputInvalid" ? "Email incorrecte" : "Email existe deja!";
  }

  if(isset($_GET['passwordError'])){
    $inscriptionPasswordError = $_GET['passwordError'] === "InputInvalid" ? "Mot de passe trop court" : "";
  }
}

if(isset($_GET['connexion'])){
  if(isset($_GET['emailError'])){
    $connexionEmailError = $_GET['emailError'] === "InputInvalid" ? "Email incorrecte" : "Email n'existe pas!";
  }

  if(isset($_GET['passwordError'])){
    $connexionPasswordError = $_GET['passwordError'] === "InputInvalid" ? "Mot de passe trop court" : "Mauvais mot de passe!";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
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
          <input 
            class='<?= $inscriptionEmailError !=="" ? "inputError" : "" ?>' 
            type="email" 
            name="email" 
            placeholder="john.doe@exemple.com" 
          />
          <!-- Tester si la clé errorEmail existe dans le tableau $_GET -->
          <p class="error">
            <?= $inscriptionEmailError ?>
          </p>
          
          <input 
            class='<?= $inscriptionPasswordError !=="" ? "inputError" : "" ?>' 
            type="password" 
            name="password" 
            placeholder="Mot de passe"
          />
          <p class="error">
            <?= $inscriptionPasswordError ?>
          </p>
          <button>Valider</button>
        </form>
      </section>

      <section>
        <h2>Connexion</h2>
        <form action="./routes/signin.php" method="post">
          <input 
            class='<?= $connexionEmailError !=="" ? "inputError" : "" ?>' 
            type="email" 
            name="email" 
            placeholder="john@exemple.com"
          >
          <p class="error">
            <?= $connexionEmailError ?>
          </p>
          <input 
            class='<?= $connexionPasswordError !=="" ? "inputError" : "" ?>' 
            type="password" 
            name="password" 
            placeholder="Votre mot de passe"
          >
          <p class="error">
            <?= $connexionPasswordError ?>
          </p>
          
          <button>Valider</button>
        </form>
      </section>
    </main>
    
  </body>
</html>