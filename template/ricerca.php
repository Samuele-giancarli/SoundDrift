<form id="searchForm">
    <input type="text" class="form-control" id="searchInput" name="searchInput" placeholder="Inserisci la tua ricerca">
</form>

<div id="searchResults">
        <!-- Qui verranno visualizzati i risultati della ricerca in tempo reale -->
</div>

<script>
        document.getElementById('searchInput').addEventListener('input', function() {
            search();
        });

        function search() {
            var searchInput = document.getElementById('searchInput').value;
            var xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    let response = xhr.responseText;
                    console.log(response);
                    let output;
                    // Pulisci i risultati precedenti
                    document.getElementById('searchResults').innerHTML = "";

                    try{
                        output = JSON.parse(response);
                        console.log(output);
                    }catch(e){
                        console.log(e); 
                    }
                    // iterate over results  
                    for( var i = 0; i < output.length; i++ ){  
                        // append result to result container, link to url of post

                        searchResults.innerHTML += "<a style='color: black' href='songPlayer.php?id=" + output[i]["IDSong"] + "'>ID Canzone: " + output[i]["IDSong"] + " Titolo:" + output[i]["Titolo"] + "</a></br>"; }  
                }
            };

            
            xhr.open('GET', './template/ricercaDati.php?q=' + searchInput, true);
            xhr.send();

        }
</script>
