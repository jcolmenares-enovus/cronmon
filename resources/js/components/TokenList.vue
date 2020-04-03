<template><div>
<div class="mb-2 text-right">
    <input placeholder="Filter..." v-model="filter" class="w-full md:w-1/4 shadow appearance-none border focus:border-grey-dark rounded py-2 px-3 text-grey-darker leading-tight" type="text" name="login" required autofocus>
</div>

<div class="md:flex md:flex-row hidden justify-between p-4 hover:bg-grey-lightest font-semibold border-b-2 border-orange">
    <div class="flex-1 flex-col md:flex-row">
        <div class="flex flex-col md:flex-row">
            <div class="flex-initial text-center text-orange-darker pr-4 w-8">
            </div>
            <div class="flex-1 ">
                Name
            </div>
            <div class="flex-1 text-orange-darker">Token</div>
            <div class="flex-1 text-orange-darker">Last Used</div>
           
        </div>
    </div>
    
</div>

<div
    v-for="token in tokens"
    :key="token.id"
    class="flex flex-col md:flex-row justify-between p-4 mb-4 md:mb-0 shadow md:shadow-none hover:bg-grey-lightest"
>
    <div class="flex-1 flex-col md:flex-row">
        <div class="flex flex-col md:flex-row">
            <div class="flex-1 text-orange hover:text-orange-dark">
                {{ token.name }}
            </div>
             <div class="flex-1 text-orange-darker">
                {{ token.token }}
            </div>
             <div class="flex-1 text-orange-darker">
                {{ token.last_used_at }}
            </div>
           
        </div>
    </div>
    
</div>

</div></template>

<script>
export default {
  props: ["tokens"],
  data() {
    return {
      filter: ""
    };
  },
  computed: {
    filteredTokens() {
      return this.tokens.filter(token => token.name.includes(this.filter));
    }
  }
};
</script>
