<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

trait SaveFiles{

    /**
     * Upload File and Update the model's file.
     *
     * @param  UploadedFile  $file
     * @param  string  $column
     * @param  string  $directory
     * @return void
     */
    public function updateFile(UploadedFile $file, $column, $directory){
        // Delete old file if exists
        if ($this->{$column}) {
            if (Storage::disk('public')->exists($this->{$column})) {
                Storage::disk('public')->delete($this->{$column});
            }
        }
        
        $dateTimeNow = now()->format('Y-m-d_H-i-s');
        $filename = $dateTimeNow . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('uploads/'.$directory, $filename, 'public');

        // Save new file and update model's column
        $this->{$column} = $path;
        $this->save();
    }

    
    /**
     * Delete File.
     *
     * @param  string  $table_column
     * @return void
     */
    public function deleteFile($table_column){
        // Delete old file if exists
        if ($this->{$table_column}) {
            if (Storage::disk('public')->exists($this->{$table_column})) {
                Storage::disk('public')->delete($this->{$table_column});
            }
        }
        $this->save();
    }
}