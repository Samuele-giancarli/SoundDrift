<form id="searchForm" class="mt-4">
    <fieldset>
        <legend>Cerca utenti o musica</legend>
    </fieldset>
<div class="mb-3">
            <label for="searchInput" class="form-label" style="display:none">Cerca:</label>
            <input title="cerca nel sito" type="text" autocomplete="off" class="form-control" name="searchInput" id="searchInput" placeholder="Inserisci la tua ricerca">
        </div>
   

<div id="searchResults" class="mb-3">
        <!-- Qui verranno visualizzati i risultati della ricerca in tempo reale -->
</div>

</form>

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
                    let output;
                    // Pulisci i risultati precedenti
                    document.getElementById('searchResults').innerHTML = "";

                    searchResults.innerHTML += response;
                    
                }
            };

            
            xhr.open('GET', './template/ricercaDati.php?q=' + searchInput, true);
            xhr.send();

        }
</script>

<?php
?>
