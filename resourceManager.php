<?php
    function uploadSource($dbh, $resource) {
        if (isset($resource)) {
                if ($resource["error"] == 0) {
                    $idSource = $dbh->storeResource($resource);
                } 
            }
        return $idSource;
    }
?>