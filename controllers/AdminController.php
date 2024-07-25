<?php

namespace Controllers;

use Core\AbstractController;
use Core\FlashBag;
use Managers\CategoryManager;
use Managers\PlateformManager;
use Managers\GameManager;

class AdminController extends AbstractController
{
    
    public function showNewGame()
    {
        $categoryManager = new CategoryManager();
        $plateformManager = new PlateformManager();
        
        $this->render('admin/newGame.phtml', [
            'categories' => $categoryManager->findAll(),    
            'plateforms' => $plateformManager->findAll(),    
        ]);
    }
    
    public function addGame()
    {
        /*
        var_dump( $_POST );
        array (size=4)
          'title' => string 'cs2' (length=3)
          'release_year' => string '2023' (length=4)
          'category_id' => string '1' (length=1)
          'plateform_id' => string '1' (length=1)
        var_dump( $_FILES );
        array (size=1)
          'jacket' => 
            array (size=6)
              'name' => string 'cs2.jpeg' (length=8)            // Nom original du fichier
              'full_path' => string 'cs2.jpeg' (length=8)       // chemin complet
              'type' => string 'image/jpeg' (length=10)         // MIME Type du fichier
              'tmp_name' => string '/tmp/phptL3TBa' (length=14) // Nom du fichier temporaire dans le dossier /tmp
              'error' => int 0                                  // Code d'erreur
              'size' => int 7365                                // Poids du fichier en bytes
              
              
        CODES D'ERREUR
        
        0 : UPLOAD_ERR_OK
        tout s'est passé, le fichier a bien été transmis au server
        
        1 : UPLOAD_ERR_INI_SIZE
        On dépasse la taille maximum de poids défini par le serveur ( dans php.ini )
        
        2 : UPLOAD_ERR_FORM_SIZE
        On dépasse le poids du fichier autorisé dans coté front
        
        3 : UPLOAD_ERR_PARTIAL
        Fichier est partiellement chargé (perte de paquet)
        
        4 : UPLOAD_ERR_NO_FILE
        le champs est transmis sans fichier
        
        6 : UPLOAD_ERR_NO_TMP_DIR
        le dossier /tmp est absent ou introuvable
        
        7 : UPLOAD_ERR_CANT_WRITE
        le fichier n'a pas pu etre écrit sur le disque
        
        8 : UPLOAD_ERR_EXTENSION
        Une erreur qui n'est pas inclue dans les autres codes
           
        */
        
        // .... enregistrement du fichier sur le serveur basic :
        
        // $originalName    = $_FILES['jacket']['name'];
        // $destinationPath = './public/uploads/';
        // $fullDestination = $destinationPath . $originalName;
        // $tmpPathFile     = $_FILES['jacket']['tmp_name'];
        
        // move_uploaded_file( $tmpPathFile , $fullDestination );
        
        // ENREGISTREMENT AVEC UN MINIMUM DE SECURITE
        
        try
        {
            if(
                !isset( $_POST['title'] ) || empty( $_POST['title'] ) ||
                !isset( $_POST['release_year'] ) || empty( $_POST['release_year'] ) ||
                !isset( $_POST['category_id'] ) || empty( $_POST['category_id'] ) ||
                !isset( $_POST['plateform_id'] ) || empty( $_POST['plateform_id'] ) ||
                !isset( $_FILES['jacket'] ) || $_FILES['jacket']['error'] === 4
            )
            {
                throw new \Exception("All fields are mandatory.");
            }
            
            $validMimeTypes = [ 'image/jpg', 'image/jpeg', 'image/png' ];
            $validFileExtensions = [ 'jpg', 'jpeg', 'png' ];
        
            $originalName        = $_FILES['jacket']['name'];
            $tmpPathFile         = $_FILES['jacket']['tmp_name'];
            $uploadedFileType    = $_FILES['jacket']['type'];
            $uploadedFileSize    = $_FILES['jacket']['size'];
            $uploadedFileErrCode = $_FILES['jacket']['error'];
            $xplodedFileName     = explode('.', $originalName);
            $finalName           = uniqid();
            
            if( 
                !in_array( mime_content_type( $tmpPathFile ), $validMimeTypes ) ||
                !in_array($uploadedFileType, $validMimeTypes) ||
                count( $xplodedFileName ) !== 2 ||
                !in_array( $xplodedFileName[1] , $validFileExtensions)
            )
            {
                throw new \Exception("Please upload a JPG, JPEG or PNG file.");
            }
            
            if( $uploadedFileErrCode === 1 || $uploadedFileErrCode === 2 || $uploadedFileSize > 2000000 )
            {
                throw new \Exception("Exceed max file size (max 2Mo).");
            }
            
            if( $uploadedFileErrCode !== 0 )
            {
                throw new \Exception("Something went wrong. Please try again.");
            }
            
            $finalPath = './public/uploads/' . $finalName . '.' . $xplodedFileName[1];
            
            if( !move_uploaded_file( $tmpPathFile , $finalPath ) )
            {
                throw new \Exception("Fail to upload. Please try again");
            }
            
            $gameManager = new GameManager();
            
            $newGame = $_POST;
            $newGame['jacket'] = $finalPath ;
            
            $gameManager->createGame( $newGame );
            
            FlashBag::set( "Game added successfully" , 'success');
            $this->redirectTo('home');
        }
        catch( \Exception $e )
        {
            FlashBag::set( $e->getMessage() , 'error');
            $this->redirectTo('newGame');
        }
    }
    
}