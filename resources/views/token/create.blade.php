@extends('layouts.app')

@section('content')
<div class="bg-white shadow p-8 mb-4">
    <div class="text-orange-dark font-light mb-8 bg-orange-lightest -mx-8 -mt-8">
        <h4 class="title text-orange-dark font-light text-2xl p-4 flex justify-between">
            <span class="flex-1">Generar new access token</span>
        </h4>
    </div>
    <form method="POST" action="{{{ route('user.token.store', [$user->id]) }}}">
        {{ csrf_field() }}
        <div class="mb-8">
            <label class="title">Friendly name</label>
            <p class="control">
                <input class="input" type="text" name="name" value="{{ old('name') }}" placeholder="Just an easy way to identify the token" required>
            </p>
        </div>
        <button class="button is-primary is-outlined" type="submit">Generate</button>
        <a class="button" href="{{{ route('profile.show') }}}">Cancel</a>
    </form>
</div>
@endsection
