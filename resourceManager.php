<?php
    function uploadSource($dbh, $resource) {
        $idSource = null;
        if (isset($resource)) {
                if ($resource["error"] == 0) {
                    $idSource = $dbh->storeResource($resource);
                } 
            }
        return $idSource;
    }
?>