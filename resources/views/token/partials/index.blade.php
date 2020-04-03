<div>
<div class="md:flex md:flex-row hidden justify-between p-4 hover:bg-grey-lightest font-semibold border-b-2 border-orange">
    <div class="flex-1 flex-col md:flex-row">
        <div class="flex flex-col md:flex-row">
            <div class="flex-initial text-center text-orange-darker pr-4 w-8">
            </div>
            <div class="flex-1 ">
                Name
            </div>
            <div class="flex-1 text-orange-darker">Created At</div>
            <div class="flex-1 text-orange-darker">Last Used</div>
            <div class="flex-1 text-orange-darker">Actions</div>
           
        </div>
    </div>
    
</div>


@foreach ($tokens as $token)
<div class="flex flex-col md:flex-row justify-between p-4 mb-4 md:mb-0 shadow md:shadow-none hover:bg-grey-lightest">
    <div class="flex-1 flex-col md:flex-row">
        <div class="flex flex-col md:flex-row">
            <div class="flex-1 text-orange hover:text-orange-dark">
                {{ $token->name }}
            </div>
            <div class="flex-1 text-orange-darker">
                {{ $token->created_at }}
            </div>
            <div class="flex-1 text-orange-darker">
                {{ $token->last_used_at }}
            </div>
            <div class="flex-1">
                <form class="flex-1 text-right text-base" method="POST" action="{{{ route('user.token.revoke', [$user->id, $token->id]) }}}">
                    {{{ csrf_field() }}}
                    <button class="button">Revoke</button>
                </form>
            </div>
           
        </div>
    </div>
    
</div>
@endforeach

</div>