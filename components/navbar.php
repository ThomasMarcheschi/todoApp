<nav>

<i class="bi bi-list" id="menu-button"></i>

  <ul style="left:-100%;">
    <li><a href="/">Accueil</a></li>
    <?php
      // if(isset($_SESSION) && isset($_SESSION['id'])){
      //   echo'<li><a href="/profil">Profil</a></li>';
      // }else{
      //   echo '<li><a href="/login">Se connecter</a></li>';
      // }
    ?>
    <li>
      <a href="<?= isset($_SESSION) && isset($_SESSION['id']) ? "/profil" :"/login" ?>"> 
        <?= isset($_SESSION) && isset($_SESSION['id']) ? "Profil" :"Se connecter" ?>
      </a>
    </li>
  </ul>
</nav>

<script src="/scripts/navbar.js" ></script>
