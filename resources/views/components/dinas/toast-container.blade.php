@props(['errors', 'session'])

@if ($errors->any())
    <x-dinas.toast type="error" message="{{ $errors->first() }}" />
@elseif ($session->has('error'))
    <x-dinas.toast type="error" message="{{ $session->get('error') }}" />
@elseif ($session->has('success'))
    <x-dinas.toast type="success" message="{{ $session->get('success') }}" />
@elseif ($session->has('info'))
    <x-dinas.toast type="info" message="{{ $session->get('info') }}" />
@elseif ($session->has('warning'))
    <x-dinas.toast type="warning" message="{{ $session->get('warning') }}" />
@endif
