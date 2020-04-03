@extends('layouts.app')

@section('content')
<div class="bg-white shadow p-8 mb-4">
    <div class="text-orange-dark font-light mb-8 bg-orange-lightest -mx-8 -mt-8">
        <h4 class="title text-orange-dark font-light text-2xl p-4 flex justify-between">
            <span class="flex-1">Save your new access token</span>
        </h4>
    </div>
        <div class="mb-8">
            <p class="mb-3 text-xs text-gray-400">Guarda tu token de acceso en un lugar seguro, ya que no tendras acceso a el nuevamente.</p>
            <p>{{{  $tokenUser }}}</p>
        </div>
        <a class="button" href="{{{ route('profile.show') }}}">Back to profile</a>
   
</div>
@endsection

