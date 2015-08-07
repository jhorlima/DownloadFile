<?php

namespace Core;

/**
 * Class DownloadFile
 * Class to help download files with try catch
 * @package Core
 * Author: Jhordan Lima
 * Link: https://github.com/Jhorzyto/DownloadFile
 */
class DownloadFile {

    private $validatorExtension;
    private $fileInfo;
    private $newName;

    /**
     * @return SplFileInfo object
     */
    public function getFileInfo()
    {
        return $this->fileInfo;
    }

    /**
     * @param $filePatch
     * @return $this
     */
    public function setFile( $filePatch )
    {
        $this->fileInfo = new \SplFileInfo( $filePatch );
        return $this;
    }

    /**
     * @param $newName
     * @param bool $haveExtension
     * @param null $extension
     * @return $this
     */
    public function setNewName( $newName , $haveExtension = true , $extension = null ){

        $this->newName = is_string( $newName ) ? $newName : null ;

        if( !is_null( $this->newName ) && ( $haveExtension == false || !is_null( $extension ) ) ){

            if( is_string( $extension ) )
                $this->newName .= ".{$extension}";

            elseif( $this->fileInfo instanceof \SplFileInfo && !$haveExtension )
                $this->newName .= ".{$this->fileInfo->getExtension()}";

        }

        return $this;
    }

    /**
     * @param array $validatorExtension extensionList e.g: ['jpg' , 'png', 'gif',]
     * @return $this
     */
    public function setValidatorExtension( array $validatorExtension )
    {
        $this->validatorExtension = $validatorExtension;
        return $this;
    }

    /**
     * Try download file
     */
    public function download()
    {
        if( $this->fileInfo instanceof \SplFileInfo )

            if ( $this->fileInfo->isFile() ) {

                if( is_array( $this->validatorExtension ) )
                    if( !in_array( $this->fileInfo->getExtension(), $this->validatorExtension) )
                        throw new \Exception( "Extensão invalida!" );

                if( !$this->fileInfo->isReadable() )
                    throw new \Exception( "O Arquivo não pode ser lido!" );

                if( is_null( $this->newName ) )
                    $this->setNewName( $this->fileInfo->getBasename() );
                    
                $finfo = new \finfo;
                header("Content-Type: {$finfo->file( $this->fileInfo->getRealPath(), FILEINFO_MIME)}");
                header("Content-Length: {$this->fileInfo->getSize()}");
                header("Content-Disposition: attachment; filename={$this->newName}");
                readfile( $this->fileInfo->getRealPath() );

            } else
                throw new \Exception( "Por favor, adicione um arquivo valido!" );
        else
            throw new \Exception( "Por favor, adicione o arquivo primeiro!" );
    }
}
