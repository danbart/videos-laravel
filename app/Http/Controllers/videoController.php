<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

use App\video;
use App\comment;

class videoController extends Controller
{
    //
    public function createVideo(){
      return view('video.createVideo');
    }

    public function saveVideo(Request $request){
      //validar formulario
      $validateData = $this->validate($request, [
        'title' => 'required|min:5',
        'description' => 'required',
        'video' => 'mimes:mp4'
      ]);

      //asignamos los valores a la base de datos
      $video = new video();
      $user = \Auth::user();
      $video->user_id = $user->id;
      $video->title = $request->input('title');
      $video->description = $request->input('description');

      //subida de la miniatura
      $image = $request->file('image');
      if($image){
        //obtenemos el nombre de la imagen
        $image_path = time().$image->getClientOriginalName();
        //con esto subimos la imagen a la carpeta storage de nuestro servidor en la carpeta images
        \Storage::disk('images')->put($image_path, \File::get($image));
        $video->image = $image_path;
      }

      //subida del video
      $video_file = $request->file('video');
      if($video_file){
        $video_path = time().$video_file->getClientOriginalName();
        \Storage::disk('videos')->put($video_path, \File::get($video_file));

        $video->video_path = $video_path;
      }


      $video->save();
      return redirect()->route('home')->with(array(
        "message" => 'El video se ha subido correctamente!!'
      ));

    }
    //obtenemos la imagen
    public function getImage($filename){
      $file = storage::disk('images')->get($filename);
      return new Response($file, 200);
    }

    public function getVideoDetail($video_id){
      $video = Video::find($video_id);
      return view('video.detail',array(
        'video' => $video
      ));
    }
//obtenemos el video
    public function getVideo($filename){
      $file = storage::disk('videos')->get($filename);
      return new Response($file, 200);
    }

    public function delete($video_id){
      $user = \Auth::user();
      $video = video::find($video_id);
      $comment = comment::where('video_id', $video_id)->get();

      if($user && $video->user_id == $user->id){

        //eliminar los Comentarios
        if($comment && count($comment) >= 1){
          foreach($comment as $commen){
            $commen->delete();
          }
        }
        //eliminar ficheros
        Storage::disk('images')->delete($video->image);
        Storage::disk('videos')->delete($video->video_path);
        //eliminar registro
        $video->delete();
        $message = array(
          "message" => 'El video se ha eliminado correctamente!!'
        );
      } else{
        $message = array(
          "message" => 'El video se ha eliminado correctamente!!'
        );
      }
      return redirect()->route('home')->with($message);
    }
}
