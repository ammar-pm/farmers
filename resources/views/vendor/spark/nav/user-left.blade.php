@include('common.menus.editor')

@if(Auth::user()->role === 'admin')

@include('common.menus.admin')

@endif
