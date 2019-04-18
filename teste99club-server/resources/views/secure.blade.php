@extends('layouts.secureView')
@section('title', "Autenticando...")
@section('content')
  <div style="height: 100vh; width: 100vw;display:flex;flex-direction:column;justify-content:center;align-items:center;" class="bg-gradient">
    <div id="loader" class="loader"></div>
    <div style="display:none;flex-direction:column;justify-content:center;align-items:center;max-width:600px;" id="success" class="alert alert-light">
      <i style="font-size:4em;margin:30px;" class="ti-thumb-up gradient-fill"></i>
      <h4 class="gradient-fill" style="text-align:center;">Concluido com sucesso.</h4> 
    </div>
    <div style="display:none;flex-direction:column;justify-content:center;align-items:center;max-width:600px;" id="error" class="alert alert-light">
      <i style="font-size:4em;margin:30px;" class="ti-face-sad gradient-fill"></i>
      <h4 class="gradient-fill">Algo deu errado ao confirmar cadastro.</h4>
    </div>
  </div>
@endsection
@section('script')
  <script>
    let token = "{{$token}}";
    console.log(token);
    $.ajax({
      method:'get',
      url: '/api/confirm',
      headers:{
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'Authorization' : "Bearer "+token
      },
      success:(res)=>{
        $('#loader').css('display', 'none');
        if(res.success){
          document.title = '{{config("app.name")}} | Sucesso'
          $("#success").css('display', 'flex');
          return;
        }
        document.title = '{{config("app.name")}} | Falhou'
        $('#error').css('display', 'flex');
        return;
      },
      error:err=>{
        $('#loader').css('display', 'none');
        document.title = '{{config("app.name")}} | Falhou'
        $('#error').css('display', 'flex');
        return;
      }
    })
  </script>
@endsection