@component('mail::message')
# Hallo!
ben jij je wachtwoord vergeten? Klik op de knop om hem te resetten.
@component('mail::button', ['url' => $link, 'color' => 'red'])
Wachtwoord resetten!
@endcomponent
Met vriendelijke groet,</br>
</br>
Futsal Club Heerenveen
@component('mail::subcopy')
Als je problemen hebt met het klikken op de Wachtwoord resetten knop, kopieer en plak de onderstaande</br>
link in je browser: <a href="{{ $link }}">{{ $link }}</a>
@endcomponent
@endcomponent
