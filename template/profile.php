        <?php 
        if(isset($_FILES["profile-picture"])){
            $immagine=$_FILES["profile-picture"];
            $idImage = uploadSource($dbh, $immagine);
            if (!is_null($idImage)) {
                $dbh->updateIdImageUser($idImage, $templateParams["utente"]["ID"]);
            }
        }   
            
        ?>

        <?php 
            if(isset($_POST["seguire"])){
                $dbh->followUser($templateParams["utente"]["ID"], $_SESSION["ID"]);
            }
        ?>

        <?php 
            if(isset($_POST["unfollow"])){
                $dbh->unfollowUser($templateParams["utente"]["ID"], $_SESSION["ID"]);
            }
        ?>


    <div id="profile-page" class="container-fluid p-0 overflow-hidden">
    <div id="profile-section" class="p-3 text-primary-emphasis bg-primary-subtle border border-primary-subtle rounded-3 d-flex align-items-center">
    <?php
    $userID = $templateParams["utente"]["ID"];
    $profileImageID=$dbh->getUserImageID($userID);
    if(!is_null($profileImageID)) {
        $imageID="download.php?id=".$profileImageID;
    } else {
        $imageID="default.png";
    }
    ?>
    <div class="bg-image ripple d-flex flex-column align-items-center" data-mdb-ripple-color="light">
        <img <?php echo "src=\"".$imageID."\""; ?>  id="profile-pic" class="img-thumbnail" style="width: 150px; height: 150px;" />
    <?php if(isset($_SESSION["ID"])): ?>
        <?php if($templateParams["utente"]["ID"] === $_SESSION["ID"]): ?>
        <form id="profilePictureUpload" method="POST" enctype="multipart/form-data">
            <label class="btn btn-dark mt-2" for="formFile">Update Image</label>
            <input class="d-none" type="file" id="formFile" name="profile-picture" accept="image/jpeg,image/png,image/webp,image/avif" onchange="this.form.submit()">
        </form>
        <?php elseif($dbh->isUserFollowed($_SESSION["ID"], $templateParams["utente"]["ID"])): ?>
            <form id="UnfollowingUser" method="POST">
                <input type="submit" class="btn btn-secondary mt-2" value="Segui già" name="unfollow">
            </form>
        <?php else: ?>
            <form id="FollowingUser" method="POST">
                <input type="submit" class="btn btn-primary mt-2" value="Segui" name="seguire">
            </form>
        <?php endif ?>
    <?php endif ?>    
    </div>   

        <div id="profile-info" class="mx-auto text-center">
            <h2><?php echo $templateParams["utente"]["Username"]; ?></h2>

            
            <div id="profile-stats" class="mt-5">
                <p>Seguaci: <?php if(is_null($templateParams["num_seguaci"]["num_followers"])){
                    echo 0;
                }else
                {
                    echo $templateParams["num_seguaci"]["num_followers"];
                }?> | Seguiti: <?php if(is_null($templateParams["num_seguiti"]["num_following"])){
                    echo 0;
                }else
                {
                    echo $templateParams["num_seguiti"]["num_following"];
                }?> | Tracce:
                    <?php
                    echo $dbh->getSongCountByUser($templateParams["utente"]["ID"]);
                    ?></p>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mb-4">
        <div class="col-md-10 col-11">
            <div class="row">
                <ul class="nav nav-pills">
                    <li class="nav-item px-2 my-2 text-center col-3 col-md-3 ">
                        <a href="allPostProfile.php?id=<?php echo $templateParams['utente']['ID']; ?>" class="btn btn-dark" style="text-decoration:none">
                            Post
                        </a>
                    </li>
                    <li class="nav-item px-2 my-2 text-center col-3 col-md-3">
                        <a href="songPostProfile.php?id=<?php echo $templateParams['utente']['ID'];?>" class="btn btn-dark" style="text-decoration:none">
                            Canzoni
                        </a>
                    </li>
                    <li class="nav-item px-2 my-2 text-center col-3 col-md-3">
                        <a href="albumPostProfile.php?id=<?php echo $templateParams['utente']['ID'];?>" class="btn btn-dark" style="text-decoration:none">
                            Album
                        </a>
                    </li>
                    <li class="nav-item px-2 my-2 text-center col-3 col-md-3">
                        <a href="playlistPostProfile.php?id=<?php echo $templateParams['utente']['ID'];?>" class="btn btn-dark" style="text-decoration:none">
                            Playlist
                        </a>
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
