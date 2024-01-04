<div id="profile-page" class="container-fluid p-0 overflow-hidden">
    <div id="profile-section" class="p-3 text-primary-emphasis bg-primary-subtle border border-primary-subtle rounded-3 d-flex align-items-center">
      
    <div class="bg-image ripple d-flex flex-column align-items-center" data-mdb-ripple-color="light">
        <img src="images/ImageUpload.png" id="profile-pic" class="img-thumbnail" style="width: 150px; height: 150px;" />
        <label class="btn btn-dark mt-2" for="formFile">Update Image</label>
        <input class="d-none" type="file" id="formFile">
    </div>
        <script>
            let profilePic = document.getElementById("profile-pic");
            let inputFile = document.getElementById("formFile");

            inputFile.onchange = function(){
                profilePic.src = URL.createObjectURL(inputFile.files[0]);
            }
        </script> 

        <div id="profile-info" class="mx-auto text-center">
            <h2>Nome Utente</h2>
            
            <div id="profile-stats" class="mt-5">
                <p>Follower: 100 | Following: 50 | Tracks: 200</p>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mb-4">
        <div class="col-md-10 col-11">
            <div class="row">
                <ul class="nav nav-pills">
                    <li class="nav-item px-2 my-2 text-center col-3 col-md-3 ">
                        <button type="button" class="btn btn-dark">Post</button>
                    </li>
                    <li class="nav-item px-2 my-2 text-center col-3 col-md-3">
                        <button type="button" class="btn btn-dark">Popular</button>
                    </li>
                    <li class="nav-item px-2 my-2 text-center col-3 col-md-3">
                        <button type="button" class="btn btn-dark">Albums</button>
                    </li>
                    <li class="nav-item px-2 my-2 text-center col-3 col-md-3">
                        <button type="button" class="btn btn-dark">Playlist</button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
