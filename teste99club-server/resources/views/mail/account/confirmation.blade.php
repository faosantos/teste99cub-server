@component('mail::message')
# Obrigado por registrar-se, {{$user['name']}}

Esta confirmação de email é necessária para aumentar <b>sua segurança</b> ao utilizar o 
<b>99club</b>.<br/>
Não compartilhe este email com outras pessoas.<br/>


@component('mail::button', ['url' => $url, 'color'=>'red'])
Continuar
@endcomponent

Thanks, <br/>
{{ config('app.name') }}
@endcomponent
