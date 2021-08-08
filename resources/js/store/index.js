export default {

    state: {
        token: []
    },

    getters: {

        getTokenFromGetter(state) { //take parameter state
            return state.token
        }
    },

    actions: {
      getToken(context) {
        var bodyFormData = new FormData();
        bodyFormData.append('grant_type', 'client_credentials');
        bodyFormData.append('client_id', process.env.MIX_PASSPORT_CLIENT_ID);
        bodyFormData.append('client_secret', process.env.MIX_PASSPORT_CLIENT_SECRET);

        axios({
                method: "post",
                url: "/oauth/token",
                data: bodyFormData,
                headers: {
                    "Content-Type": "multipart/form-data"
                },
            })
            .then((response) => {
                console.log(response)
                localStorage.setItem("authToken",   response.data.access_token);
                context.commit("token", response.data)
            })
            .catch(function(error) {
                console.log(error);
            });

    }
},

mutations: {
    token(state, data) {
        return state.token = data
    }
}
}
