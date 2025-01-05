<header id="login-header" class="container-fluid p-3 text-white {{ request()->routeIs('professor.login') ? 'FootereHeaderProfessorLogin' : '' }}">
    <div class="row">
        <div class="col-md-6">
           <img class="img-fluid" 
                 src="{{ request()->routeIs('professor.login') ? asset('images/ifmslogoserver.png') : asset('images/ifmslogo.png') }}" 
                 alt="IFMS Logo">
        </div>
        <div class="col-md-6 d-flex align-items-center">
            <h1>Sistema de Carga Horária</h1>
        </div>
    </div>
</header>
