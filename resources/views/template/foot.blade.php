<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="assets/js/materialize.js"></script>
<script src="assets/js/init.js"></script>

<!-- AuthX initialization script -->
<script src="https://ajs.radius.africa/authx.js"></script>
<script type="text/javascript">
    function loginHandler (session, message) {
        console.log('logged in ', session, message)
        console.log('Session = ', authx.getSession())
    }
    const authx = AuthX("AObIdfFrue1ghfewJGGnWSyYfvvyF3uFIvzG3wA6", {
        redirect_uri: "https://jotty-app.herokuapp.com/sign-in",
        locale: 'en',
        isSpa: false,
        onComplete: loginHandler,
        onError: function (error) {
            alert(error.message)
        }
    })

    function login() {
        authx.initiateSession()
    }
</script>
      