<?php

namespace App\Http\Controllers\Admin;

use App\ACME\Admin\AdminHelper;
use Carbon\Carbon;
use Storage;

class LogController extends AdminHelper
{
    /**
     * Lists all log files.
     */
    public function index()
    {
        $disk = Storage::disk('storage');
        $files = $disk->files('logs');
        $this->data['logs'] = [];
        // make an array of log files, with their filesize and creation date
        foreach ($files as $k => $f) {
            // only take the zip files into account
            if (substr($f, -4) == '.log' && $disk->exists($f)) {
                $this->data['logs'][] = [
                    'file_path'     => $f,
                    'file_name'     => str_replace('logs/', '', $f),
                    'file_size'     => $disk->size($f),
                    'last_modified' => Carbon::createFromTimeStamp($disk->lastModified($f))->formatLocalized('%d %B %Y'),
                ];
            }
        }
        // reverse the logs, so the newest one would be on top
        $this->data['logs'] = array_reverse($this->data['logs']);
        $this->data['title'] = 'Log manager';
//        $logs = $this->data;
//        dd($logs);
        return view('admin.log.grid', $this->data);
    }
    /**
     * Previews a log file.
     *
     * TODO: make it work no matter the flysystem driver (S3 Bucket, etc).
     */
    public function show($file_name)
    {
        $disk = Storage::disk('storage');
        if ($disk->exists('logs/'.$file_name)) {
            $this->data['log'] = [
                'file_path'     => 'logs/'.$file_name,
                'file_name'     => $file_name,
                'file_size'     => $disk->size('logs/'.$file_name),
                'last_modified' => $disk->lastModified('logs/'.$file_name),
                'content'       => $disk->get('logs/'.$file_name),
            ];
            $this->data['title'] = 'Preview'.' '.'logs';
            return view('admin.log.logitem', $this->data);
        } else {
            abort(404, 'Log file doesnt exist');
        }
    }
    /**
     * Downloads a log file.
     *
     * TODO: make it work no matter the flysystem driver (S3 Bucket, etc).
     */
    public function downloads($file_name)
    {
        $disk = Storage::disk('storage');
        if ($disk->exists('logs/'.$file_name)) {
            return response()->download(storage_path('logs/'.$file_name));
        } else {
            abort(404, 'Log file doesnt exist');
        }
    }
    /**
     * Deletes a log file.
     *
     * TODO: make it work no matter the flysystem driver (S3 Bucket, etc).
     */
    public function destroy($file_name)
    {
         $disk = Storage::disk('storage');
        if ($disk->exists('logs/'.$file_name)) {
            $disk->delete('logs/'.$file_name);
            $alert = [
                'type' => 1,
                'message' => 'Log has been deleted',
            ];
            flash('Log deleted successfully!')->success();
            return response()->json($alert);

        } else {
            abort(404, 'Log file doesnt exist');
        }
    }
}