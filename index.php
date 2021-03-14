<?php include("header.php");
    ?>

<?php
    $mp3Files = glob("webpage/songs/*.mp3");
    $txtFiles = glob("webpage/songs/*.txt");
    ?>

<div id="header">

    <h1>190M Music Playlist Viewer</h1>
    <h2>Search Through Your Playlists and Music</h2>
</div>


<div id="listarea">
    <ul id="musiclist">
        <?php
            if(!isset($_REQUEST['playlist'])){
            foreach($mp3Files as $mp3File){
            $mp3FileName = basename($mp3File);
            $mp3FileSize = filesize($mp3File);
            if($mp3FileSize < 1024){$mp3FileSize=" (".$mp3FileSize." b)";}
            elseif($mp3FileSize>1023 && $mp3FileSize<1048575){$mp3FileSize=" (".round($mp3FileSize/1024,2)." kb)";}
            elseif($mp3FileSize>1048575){$mp3FileSize=" (".round($mp3FileSize/1048576,2)." mb)";}
            ?>
            <li class="mp3item">
                <a href="/webpage/songs/<?=$mp3FileName ?>"> <?=$mp3FileName.$mp3FileSize ?> </a>

            </li>
        <?php }
            foreach($txtFiles as $txtFile){
                $txtFileName = basename($txtFile);
                ?>
            <li class="playlistitem">
                <a href="/index.php?playlist=<?=$txtFileName ?>"> <?=$txtFileName ?> </a>
            </li>
        <?php }
            }
            else{
                $fileWithSongs = fopen("webpage/songs/".$_REQUEST['playlist'],"r");
                if ($fileWithSongs) {
                    while (($line = fgets($fileWithSongs)) !== false) {
                        ?>
                        <li class="mp3item">
                            <a href="/webpage/songs/<?=$line ?>"> <?=$line?> </a>

                        </li>
                        <?php
                    }
                    fclose($fileWithSongs);
                    ?> <li>
                    <a href="index.php">Back to main menu</a>

                    </li>
                    <?php
                }
            }
            ?>
    </ul>
</div>

<?php include("footer.php");
    ?>

