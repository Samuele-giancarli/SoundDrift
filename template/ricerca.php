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
