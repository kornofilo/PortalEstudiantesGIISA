<?php

namespace App\Http\Controllers;

use App\Evento;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class EventoController extends Controller
{
    public function __construct()
    {
          Carbon::setLocale('es');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //muestra los datos
      $datos = Evento::orderBy('created_at','desc')->paginate(10);

      return view('Eventos.eventos')->with(compact('datos'));
    }
    public function searchE(Request $request)
    {
       $search = $request->get('search');
       $datos = Evento::whereRaw('concat(codigoPost,titulo,lugar,costo,descripcion,facultad_nomb) like \'%' .$search .'%\' ')
                        ->orderBy('created_at','desc')
                        ->paginate(10);
       return view('Eventos.eventos',compact('datos'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request,[
      'titulo' => 'required',
      'fecha' => 'required',
      'lugar' => 'required',
      'costo' => 'required',
      'facultad_nomb' => 'required',
      'descripcion' => 'required',
      ]);


      $eventos = new Evento();
      //Generación de Código de Publicación.
      $eventos->codigoPost = 'EV-' . (Evento::all()->max('id') + 1);
      $eventos->titulo= $request->input('titulo');
      $eventos->fecha= $request->input('fecha');
      $eventos->hora= $request->input('hora');
      $eventos->lugar= $request->input('lugar');
      $eventos->costo= $request->input('costo');
      $eventos->facultad_nomb= $request->input('facultad_nomb');
      $eventos->descripcion= $request->input('descripcion');
      $eventos->email = \Auth::user()->email;

      if ($request->hasFile('imagen')) {
        $file = $request->file('imagen');
        $name_image = time().$file->getClientOriginalName();
        $file->move(public_path().'/imagenes/eventos',$name_image);
        $eventos->imagen =$name_image;
    }

     //salvar en la base de datos
      $eventos->save();
        return back()->with('success','Evento: '.$eventos->titulo.' Creado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $datos = Evento::find($id);
      return view('Perfil.Eventos.show', compact('datos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
                   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
          echo $request;
          $this->validate($request,[
            'titulo' => 'required',
            'fecha' => 'required',
            'lugar' => 'required',
            'costo' => 'required',
            'facultad_nomb' => 'required',
            'descripcion' => 'required',
            ]);

         $eventos = Evento::find($id);
          $eventos->titulo= $request->input('titulo');
          $eventos->fecha= $request->input('fecha');
          $eventos->hora= $request->input('hora');
          $eventos->lugar= $request->input('lugar');
          $eventos->costo= $request->input('costo');
          $eventos->facultad_nomb= $request->input('facultad_nomb');
          $eventos->descripcion= $request->input('descripcion');

          if($request->hasFile('imagen')){
            if ($eventos->imagen === 'post-placeholder.jpg')
            {
            }else {
            unlink(public_path().'/imagenes/eventos/'.$eventos->imagen);
            }
            $file = $request->file('imagen');
            $name_image = time().$file->getClientOriginalName();
            $file->move(public_path().'/imagenes/eventos/',$name_image);
            $eventos->imagen = $name_image;

          }

          $eventos->save();
          return back()->with('success','Los datos del evento ' . $eventos->titulo . ' se han actualizado exitosamente.');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { $file = Evento::where('id', $id)->find($id);
      $usr = (auth()->user()->email);

      if ($usr ===$file->email)
      {
        if ($file->imagen === 'post-placeholder.jpg')
        {
        Evento::where('id', $id)->delete();
        return back()->with('success','Evento eliminado exitosamente.');
        }
       else {
         $file = Evento::where('id', $id)->find($id);
         if(unlink(public_path().'/imagenes/eventos/'.$file->imagen)){
          $file->delete();
          return back()->with('success','Evento eliminado exitosamente.');
             }
       }
      }
     }
}
