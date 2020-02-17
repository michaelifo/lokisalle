<?php require_once "functions.php" ?>

<?php require_once "header.php"; ?>

<div class="container">
    
    <h1>Contact</h1>
    
    <form method="POST" class="mt-4">
        <div class="form-group">
            <label for="">Nos équipes sont à votre disposition, n'hésitez pas à nous faire part de vos problèmes rencontrer sur notre site :</label>
            <input type="email" name="email" class="form-control" placeholder="Votre adresse email" >
        </div>
        <div class="form-group">
            <label for=""></label>
            <input type="text" name="email" class="form-control"  placeholder="Le sujet de votre demande" >
        </div>

        <div class="form-group my-4">
            <label for="exampleFormControlTextarea"></label>
            <textarea class="form-control" id="exampleFormControlTextarea" name="prix" rows="2" placeholder="Veuillez écrire ici votre message..."></textarea>
         </div>

        <button type="submit" name="submit" class="btn btn-primary">Envoyer</button>    
    </form>
</div>    


<?php require_once "footer.php"; ?>