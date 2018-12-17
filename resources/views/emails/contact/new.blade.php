@component('mail::message')
# {{trans('strings.frontend.hello-admin')}},

{{trans('strings.frontend.you-received-a-new-message')}}:
<hr />
<b>{{trans('strings.frontend.sender')}}:</b> {{ $contact->name }} &lt;{{ $contact->email }}&gt; <br />
<b>{{trans('strings.frontend.subject')}}:</b> {{ $contact->subject }}<br />
<b>{{trans('strings.frontend.content')}}:</b><br />
<p>
    <em>
        {{ $contact->body }}
    </em>
</p>
<hr />
<br>
{{trans('strings.frontend.thanks')}},<br>
{{ config('app.name') }}
@endcomponent
