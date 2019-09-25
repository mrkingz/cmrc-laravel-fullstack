<?php

namespace App\Http\Traits;

use Image;
use Storage;
use App\File;
use Illuminate\Support\Facades\Auth;

trait FileTrait
{
    protected $owner = [
        Order::class => 1//, Publication::class => 2, BlogPost::class => 3
    ];

    protected $image_ext = ['jpg', 'jpeg', 'png', 'gif'];
    protected $audio_ext = ['mp3', 'ogg', 'mpga'];
    protected $video_ext = ['mp4', 'mpeg'];
    protected $document_ext = ['doc', 'docx', 'pdf', 'odt'];


    /**
     * Prefix to permanent storage for files
     */
    protected $permanentStoragePathPrefix = 'files';

    /**
     * Prefix to temp storage path
     */
    protected $tempStoragePathPrefix;

    /**
     * Create a temporary storage
     * 
     * @param bool $delete_exists indicates if existing directory should be deleted
     * @return string the created directory
     */
    protected function createTempStorage($delete_exists)
    {
        //Temp storage path
        $directory = $this->getTempStoragePath() . $this->getUserDirectoryName();

        // We need to check if existing directory should be deleted
        if ($delete_exists) { 
            $this->deleteTempStorage();                         
        }

        Storage::exists($directory) ?: Storage::makeDirectory($directory, 0711, true, true) ;

        return ! Storage::exists($directory) ?: $directory;
    }

    /**
     * Delete temporary storage for uploaded file(s)
     * 
     * @return void
     */
    protected function deleteTempStorage()
    {
        $directory = $this->getTempStoragePath() . $this->getUserDirectoryName();

        if (Storage::exists($directory)) {
            Storage::deleteDirectory($directory);
        }
    }

    protected function getAllExtensions()
    {
        return array_merge(
            $this->image_ext, $this->audio_ext, $this->video_ext, $this->document_ext
        );
    }

    /**
     * Get the authenticated user's email
     * 
     * @return sting the authenticated user's email
     */
    protected function getUserDirectoryName()
    {
        return Auth::user()->email;
    }

    /**
     * Get the authenticated user's email
     * 
     * @return sting the authenticated user's email
     */
    protected function getTempStorageFilePath()
    {
        return $this->getTempStoragePath() . $this->getAuthUserEmail() . DIRECTORY_SEPARATOR;
    }

    /**
     * Get file from temporary storage
     * 
     * @param string $file_name
     * @return Illuminate\Htpp\UploadeFile
     */
    protected function getFileFromTempStorage($file_name) 
    {
        return $this->getTempStorageFilePath() . $file_name;
    }

    /**
     * Get the path for permanent storage
     * 
     * @return string
     */
    protected function getPermenantStoragePath()
    {
        return $this->permanentStoragePathPrefix . DIRECTORY_SEPARATOR ;
    }

    /**
     * Get the path to Temporary storage
     * 
     * @return string the path to temporary storage
     */
    protected function getTempStoragePath()
    {
        return $this->tempStoragePathPrefix . DIRECTORY_SEPARATOR;
    }

    /**
     * Move file from temporary storage to permanent storage
     * 
     * @param string $file_name
     * @return bool
     */
    protected function moveFileToPermanentStorage($file_name)
    {
        return Storage::copy(
                $this->getFileFromTempStorage($file_name), 
                $this->getPermenantStoragePath() . $file_name
            );
    }

    /**
     * Rename a file
     * 
     * @param Illuminate\Http\UploadedFile $file
     * @return string the new file name
     */
    protected function renameFile($file)
    {
       
        // To make sure we get a unique name, we get time in micro seconds 
        $time = (int)round(microtime(true) * 1000000000);
        
        // Then we return the generated a new file name,
        // such that the micro seconds is before the file extension    
        return pathInfo(
                $file->getClientOriginalName(), PATHINFO_FILENAME
            ) . '.' . strtotime(now()) . '.' . $file->getClientOriginalExtension();
    }

    /**
     * Save temp file(s) permanetly in storage
     * 
     * @param array $file_names
     * @param int $owner_id
     * @return void
     */
    protected function persistTempFiles(array $file_names, $owner_id, $table)
    {
        try {
            foreach ($file_names as $file_name) {                
                $bool = $this->moveFileToPermanentStorage($file_name);

                if ($bool) {
                    $table::create($this->getFilePayload($file_name, $owner_id));
                }
            }

            // Delete the temporary storage created for this file(s)
            $this->deleteTempStorage();
        }
        catch(Exception $e) { 
            //
        }
    }

    /**
     * Rename file(s) and store the file(s) to temporary storage
     * 
     * @param array $files 
     * @return array returns an array containing the new names of the stored files
     */
    protected function storeFilesToTempStorage(array $files, $delete = false)
    {
        // Get the temp storage for this file(s)
        $directory = $this->createTempStorage($delete);

        $file_names_array = [];

        // Traverse the files to generate a new name 
        // and store the files to the temp storage
        foreach($files as $file) {
            $filename = $this->renameFile($file);
            $file->storeAs($directory, $filename);
            $file_names_array[] = $filename;
        }

        return $file_names_array;
    }

    protected function saveFilesPermanently(array $files, $owner_id, $table)
    {
        $directory = $this->getPermenantStoragePath();

        foreach($files as $file) {
            $file_name = $this->renameFile($file);
            $file->storeAs($directory, $file_name);
            $table::create($this->getFilePayload($file_name, $owner_id));
        }
    }

    protected function uploadEmbeddedFile($image, $type = 'image') {

        $name = $image->getClientOriginalName();
        $image->storeAs($this->getPermenantStoragePath(), $name);
        // return Image::make($image)->resize(600, 400)->save(
        //     $this->getPermenantStoragePath()
        // );

        return $name;
    }

    /**
     * Get an array of columns and values pair of a file record to be persisted
     * 
     * @param string $file_name
     * @param int $owner_id
     * @return array
     */
    protected function getFilePayload($file_name, $owner_id = null)
    {
        // 
    }
}