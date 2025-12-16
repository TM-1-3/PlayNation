<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Post;
use App\Models\Group;



class FileController extends Controller
{   
    static $default = 'default.png';
    static $diskName = 'storage';

    static $systemTypes = [
        'profile' => ['png', 'jpg', 'jpeg', 'gif'],
        'posts' => ['mp3', 'mp4', 'gif', 'png', 'jpg', 'jpeg'],
        'group' => ['png', 'jpg', 'jpeg', 'gif'],
    ];

    private static function getDefaultExtension(String $type) {
        return reset(self::$systemTypes[$type]);
    }

    private static function isValidExtension(String $type, String $extension) {
        $allowedExtensions = self::$systemTypes[$type];

        return in_array(strtolower($extension), $allowedExtensions);
    }

    private static function isValidType(String $type) {
        return array_key_exists($type, self::$systemTypes);
    }

    private static function defaultAsset(String $type) {
        return asset($type . '/' . self::$default);
    }

    private static function getFileName(String $type, int $id, String $extension = null) {

        $fileName = null;
        switch($type) {
            case 'profile':
                $user = User::find($id); 
                $fileName = $user ? $user->profile_picture : null; 
                break;
            case 'posts':
                $post = Post::find($id);
                $fileName = $post ? $post->image : null; 
                break;
            case 'group':
                $group = Group::find($id);
                $fileName = $group ? $group->picture : null; 
                break;
            default:
                return null;
        }

        return $fileName;
    }

    private static function delete(String $type, int $id) {
        if ($id === null) {
            return;
        }
        $existingFileName = self::getFileName($type, $id);
        if ($existingFileName) {
            Storage::disk(self::$diskName)->delete($type . '/' . $existingFileName);

            switch($type) {
                case 'profile':
                    $user = User::find($id);
                    if ($user) {
                        $user->profile_picture = null; 
                        $user->save();
                    }
                    break;
                case 'posts':
                    $post = Post::find($id);
                    if ($post) {
                        $post->image = ''; 
                        $post->save();
                    }
                    break;
                case 'group':
                    $group = Group::find($id);
                    if ($group) {
                        $group->picture = null; 
                        $group->save();
                    }
                    break;
            }
        }
    }

    function upload(Request $request) {

        // Validation: has file
        if (!$request->hasFile('file')) {
            return redirect()->back()->with('error', 'Error: File not found');
        }

        // Validation: has ID
        if (!$request->has('id') || $request->id === null) {
            return redirect()->back()->withErrors(['id' => 'Error: ID is required']);
        }

        // Validation: upload type
        if (!$this->isValidType($request->type)) {
            return redirect()->back()->with('error', 'Error: Unsupported upload type');
        }

        // Validation: upload extension
        $file = $request->file('file');
        $type = $request->type;
        $extension = $file->extension();

        if (!$this->isValidExtension($type, $extension)) {
            return redirect()->back()->with('error', 'Error: Unsupported upload extension');
        }

        // Prevent existing old files
        $this->delete($type, $request->id);

        // Generate unique filename
        $fileName = $file->hashName();

        // Validation: model
        switch($request->type) {
            case 'profile':
                $user = User::findOrFail($request->id);
                $user->profile_picture = $fileName;
                $user->save();
                break;

            case 'posts':
                $post = Post::findOrFail($request->id);
                $post->image = $fileName;
                $post->save();
                break;

            case 'group':
                $group = Group::findOrFail($request->id);
                $group->picture = $fileName;
                $group->save();
                break;

            default:
                return redirect()->back()->withErrors(['type' => 'Error: Unsupported upload object']);
        }

        $file->storeAs($type, $fileName, self::$diskName);
        return null;
    }

    static function get(String $type, int $id) {

        // Validation: upload type
        if (!self::isValidType($type)) {
            return self::defaultAsset($type);
        }

        // Validation: file exists
        $fileName = self::getFileName($type, $id);
        if ($fileName) {
            return asset($type . '/' . $fileName);
        }

        // Not found: returns default asset
        return self::defaultAsset($type);
    }
}

