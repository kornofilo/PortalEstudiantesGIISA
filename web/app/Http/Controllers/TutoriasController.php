<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Tutorias;

class TutoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      # llama la vista y trae todos datos de la tabla
      $datos = Tutorias::where('estadoPost','Aprobada')->orderBy('created_at','desc')->paginate(10);
      return view('clasificado.Tutorias.tutorias',compact('datos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function search(Request $request)
     {
        $search = $request->get('search');
        $datos = Tutorias::where('estadoPost','Aprobada')
          ->whereRaw('concat(titulo,materia,costo,ubicacion,codigoPost) like \'%' .$search .'%\' ')
          ->orderBy('created_at','desc')
          ->paginate(10);
        return view('clasificado.Tutorias.tutorias',compact('datos'));
     }
     public function create()
     {

     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      #datos que van a la base de datos

      $this->validate($request,[
      'titulo' => 'required',
      'nombreTutor' => 'required',
      'materia' => 'required',
      'costo' => 'required',
      'ubicacion' => 'required',
      'descripcion' => 'required',
      'celular' => 'required',
       // 'imagen' => 'required',
  ]);

      $tutorias = new Tutorias () ;
      //Generación de Código de Publicación.
      $tutorias->codigoPost= 'TUT-' . (Tutorias::all()->max('id') + 1);
      $tutorias->titulo= $request->input('titulo');
      $tutorias->nombreTutor= $request->input('nombreTutor');
      $tutorias->materia= $request->input('materia');
      $tutorias->costo= $request->input('costo');
      $tutorias->ubicacion= $request->input('ubicacion');
      $tutorias->descripcion= $request->input('descripcion');
      $tutorias->celular= $request->input('celular');
      $tutorias->nombre =\Auth::user()->nombre;
      $tutorias->email =\Auth::user()->email;
      //
      if ($request->hasFile('imagen')) {
          $file = $request->file('imagen');
          $name_image = time().$file->getClientOriginalName();
          $file->move(public_path().'/imagenes/clasificados/tutorias',$name_image);
          $tutorias->imagen =$name_image;
      }

     #salvar en la base de datos
      $tutorias->save();

        return back()->with('success',' Tutoría: '.$tutorias->titulo.' Creada exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show($id)
     {
         $datosT = Tutorias::find($id);
         return view('Perfil.Tutorias.show2', compact('datosT'));
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function edit($id)
     {
         $datosT = Tutorias::find($id);
         return view('Perfil.Tutorias.detalles2', compact('datosT'));
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, $id)
     {

           $datosT = Tutorias::find($id);
           $datosT->titulo = $request->get('titulo');
           $datosT->nombreTutor = $request->get('nombreTutor');
           $datosT->materia = $request->get('materia');
           $datosT->costo = $request->get('costo');
           $datosT->ubicacion = $request->get('ubicacion');
           $datosT->descripcion = $request->get('descripcion');
           $datosT->celular = $request->get('celular');
           $datosT->estadoPost = ('En Moderación');

           if($request->hasFile('imagen')){
             if ($datosT->imagen === 'post-placeholder.jpg')
             {
             }else {
             unlink(public_path().'/imagenes/clasificados/tutorias/'.$datosT->imagen);
             }
             $file = $request->file('imagen');
             // ejemplo para guardar fotos encima de otra foto.
             $name_image = time().$file->getClientOriginalName();
             $file->move(public_path().'/imagenes/clasificados/tutorias/',$name_image);
             $datosT->imagen = $name_image;

           }
           $datosT->save();

         return redirect('/miPerfil')->with('success','Datos de la Tutoría Actualizados Exitosamente.');
       }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
     { $file = Tutorias::where('id', $id)->find($id);
       $usr = (auth()->user()->email);

       if ($usr ===$file->email)
       {
         if ($file->imagen === 'post-placeholder.jpg')
         {
         Tutorias::where('id', $id)->delete();
         return back()->with('success','Tutoría eliminada exitosamente.');
         }
        else {
          $file = Tutorias::where('id', $id)->find($id);
          if(unlink(public_path().'/imagenes/clasificados/tutorias/'.$file->imagen)){
           $file->delete();
           return back()->with('success','Tutoría eliminada exitosamente.');
              }
        }
       }
      }
}
