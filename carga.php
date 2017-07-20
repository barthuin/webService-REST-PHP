<?php
function getPlaylists($idCanal) {

        $key = 'AIzaSyBKXvbRkqTtaAE1-yHRX_4LVbYClnfBElU';
        $channel = $idCanal; //ejemplo: UCL-aihy3UD61TmvCOL9szUw

        $url = "https://www.googleapis.com/youtube/v3/playlists?key=$key&channelId=$channel&part=snippet,id&order=date&maxResults=50";

        $json = file_get_contents($url);

        $obj = json_decode($json, true);

        //var_dump($obj);

        return $obj;
    }

function getVideosByPlaylists($idPlaylist) {

        $key = 'AIzaSyBKXvbRkqTtaAE1-yHRX_4LVbYClnfBElU';
        
        $url = "https://www.googleapis.com/youtube/v3/playlistItems?key=$key&playlistId=$idPlaylist&part=snippet,id&order=date&maxResults=50";

        $json = file_get_contents($url);

        $obj = json_decode($json, true);

        //var_dump($obj);

        return $obj;
    }

	include_once('./src/model/dao/daoGenerico.php');
	include_once('./src/model/dao/daoCanal.php');
	include_once('./src/model/dao/daoPlaylist.php');
	include_once('./src/model/dao/daoVideo.php');
	include_once('./src/model/dto/Playlist.php');
	include_once('./src/model/dto/Videos.php');

	$daoCanal = new daoCanal();
	$daoPlaylist = new daoPlaylist();
	$daoVideo = new daoVideo();
    $canales = $daoCanal->listAll('Canales');

    foreach ($canales as $canal) {
	    echo ($canal->getNombre()."\n");

	    //buscamos las playlist del canal
		$playlistsYT = getPlaylists($canal->getUrl());

		foreach ($playlistsYT['items'] as $playlistYT) {

			//obtenemos los valores y buscamos en BD si ya existe esa playlist
    		$idcanal = $canal;
    		$idYoutube = $playlistYT["id"];
    		$titulo = $playlistYT["snippet"]["title"];
    		$descripcion = $playlistYT["snippet"]["description"];
    		$imagen = $playlistYT["snippet"]["thumbnails"]["high"]["url"];
    		$ingles = $canal->getIngles();
	    	
	    	$playlist = new model\dto\Playlist($idYoutube, $descripcion, $ingles, $titulo, $imagen, $idcanal);

	    	$playlistBD = $daoPlaylist->findByIdYoutube('Playlist',$playlist);

	    	if(!$playlistBD){
	    		//si no existe, se crea
	    		echo ("Playlist: ".$playlist->getTitulo()."\n");
	    		$daoPlaylist->insert($playlist);
	    		$playlistBD = $daoPlaylist->findByIdYoutube('Playlist',$playlist);
	    	}
	    	//actualizamos el objeto $playlist para guardar el id generado
	    	$playlist->setId($playlistBD->getId());

	    	//buscamos los videos correspondientes a esa playlist
	    	$videosYT = getVideosByPlaylists($playlist->getidYoutube());
						
			foreach ($videosYT['items'] as $videoYT) {

				//obtenemos los valores
				$idPlaylist = $playlist;
				$idYoutube = $videoYT["snippet"]["resourceId"]["videoId"];
	    		$titulo = $videoYT["snippet"]["title"];

	    		//si el video no tiene thumbnails, es que ha sido eliminado o es privado
	    		if(isset($videoYT["snippet"]["thumbnails"])){
					$imagen = $videoYT["snippet"]["thumbnails"]["high"]["url"];

		    		$video = new model\dto\Videos($idYoutube, $titulo, $imagen, $idPlaylist);

		    		//buscamos en BD si ya existe ese video
		    		$existe = $daoVideo->findByIdYoutube('Videos',$video);

			    	if(!$existe){
			    		echo ("-->".$video->getTitulo()."\n");
			    		$daoVideo->insert($video);
			    	}	
				}
			}
	    }
	}
?>