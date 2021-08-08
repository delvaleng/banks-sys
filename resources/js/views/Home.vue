<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Example Component</div>

                <div class="panel-body">
                    I'm an example component!



                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {}
    },
    beforeMount() {
        // this.$store.dispatch("getToken")
    },
    mounted() {
        console.log('Component HOME.')
        this.getAccount();
    },
    computed: {

    },
    methods: {
        getAccount() {
          const token = document.querySelector("meta[name='user-token']").getAttribute('content');
          const id    = document.querySelector("meta[name='user-id']").getAttribute('content');
              axios({
                      method: "get",
                      url: "/api/accountlist",
                      data: {
                        id : id,
                      },
                      headers: {
                        "Accept": "application/json",
                        "Authorization": "Bearer "+token,
                      }
                  })
                  .then((response) => {
                      console.log(response);
                      this.account = response.data.data;
                  })
                  .catch(function(error) {
                      console.log(error);
                  });
        },
    }
}
</script>
