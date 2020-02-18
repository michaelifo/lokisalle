<nav class="navbar navbar-expand-lg navbar-light bg-light">
 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Accueil <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php">Contact <span class="sr-only">(current)</span></a>
      </li>
    </ul>
    <ul class="form-inline my-2 my-lg-0 navbar-nav">
      
    <?php if (!isset($_SESSION['auth'])) : ?>
    <?php else : ?>
      <?php $user_statut = $_SESSION['auth']->statut; ?>
       
      <?php if ($user_statut != 1) : ?>

      <?php else : ?>

      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Espace Admin</a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="memberManagement.php">Gestions des membres</a>
            <a class="dropdown-item" href="productManagement.php">Gestions des produits</a>
            <a class="dropdown-item" href="roomManagement.php">Gestions des salles</a>
            <a class="dropdown-item" href="commandeManagement.php">Gestions des commandes</a>
            <a class="dropdown-item" href="reviewManagement.php">Gestions des avis</a>
            <a class="dropdown-item" href="statManagement.php">Statistiques</a>
          </div>
        </li>
       <?php endif; ?>
    <?php endif; ?>  
       <li class="nav-item dropdown"> 
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Espace Membre</a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php if (isset($_SESSION['auth'])): ?>
              
              <a class="dropdown-item" href="account.php">Profil</a>
              <a class="dropdown-item" href="logout.php">Deconnexion</a>       
            <?php else : ?>
              <a class="dropdown-item" href="subscribe.php">Inscription</a>
              <a class="dropdown-item" href="login.php">Connexion</a>
            <?php endif; ?>
          </div>
        </li>
        
    </ul>
  </div>
</nav>

