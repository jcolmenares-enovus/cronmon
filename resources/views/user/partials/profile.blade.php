    <div class="flex mb-8">
        <div class="flex-1">
            <h4 class="title mb-2">Username</h4>
            <p class="subtitle">
                 {{ $user->username }}
            </p>
        </div>
        <div class="flex-1">
            <h4 class="title mb-2">Email</h4>
            <p class="subtitle">
                @if (Auth::user()->is_admin)
                    <a class="text-orange" href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                @else
                    {{{ $user->email }}}
                @endif
            </p>
        </div>
        <div class="flex-1">
            <h4 class="title mb-2">Admin?</h4>
            <p class="subtitle">
                {{{ $user->is_admin ? 'Yes' : 'No' }}}
            </p>
        </div>
        <div class="flex-1">
            <h4 class="title mb-2">Silenced Alarms?</h4>
            <p class="subtitle">
                {{{ $user->is_silenced ? 'Yes' : 'No' }}}
            </p>
        </div>
    </div>

   
    <div class="flex mb-8">
        @if ($user->api_key)
        <div class="flex-1">
            <h4 class="title mb-2">Api Key</h4>
            <p class="subtitle">
                 <api-key-toggle apikey="{{ $user->api_key }}"></api-key-toggle>
            </p>
        </div>
        @endif
        <div class="flex-1">
            <h4 class="title mb-4">Get new access token</h4>
            <p class="subtitle">
                <a href="{{{  route('user.token.create', [$user->id])  }}}" class="button text-base">Generate</a>
            </p>
        </div>
        
    </div>
   
   
    
