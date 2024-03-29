<?php 
if(isset($_FILES["profile-picture"])){
    $immagine = $_FILES["profile-picture"];
    $idImage = uploadSource($dbh, $immagine);
    if (!is_null($idImage)) {
        $dbh->updateIdImageUser($idImage, $templateParams["utente"]["ID"]);
    }
}   
?>

<?php 
if(isset($_POST["seguire"])){
    $dbh->followUser($templateParams["utente"]["ID"], $_SESSION["ID"]);
    $dbh->addNotification($templateParams["utente"]["ID"], $_SESSION["ID"], "ora ti segue", null);
}
?>

<?php 
if(isset($_POST["unfollow"])){
    $dbh->unfollowUser($templateParams["utente"]["ID"], $_SESSION["ID"]);
}
?>

<div id="profile-page" class="container-fluid p-0 overflow-hidden">
    <div id="profile-section" class="p-3 text-primary-emphasis bg-primary-subtle border border-primary-subtle rounded-3 d-flex flex-row align-items-center">
        <?php
        $userID = $templateParams["utente"]["ID"];
        $profileImageID = $dbh->getUserImageID($userID);
        $imageID = (!is_null($profileImageID)) ? "download.php?id=" . $profileImageID : "images/default.jpg";
        ?>
        <div class="bg-image ripple">
            <img <?php echo "src=\"".$imageID."\""; ?>  id="profile-picture" class="img-thumbnail rounded-circle" style="width: 100px; height: 100px; object-fit: cover;" alt="Profile picture">
            <?php if(isset($_SESSION["ID"])): ?>
                <?php if($templateParams["utente"]["ID"] === $_SESSION["ID"]): ?>
                    <form id="profilePictureUpload" method="POST" enctype="multipart/form-data" class="ml-3">
                        <label class="btn btn-dark btn-sm" for="formFile">Update Image</label>
                        <input title="cambia immagine profilo" class="d-none" type="file" id="formFile" name="profile-picture" accept="image/jpeg,image/png,image/webp,image/avif" onchange="this.form.submit()">
                    </form>
                <?php elseif($dbh->isUserFollowed($_SESSION["ID"], $templateParams["utente"]["ID"])): ?>
                    <form id="UnfollowingUser" method="POST" class="ms-3">
                        <input title="non seguire più" type="submit" class="btn btn-secondary btn-sm" value="Segui già" name="unfollow">
                    </form>
                <?php else: ?>
                    <form id="FollowingUser" method="POST" class="ms-4">
                        <input title="segui" type="submit" class="btn btn-dark btn-sm" value="Segui" name="seguire">
                    </form>
                <?php endif ?>
            <?php endif ?>    
        </div>   

        <div id="profile-info" class="mx-auto text-center ml-3">
            <p class="h2 mb-3"><?php echo $templateParams["utente"]["Username"]; ?></p>
            
            <div id="profile-stats">
                <?php
                $followers = $dbh->getFollowerOfUser($userID);
                $followings = $dbh->getFollowingOfUser($userID);
                ?>
                <p class="d-none d-md-block">Seguaci: <?php echo is_null($followers["num_followers"]) ? 0 : $followers["num_followers"]; ?> | Seguiti: <?php echo is_null($followings["num_following"]) ? 0 : $followings["num_following"]; ?> | Tracce: <?php echo $dbh->getSongCountByUser($templateParams["utente"]["ID"]); ?></p>
                <div class="d-md-none">
                    <p title="seguaci">Seguaci: <?php echo is_null($followers["num_followers"]) ? 0 : $followers["num_followers"]; ?></p>
                    <p title="seguiti" >Seguiti: <?php echo is_null($followings["num_following"]) ? 0 : $followings["num_following"]; ?></p>
                    <p title="numero di tracce">Tracce: <?php echo $dbh->getSongCountByUser($templateParams["utente"]["ID"]); ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-3 mb-3 d-md-none" id="filterInProfile">
        <button title="filtra" type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown">
                Filtra Post
            </button>
            <ul class="dropdown-menu">
                <li class="nav-item col-12 col-md-3 mb-2 text-center">
                    <a title="tutti i post" href="allPostProfile.php?id=<?php echo $templateParams['utente']['ID']; ?>" class="dropdown-item" style="text-decoration:none">Post</a>
                </li>
                <li class="nav-item col-12 col-md-3 mb-2 text-center">
                    <a title="canzoni" href="songPostProfile.php?id=<?php echo $templateParams['utente']['ID'];?>" class="dropdown-item" style="text-decoration:none">Canzoni</a>
                </li>
                <li class="nav-item col-12 col-md-3 mb-2 text-center">
                    <a title="album" href="albumPostProfile.php?id=<?php echo $templateParams['utente']['ID'];?>" class="dropdown-item" style="text-decoration:none">Album</a>
                </li>
                <li class="nav-item col-12 col-md-3 mb-2 text-center">
                    <a title="playlist" href="playlistPostProfile.php?id=<?php echo $templateParams['utente']['ID'];?>" class="dropdown-item" style="text-decoration:none">Playlist</a>
                </li>
                </ul>
    </div>

    <div class="row justify-content-center mt-4 hide-on-mobile">
        
        <div class="col-md-10 col-11">
            <div class="row">
                <ul class="nav nav-pills flex-column flex-md-row">
                    <li class="nav-item col-12 col-md-3 mb-2 text-center">
                        <a title="tutti" href="allPostProfile.php?id=<?php echo $templateParams['utente']['ID']; ?>" class="btn btn-dark btn-block" style="text-decoration:none">Post</a>
                    </li>
                    <li class="nav-item col-12 col-md-3 mb-2 text-center">
                        <a title="canzoni" href="songPostProfile.php?id=<?php echo $templateParams['utente']['ID'];?>" class="btn btn-dark btn-block" style="text-decoration:none">Canzoni</a>
                    </li>
                    <li class="nav-item col-12 col-md-3 mb-2 text-center">
                        <a title="album" href="albumPostProfile.php?id=<?php echo $templateParams['utente']['ID'];?>" class="btn btn-dark btn-block" style="text-decoration:none">Album</a>
                    </li>
                    <li class="nav-item col-12 col-md-3 mb-2 text-center">
                        <a title="playlist" href="playlistPostProfile.php?id=<?php echo $templateParams['utente']['ID'];?>" class="btn btn-dark btn-block" style="text-decoration:none">Playlist</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="navDetailed">
    <?php
    if(isset($templateParams["voceNav"])){
        require_once("template/" . $templateParams["voceNav"]);
    }
    ?>
</div>
