<?php

namespace App\Http\Controllers;

use App\Bolsatrabajo;
use Illuminate\Http\Request;

class BolsatrabajoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      # llama la vista y trae todos datos de la tabla
      $datos = Bolsatrabajo::orderBy('created_at','desc')->paginate(10);
      return view('Bolsatrabajos.bolsatrabajos',compact('datos'));
    }

    public function search(Request $request)
     {
         $search = $request->get('search');
        $datos = Bolsatrabajo::whereRaw('concat(codigoPost,titulo,ubicacion,empresa,salario,beneficio) like \'%' .$search .'%\' ')
                                ->orderBy('created_at','desc')
                                ->paginate(10);
        return view('Bolsatrabajos.bolsatrabajos',compact('datos'));
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

        #datos que van a la base de datos

        $this->validate($request,[
        'urgente' => 'required',
        'titulo' => 'required',
        'ubicacion' => 'required',
        'empresa' => 'required',
        'tipoPuesto' => 'required',
        'salario' => 'required',
        'direccion' => 'required',
        'descripcion' => 'required',
        'habilidades' => 'required',
        'fecha' => 'required',
        'beneficio' => 'required',
        'nombreContacto' => 'required',
        'celular' => 'required',
        'emailContacto' => 'required',
        // 'imagen' => 'required',
    ]);





        $bolsatrabajo = new Bolsatrabajo();
        //Generación de Código de Publicación.
        $bolsatrabajo->codigoPost = 'BDT-' . (Bolsatrabajo::all()->max('id') + 1);
        $bolsatrabajo->urgente= $request->input('urgente');
        $bolsatrabajo->titulo= $request->input('titulo');
        $bolsatrabajo->ubicacion= $request->input('ubicacion');
        $bolsatrabajo->empresa= $request->input('empresa');
        $bolsatrabajo->tipoPuesto= $request->input('tipoPuesto');
        $bolsatrabajo->salario= $request->input('salario');
        $bolsatrabajo->direccion= $request->input('direccion');
        $bolsatrabajo->descripcion= $request->input('descripcion');
        $bolsatrabajo->habilidades= $request->input('habilidades');
        $bolsatrabajo->fecha= $request->input('fecha');
        $bolsatrabajo->beneficio= $request->input('beneficio');
        $bolsatrabajo->email = \Auth::user()->email;
        $bolsatrabajo->nombreContacto= $request->input('nombreContacto');
        $bolsatrabajo->celular= $request->input('celular');
        $bolsatrabajo->emailContacto= $request->input('emailContacto');


        #salvar en la base de datos


      if ($request->hasFile('imagen')) {
          $file = $request->file('imagen');
          $name_image = time().$file->getClientOriginalName();
          $file->move(public_path().'/imagenes/bolsatrabajo',$name_image);
          $bolsatrabajo->imagen =$name_image;
      }
      $bolsatrabajo->save();
      return back()->with('success','Anuncio de Empleo creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bolsatrabajo  $bolsatrabajo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $datosB = Bolsatrabajo::find($id);
      return view('Perfil.Bolsatrabajo.show', compact('datosB'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bolsatrabajo  $bolsatrabajo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $datosB = Bolsatrabajo::find($id);
      return view('Perfil.Bolsatrabajo.detalles', compact('datosB'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bolsatrabajo  $bolsatrabajo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
          $bolsatrabajo = Bolsatrabajo::find($id);

          $bolsatrabajo->urgente= $request->input('urgente');
          $bolsatrabajo->titulo= $request->input('titulo');
          $bolsatrabajo->ubicacion= $request->input('ubicacion');
          $bolsatrabajo->empresa= $request->input('empresa');
          $bolsatrabajo->tipoPuesto= $request->input('tipoPuesto');
          $bolsatrabajo->salario= $request->input('salario');
          $bolsatrabajo->direccion= $request->input('direccion');
          $bolsatrabajo->descripcion= $request->input('descripcion');
          $bolsatrabajo->habilidades= $request->input('habilidades');
          $bolsatrabajo->fecha= $request->input('fecha');
          $bolsatrabajo->beneficio= $request->input('beneficio');
          $bolsatrabajo->email = \Auth::user()->email;
          $bolsatrabajo->nombreContacto= $request->input('nombreContacto');
          $bolsatrabajo->celular= $request->input('celular');
          $bolsatrabajo->emailContacto= $request->input('emailContacto');

          if($request->hasFile('imagen')){
            if ($bolsatrabajo->imagen === 'post-placeholder.jpg')
            {
            }else {
            unlink(public_path().'/imagenes/bolsatrabajo/'.$bolsatrabajo->imagen);
            }
            $file = $request->file('imagen');
            $name_image = time().$file->getClientOriginalName();
            $file->move(public_path().'/imagenes/bolsatrabajo/',$name_image);
            $bolsatrabajo->imagen = $name_image;

          }

          $bolsatrabajo->save();
          return redirect('/miPerfil')->with('success','Anuncio de Empleo Actualizado Exitosamente.');
      }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bolsatrabajo  $bolsatrabajo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { $file = Bolsatrabajo::where('id', $id)->find($id);
      $usr = (auth()->user()->email);

      if ($usr ===$file->email)
      {
        if ($file->imagen === 'post-placeholder.jpg')
        {
        Bolsatrabajo::where('id', $id)->delete();
        return back()->with('success','Anuncio de trabajo eliminado exitosamente.');
        }
       else {
         $file = Bolsatrabajo::where('id', $id)->find($id);
         if(unlink(public_path().'/imagenes/bolsatrabajo/'.$file->imagen)){
          $file->delete();
          return back()->with('success','Anuncio de trabajo eliminado exitosamente.');
             }
       }
      }
     }

}
