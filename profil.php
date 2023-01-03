<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT']. "/controllers/UserController.php";
$userController = UserController::createUserFromId($_SESSION['id']);
?>

<!DOCTYPE html>
<html lang="en">
  <?php
    $title="Page de profil";
    include_once "./components/head.php";
  ?>
  <body>
    <?php
      include_once "./components/navbar.php";
    ?>
   
    <div class="profil-infos">
      <img id="avatar" src='<?= "/images/users/". $_SESSION['avatar'] ?>'> 
      <p><?= $_SESSION['email'] ?></p>

      <form action="/routes/uploadAvatar.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="avatar" accept="image/png, image/jpeg" />
        <button type="submit">Enregistrer</button>
      </form>
    </div>

    <section>
      <h2>Todos</h2>
      <form action="/routes/addTodo.php" method="POST">
        <input type="text" name="todo" placeholder="Ajouter une tache" />
        <button>Ajouter +</button>
      </form>
      <i class='fa-solid fa-check'></i>
      <div>
        <?php
          foreach($userController -> getTodos() as $key => $todoTab){
            echo "
            <div class='todo ".($todoTab['isDone'] ? "todoDone" : "todoNotDone")."'>
              <p>".$todoTab['content']."</p>
              <div class='todo-controls'>
                ".(!$todoTab['isDone'] ? 
                "<form class='validateForm' action='/routes/validateTodo.php' method='GET'>
                  <button type='submit' name='validate' value='".$todoTab['id']."'>
                    <img src='/images/check.svg' />
                  </button>
                </form>" : "")."
                <form class='validateForm' action='/routes/removeTodo.php' method='get'>
                  <button name='remove' value='".$todoTab['id']."'>
                    <img src='/images/remove.svg' />
                  </button>
                </form>
              </div>
              </div>
            ";
          }
        ?>
      </div>
    </section>

  </body>
</html>